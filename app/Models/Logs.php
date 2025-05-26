<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Logs extends Model
{

    protected $table = 'logs';
    protected $primaryKey = 'logs';
    protected $fillable = [
        'user_id',
        'aktifitas',
        'created_at',
        'created_by'
    ];
}
