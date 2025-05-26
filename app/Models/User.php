<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $guard = 'web';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'username',
        'nama_lengkap',
        'email',
        'no_hp',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'alamat',
        'bank',
        'atas_nama',
        'norek',
        'status',
        'last_login',
        'ip_address',
        'created_at',
        'created_by'
    ];

    protected $hidden = [
        'password'
    ];

}
