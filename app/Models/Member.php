<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

/**
 * Class Member
 * @package App\Models
 *
 * @property $active;
 * @property $user_id;
 * @property $prefix_id;
 * @property $first_name;
 * @property $middle_name;
 * @property $last_name;
 * @property $suffix_id;
 * @property $magickal_name;
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
        'prefix_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix_id',
        'magickal_name',
        'member_since_date',
        'member_end_date',
        'date_of_birth',
        'time_of_birth',
        'place_of_birth',
    ];

    public function prefix(): HasOne
    {
        return $this->hasOne(Prefix::class);
    }

    public function suffix(): HasOne
    {
        return $this->hasOne(Suffix::class);
    }
}
