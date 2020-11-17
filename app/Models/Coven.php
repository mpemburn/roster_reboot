<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coven extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'abbreviation',
        'wheel',
        'element',
    ];

}
