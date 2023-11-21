<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    public $table = "reactions";

    protected $fillable = [
        'user_id',
        'reference_type',
        'reference_id',
        'type',
        'comments',
        'image',
    ];

}
