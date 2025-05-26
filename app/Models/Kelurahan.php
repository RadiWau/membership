<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kelurahan extends Model
{

    protected $table = 'm_kelurahan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kecamatan_id',
        'nama'
    ];
}
