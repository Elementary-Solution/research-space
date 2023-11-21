<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seo extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_id',
        'reference_type',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
