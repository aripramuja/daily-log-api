<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPekerjaan extends Model
{
    use HasFactory;
    protected $table = 'sub_pekerjaan';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'durasi',
        'tanggal',
        'status',
        'saran',
        'id_pekerjaan',
        'id_user'
    ];
}
