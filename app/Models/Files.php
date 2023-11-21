<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'file',
        'title',
        'file_id',
        'file_name',
    ];
}