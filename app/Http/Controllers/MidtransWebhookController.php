<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventTicketMail;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();
        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        if (!$orderId) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        // Mencari transaksi berdasarkan order_id
        $transaction = Transaction::with('event')->where('order_id', $orderId)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Cegah proses berulang jika transaksi sudah berhasil
        if (in_array($transaction->status, ['settlement', 'success'])) {
            return response()->json(['message' => 'Already processed']);
        }

        // Update status transaksi berdasarkan callback Midtrans
        if ($transactionStatus == 'capture') {

            if ($fraudStatus == 'challenge') {
                $transaction->status = 'challenge';

            } elseif ($fraudStatus == 'accept') {
                $transaction->status = 'success';
                $this->processSuccess($transaction);
            }

        } elseif ($transactionStatus == 'settlement') {

            $transaction->status = 'settlement';
            $this->processSuccess($transaction);

        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {

            $transaction->status = 'failed';

        } elseif ($transactionStatus == 'pending') {

            $transaction->status = 'pending';
        }

        $transaction->save();

        return response()->json(['message' => 'OK']);
    }

    /**
     * Dipanggil ketika pembayaran berhasil.
     */
    private function processSuccess(Transaction $transaction)
    {
        $event = $transaction->event;

        // Kurangi stok tiket
        if ($event && $event->stock > 0) {

            $event->stock = $event->stock - 1;
            $event->save();

            // Kirim email E-Ticket
            try {
                Mail::to($transaction->customer_email)
                    ->send(new EventTicketMail($transaction));

            } catch (\Exception $e) {

                Log::error('Gagal mengirim email E-Ticket: ' . $e->getMessage());
            }

        } else {

            Log::warning(
                'Stock habis setelah pembayaran berhasil. Order: ' .
                $transaction->order_id
            );
        }
    }
}