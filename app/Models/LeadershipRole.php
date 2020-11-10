<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipRole extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'abbreviation',
        'role_name',
        'group_name',
        'level'
    ];
}
