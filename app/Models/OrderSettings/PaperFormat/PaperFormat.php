<?php

namespace App\Models\OrderSettings\PaperFormat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperFormat extends Model
{
    use HasFactory;
    protected $fillable = [
        'erp_user_id',
        'erp_paper_format',
        'erp_status',
    ];
}
