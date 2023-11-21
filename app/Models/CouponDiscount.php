<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponDiscount extends Model
{
    use HasFactory;
    protected $table = 'coupen_discounts';

    protected $fillable = ['title','discount_code','value','status','start_date','expiry_date'];
}
