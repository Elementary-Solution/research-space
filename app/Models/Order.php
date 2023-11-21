<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'variation_id',
        'is_custom_order',
        'custom_order_id',
        'currency_id',
        'subscription_id',
        'no_of_pages',
        'subscription_duration',
        'discount_id',
        'order_status',
        'grand_total',
        'coupon_discount',
        'order_total',
    ];
}
