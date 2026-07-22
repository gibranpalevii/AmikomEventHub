<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\User;
use App\Models\Event;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'logo',
        'status',
    ];

    /**
     * Organization memiliki banyak User
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Organization memiliki banyak Event
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Total Event
     */
    public function totalEvents()
    {
        return $this->events()->count();
    }

    /**
     * Total Pendapatan
     */
    public function totalRevenue()
    {
        return $this->events()
            ->with('transactions')
            ->get()
            ->sum(function ($event) {
                return $event->transactions
                    ->whereIn('status', ['success', 'settlement'])
                    ->sum('total_price');
            });
    }
}