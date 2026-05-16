<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\App;

trait Translatable
{
    public function localized(string $field): ?string
    {
        $value = $this->getAttribute($field . '_' . App::getLocale());

        return $value !== null && $value !== '' ? $value : $this->getAttribute($field);
    }
}
