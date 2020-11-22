<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
