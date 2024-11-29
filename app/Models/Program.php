<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public function teachers(): HasMany
    {
        return $this->hasMany(User::class, 'teacher_id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
