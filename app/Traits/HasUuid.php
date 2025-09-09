<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    /**
     * Auto-generate UUID ketika creating.
     */
    public static function bootHasUuid(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Laravel otomatis akan pakai 'uuid' untuk route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }
}
