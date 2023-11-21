<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateOrder extends Model
{
    // protected $table = 'create_orders';
    use HasFactory;
    protected $fillable = [
        'erp_user_id',
        'erp_status',
        'reason',
        'order_type',
        'return_user',
        'erp_order_topic',
        'erp_order_message',
        'erp_academic_name',
        'erp_paper_type',
        'papertype_desc',
        'papertype_file',
        'erp_subject_name',
        'erp_paper_format',
        'paperformat_file',
        'paperformat_desc',
        'is_paid',
        'order_price',
        'erp_team',
        'all_team',
        'erp_language_name',
        'erp_datetime',
        'erp_resource_materials',
        'erp_resource_file',
        'erp_number_Pages',
        'erp_spacing',
        'erp_powerPoint_slides',
        'erp_extra_source',
        'erp_previous',
        'erp_deadline', 
        'erp_copy_sources',
        'erp_page_summary',
        'erp_paper_outline',
        'erp_abstract_page',
        'erp_statistical_analysis',
    ];
}