<?php

namespace App\Models;

use App\Models\Concerns\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'name',
        'name_zh_CN',
        'name_zh_TW',
        'code',
        'service_id',
        'branch_id',
        'teacher_id',
        'audience',
        'capacity',
        'starts_on',
        'ends_on',
        'description',
        'description_zh_CN',
        'description_zh_TW',
        'status',
    ];

    protected $casts = [
        'capacity' => 'integer',
        'starts_on' => 'date',
        'ends_on' => 'date',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
