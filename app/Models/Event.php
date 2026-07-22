<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\Organization;

class Event extends Model
{
    protected $fillable = [
        'organization_id',
        'category_id',
        'title',
        'description',
        'date',
        'location',
        'price',
        'stock',
        'poster_path',
    ];

    /**
     * Cast atribut ke tipe data tertentu
     */
    protected $casts = [
        'date' => 'datetime',
        'price' => 'decimal:2',
    ];

    /**
     * Relasi ke Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Relasi ke Review
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Relasi ke Transaction
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Rata-rata Rating
     */
    public function averageRating()
    {
        return round($this->reviews()->avg('rating'), 1);
    }

    /**
     * Total Review
     */
    public function totalReviews()
    {
        return $this->reviews()->count();
    }
}