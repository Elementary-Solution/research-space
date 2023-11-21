<?php

namespace App\Models\OrderSettings\SubjectType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectType extends Model
{
    use HasFactory;


    protected $fillable = [
        'erp_user_id',
        'erp_subject_name',
        'erp_status',
    ];
}
