<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;
    protected $table = 'presence';
    public $timestamps = false;

    protected $fillable = [
        'temperature',
        'conditions',
        'city',
        'latitude',
        'longitude',
        'notes',
        'date',
        'check_in_time',
        'check_out_time',
        'id_user'
    ];
}
