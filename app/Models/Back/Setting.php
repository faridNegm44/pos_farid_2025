<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'app_name', 'description', 'footer_text', 'address', 'email', 'phone1', 'phone2', 'policy', 'cost_price', 'logo', 'fav_icon', 'mail_driver', 'from', 'to', 'host', 'port', 'encryption', 'username', 'password', 'maintenance_mode'    
    ];
}