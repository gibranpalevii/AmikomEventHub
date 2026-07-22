<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    public function pengurus()
    {
        return $this->hasMany(Pengurus::class, 'jabatan_id');
    }
}