<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $guard = 'admin';
    protected $primaryKey = 'admin_id';
    protected $fillable = [
        'admin_id',
        'admin_name',
        'admin_email',
        'admin_role',
        'admin_status',
        'last_login',
        'ip_address',
        'created_at',
        'created_by'
    ];

    protected $hidden = [
        'password'
    ];

}
