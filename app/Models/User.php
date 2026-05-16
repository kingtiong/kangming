<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_TEACHER = 'teacher';
    public const ROLE_STUDENT = 'student';
    public const ROLE_CLIENT = 'client';

    public const ROLES = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_TEACHER => 'Teacher',
        self::ROLE_STUDENT => 'Student',
        self::ROLE_CLIENT => 'Client',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'branch_id',
        'date_of_birth',
        'avatar',
        'notes',
        'is_active',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'date_of_birth' => 'date',
            'is_active' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function teachingBranches(): HasMany
    {
        return $this->hasMany(Branch::class, 'teacher_in_charge_id');
    }

    public function teachingSections(): HasMany
    {
        return $this->hasMany(Section::class, 'teacher_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isTeacher(): bool
    {
        return $this->role === self::ROLE_TEACHER;
    }

    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function isClient(): bool
    {
        return $this->role === self::ROLE_CLIENT;
    }

    public function isMember(): bool
    {
        return in_array($this->role, [self::ROLE_STUDENT, self::ROLE_CLIENT], true);
    }
}
