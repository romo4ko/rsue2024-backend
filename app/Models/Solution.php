<?php

namespace App\Models;

use App\Models\Enums\SolutionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Solution extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'answer',
        'mark',
        'comment',
        'student_id',
        'teacher_id',
        'exercise_id',
        'verified_at',
    ];

    protected $casts = [
        'answer' => 'array',
    ];

    protected $appends = [
        'status'
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

    public function isSolved(): bool
    {
        return null !== $this->mark;
    }

    public function getStatusAttribute(): SolutionStatus
    {
        if ($this->answer !== null && $this->isSolved()) {
            return SolutionStatus::COMPLETED;
        }
        elseif ($this->answer !== null && !$this->isSolved()) {
            return SolutionStatus::NOT_VERIFIED;
        } else {
            return SolutionStatus::IN_PROCESS;
        }
    }
}
