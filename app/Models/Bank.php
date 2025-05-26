<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bank extends Model
{

    protected $table = 'm_bank';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sandi_bank',
        'nama_bank'
    ];
}
