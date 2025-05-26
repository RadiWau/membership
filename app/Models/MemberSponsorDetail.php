<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MemberSponsorDetil extends Model
{

    protected $table = 'member_sponsor_details';
    protected $primaryKey = 'sponsor_detail_id';
    protected $fillable = [
        'sequence_id',
        'sponsor_code',
        'user_id',
        'created_at',
        'created_by'
    ];
}
