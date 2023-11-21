<?php

namespace App\Models\OrderSettings\Citation_Style;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citation_Style extends Model
{

    use HasFactory;
    protected $fillable = [
        'erp_user_id',
        'erp_title',
        'erp_citation_message',
        'erp_file_type',
        'erp_datetime',
        'erp_date',
        'erp_status',
    ];
}
