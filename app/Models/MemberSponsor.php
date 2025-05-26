<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MemberSponsor extends Model
{

    protected $table = 'member_sponsor';
    protected $primaryKey = 'sponsor_id';
    protected $fillable = [
        'sponsor_code',
        'user_id',
        'created_at',
        'created_by'
    ];
}
