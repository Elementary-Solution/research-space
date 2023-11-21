<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_facebook_login_on', 'facebook_login_key', 'is_google_login_on', 'google_login_key'
    ];

}
