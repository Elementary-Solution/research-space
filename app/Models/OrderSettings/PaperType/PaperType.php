<?php

namespace App\Models\OrderSettings\PaperType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperType extends Model
{
    use HasFactory;
    protected $fillable = [
        'erp_user_id',
        'erp_paper_type',
        'erp_status',
    ];
}
