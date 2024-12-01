<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'image',
        'price',
    ];

    protected $appends = [
        'url',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'student_avatar');
    }

    public function getUrlAttribute($value)
    {
        return env('STORAGE_PATH') . $this->image;
    }
}
