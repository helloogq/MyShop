<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'specification',
        'order_id',
        'product_id',
        'quantity',
        'total_price',
        'price',
        'unit',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relation with Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relation with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
