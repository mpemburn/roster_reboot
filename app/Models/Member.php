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
 * @property $user_id;
 * @property $prefix;
 * @property $first_name;
 * @property $middle_name;
 * @property $last_name;
 * @property $suffix;
 * @property $member_since_date;
 * @property $member_end_date;
 * @property $date_of_birth;
 * @property $time_of_birth;
 * @property $place_of_birth;
 */
class Member extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'active',
        'user_id',
        'prefix',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'member_since_date',
        'member_end_date',
        'date_of_birth',
        'time_of_birth',
        'place_of_birth',
    ];

}
