<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'type',        // masuk | keluar
        'quantity',
        'unit_price',
    ];

    // =====================
    // RELATIONS
    // =====================

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // =====================
    // HELPER
    // =====================
    public function getTotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }
}   