<?php

namespace App\Models\OrderSettings\LanguageStyle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageStyle extends Model
{
    use HasFactory;
    protected $fillable = [
        'erp_user_id',
        'erp_language_name',
        'erp_status',
    ];
}
