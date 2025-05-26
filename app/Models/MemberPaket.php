<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MemberPaket extends Model
{

    protected $table = 'member_paket';
    protected $primaryKey = 'paket_id';
    protected $fillable = [
        'paket_id',
        'paket_level',
        'user_id',
        'image_topup',
        'saldo',
        'status_paket',
        'created_by'
    ];
}
