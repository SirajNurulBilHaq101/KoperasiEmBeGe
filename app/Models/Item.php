<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'code',
        'name',
        'unit',
        'unit_price',
        'quantity',
        'expired_at',
        'description',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'quantity'   => 'decimal:2',
        'expired_at' => 'date',
    ];

    /**
     * Relasi: item milik satu kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Atribut tambahan (tidak disimpan di DB)
     * total harga stok
     */
    public function getTotalPriceAttribute()
    {
        return $this->unit_price * $this->quantity;
    }
}
