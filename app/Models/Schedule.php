<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'teacher_id',
        'starts_at',
        'ends_at',
        'room',
        'capacity',
        'status',
        'notes',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'capacity' => 'integer',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function activeBookingsCount(): int
    {
        return $this->bookings()->whereNotIn('status', ['cancelled', 'no_show'])->count();
    }

    public function remainingCapacity(): int
    {
        $cap = $this->capacity ?? optional($this->section)->capacity ?? 0;
        return max(0, $cap - $this->activeBookingsCount());
    }
}
