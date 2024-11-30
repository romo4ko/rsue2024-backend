<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lesson extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'theory',
        'program_id',
        'points',
    ];

    public function teachers(): HasMany
    {
        return $this->hasMany(User::class, 'teacher_id');
    }

    public function program(): HasOne
    {
        return $this->hasOne(Program::class);
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
