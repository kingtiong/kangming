<?php

namespace App\Models;

use App\Models\Concerns\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'name',
        'name_zh_CN',
        'name_zh_TW',
        'code',
        'address',
        'phone',
        'email',
        'teacher_in_charge_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function teacherInCharge(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_in_charge_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }
}
