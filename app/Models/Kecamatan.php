<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kecamatan extends Model
{

    protected $table = 'm_kecamatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kabupaten_id',
        'nama'
    ];
}
