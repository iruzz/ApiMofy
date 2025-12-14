<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'site_title',
        'logo',
        'address',
        'email_contact',
        'instagram',
        'li',
        'facebook'
    ];
}
