<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderConfig extends Model
{
    protected $table = 'order_config';
    use HasFactory;
    protected $fillable = [
        'minimum_price_per_page',
        'maximum_price_per_page',
        'minimum_pages_allowed',
        'min_max', 
        'maximum_pages_allowed', 
    ];
}