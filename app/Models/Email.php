<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Email
 * @package App\Models
 *
 * @property $email
 */
class Email extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'email',
        'is_primary',
        'description'
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
