<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'order_no',
        'user_id',
        'status',
        'total_price',
        'payment_method',
        'payment_status',
        'shipping_address',
        'billing_address',
        'shipping_cost',
        'tax',
        'discount',
        'coupon_code',
        'coupon_discount',
        'customer_id',
        'customer_title',
        'delivery_address_name',
        'delivery_address_id',
        'delivery_address_phone',
        'delivery_address_detail',
        'delivery_address_district',
        'delivery_address_city',
        'delivery_address_province',
        'delivery_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function delete()
    {
        $this->is_deleted = 1;
        return $this->save();
    }
}
