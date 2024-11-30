<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Solution extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'answer',
        'mark',
        'student_id',
        'teacher_id',
        'exercise_id',
        'verified_at',
    ];

    public function teacher(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function student(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function exercise(): HasOne
    {
        return $this->hasOne(Exercise::class);
    }
}
