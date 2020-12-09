<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Coven
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Member[] $members
 * @property-read int|null $members_count
 * @method static \Illuminate\Database\Eloquent\Builder|Coven newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coven newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coven query()
 */
	class Coven extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Element
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Element newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Element newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Element query()
 */
	class Element extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Email
 *
 * @package App\Models
 * @property $email
 * @property-read \App\Models\Member $member
 * @method static \Illuminate\Database\Eloquent\Builder|Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Email query()
 */
	class Email extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LeadershipRole
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LeadershipRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LeadershipRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LeadershipRole query()
 */
	class LeadershipRole extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Member
 *
 * @package App\Models
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
 * @property $coven_id;
 * @property int $id
 * @property int $active
 * @property int|null $user_id
 * @property \App\Models\Prefix|null $prefix
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property \App\Models\Suffix|null $suffix
 * @property string|null $member_since_date
 * @property string|null $member_end_date
 * @property string|null $date_of_birth
 * @property string|null $time_of_birth
 * @property string|null $place_of_birth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coven $coven
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Email[] $emails
 * @property-read int|null $emails_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereMemberEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereMemberSinceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereSuffix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereTimeOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUserId($value)
 */
	class Member extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Prefix
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Prefix newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prefix newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prefix query()
 */
	class Prefix extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SecurityQuestion
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SecurityQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SecurityQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SecurityQuestion query()
 */
	class SecurityQuestion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\State
 *
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 */
	class State extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Suffix
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Suffix newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Suffix newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Suffix query()
 */
	class Suffix extends \Eloquent {}
}

namespace App\Models{
/**
 * Class User
 *
 * @package App\Models
 * @property $id
 * @property $name
 * @property $email
 * @property $password
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \App\Models\Member $member
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Wheel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Wheel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wheel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wheel query()
 */
	class Wheel extends \Eloquent {}
}

namespace App\Permissions{
/**
 * App\Permissions\RosterRole
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|RosterRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RosterRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|RosterRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|RosterRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RosterRole whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RosterRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RosterRole whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RosterRole whereUpdatedAt($value)
 */
	class RosterRole extends \Eloquent {}
}

