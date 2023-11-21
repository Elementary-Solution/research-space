<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileTitle extends Model
{
    use HasFactory;
    protected $table = 'files_title';
    protected $fillable = [ 
        'title',
            'user_id' ,
                'order_id',
                    'type',
    ];
}