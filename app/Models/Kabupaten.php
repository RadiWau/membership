<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kabupaten extends Model
{

    protected $table = 'm_kabupaten';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'provinsi_id',
        'nama'
    ];
}
