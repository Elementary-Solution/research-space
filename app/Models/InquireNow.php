<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquireNow extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'product_id',
        'phone',
        'message',
    ];
}
