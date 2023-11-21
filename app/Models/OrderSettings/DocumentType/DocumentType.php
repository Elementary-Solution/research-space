<?php

namespace App\Models\OrderSettings\DocumentType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $fillable = [
        'erp_user_id',
        'erp_document_title',
        'erp_document_message',
        'erp_document_file',
        'erp_status',
    ];
}
