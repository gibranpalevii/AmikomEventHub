<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Models\Transaction;
use App\Mail\EventTicketMail;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GoogleController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TransactionController;

// Tambahkan Controller Ujian
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PengurusController;


Route::post('/midtrans/callback', [MidtransWebhookController::class, 'handle']);

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


Route::get('/events/{event}', [EventController::class, 'show'])
    ->name('events.show');


Route::post('/events/{event}/review', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('review.store');


Route::get('/checkout/{event}', [CheckoutController::class, 'create'])
    ->name('checkout.create');

Route::post('/checkout/{event}', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])
    ->name('checkout.payment');

Route::get('/success/{order_id}', [CheckoutController::class, 'success'])
    ->name('checkout.success');


Route::resource('jabatan', JabatanController::class);
Route::resource('pengurus', PengurusController::class);


Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');


Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->middleware('guest')
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->middleware('guest')
    ->name('google.callback');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->middleware('guest')
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('guest')
        ->name('login.post');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');


    Route::middleware(['auth', 'admin'])->group(function () {


        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('events', AdminEventController::class);


        Route::resource('categories', CategoryController::class);


        Route::resource('partners', PartnerController::class);


        Route::get('/transactions', [TransactionController::class, 'index'])
            ->name('transactions.index');
    });
});


Route::get('/test-mail', function () {

    $transaction = Transaction::with('event')->firstOrFail();

    Mail::to('test@example.com')
        ->send(new EventTicketMail($transaction));

    return '✅ Email berhasil dikirim ke Mailtrap!';
});