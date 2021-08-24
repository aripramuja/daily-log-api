<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $table = 'position';
    public $timestamps = false;

    protected $fillable = [
        'parent_id',
        'position',
        'org_unit',
        'level'
    ];
}
