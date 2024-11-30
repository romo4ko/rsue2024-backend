<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Exercise extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'type',
        'condition',
        'answers',
        'points',
        'lesson_id'
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    public function teachers(): HasMany
    {
        return $this->hasMany(User::class, 'teacher_id');
    }

    public function program(): HasOne
    {
        return $this->hasOne(Program::class);
    }

    public function lesson(): HasOne
    {
        return $this->hasOne(Lesson::class);
    }
}
