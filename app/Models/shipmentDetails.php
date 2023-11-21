<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipmentDetails extends Model
{
    use HasFactory;

     protected $fillable =[
         'user_id',
         'order_id',
         'billing_first_name',
         'billing_last_name',
         'billing_country',
         'billing_zip_code',
         'billing_street_address',
         'billing_apartment_detail',
         'billing_email',
         'billing_city',
         'billing_state',
         'billing_phone',
       ];


    public $timestamps = false;

}

