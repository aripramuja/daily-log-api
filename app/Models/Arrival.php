<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrival extends Model
{
    use HasFactory;
    protected $table = 'arrival';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'check_in',
        'check_out',
    ];
}
