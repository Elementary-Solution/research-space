<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'product_id',
        'phone',
        'email',
        'domain',
        'guard',
        'subject',
        'message',
    ];
}
