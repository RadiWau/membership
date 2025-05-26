<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Provinsi extends Model
{

    protected $table = 'm_provinsi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nama'
    ];
}
