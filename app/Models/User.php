<?php

declare(strict_types=1);

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;
    use HasRoles;

    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'email',
        'password',
        'parent_id',
        'about',
        'image',
        'login',
        'is_admin',
        'is_confirmed',
        'telegram_username',
        'telegram_id',
        'balance',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = [
        'full_name',
        'role'
    ];

    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'program_user');
    }

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'user_lesson');
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->surname} {$this->name} {$this->patronymic}";
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return (bool) $this->is_admin;
    }

    public function achievements(): BelongsToMany
    {
        return $this->belongsToMany(Achievement::class);
    }

    public function getRoleAttribute(): ?string
    {
        return $this->getRoleNames()->first();
    }

    public function avatars(): BelongsToMany
    {
        return $this->belongsToMany(Avatar::class, 'student_avatar');
    }

    public function getAvatarAttribute(): ?string
    {
        return $this->image !== null ? env('STORAGE_PATH') . $this->image : null;
    }
}
