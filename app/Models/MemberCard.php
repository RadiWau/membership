<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MemberCard extends Model
{

    protected $table = 'member_card';
    protected $primaryKey = 'member_id';
    protected $fillable = [
        'user_id',
        'member_card_no',
        'status',
        'created_at',
        'created_by'
    ];
}
