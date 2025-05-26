<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LogsSubMember extends Model
{

    protected $table = 'logs_submember';
    protected $primaryKey = 'logs_submember_id';
    protected $fillable = [
        'parent_user',
        'user_id',
        'aktifitas',
        'created_at',
        'created_by'
    ];
}
