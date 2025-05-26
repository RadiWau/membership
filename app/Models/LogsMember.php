<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LogsMember extends Model
{

    protected $table = 'logs_member';
    protected $primaryKey = 'log_member_id';
    protected $fillable = [
        'user_id',
        'aktifitas',
        'created_at',
        'created_by'
    ];
}
