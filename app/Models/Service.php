<?php

namespace App\Models;

use App\Models\Concerns\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'name',
        'name_zh_CN',
        'name_zh_TW',
        'slug',
        'category',
        'audience',
        'description',
        'description_zh_CN',
        'description_zh_TW',
        'duration_minutes',
        'default_price',
        'is_active',
    ];

    protected $casts = [
        'duration_minutes' => 'integer',
        'default_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function charges(): HasMany
    {
        return $this->hasMany(Charge::class);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }
}
