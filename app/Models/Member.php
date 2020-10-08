<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * Class Member
 * @package App\Models
 *
 * @property $active;
 * @property $first_name;
 * @property $middle_name;
 * @property $last_name;
 */
class Member extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'active',
        'first_name',
        'middle_name',
        'last_name',
    ];

}
