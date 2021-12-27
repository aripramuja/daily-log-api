<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Staudenmeir\LaravelCte\Eloquent\QueriesExpressions;

class Pengguna extends Model
{
    use HasFactory;
    // use QueriesExpressions;
    protected $table = 'user';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'jabatan',
        'nip',
        'position_id',
        'atasan_id',
        'foto'
    ];
}
