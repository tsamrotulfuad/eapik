<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inovasi extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    protected static function booted()
    {
        parent::boot();

        static::updating(function ($model) {
            if($model->isDirty('file_inovasi_iga') && ($model->getOriginal('file_inovasi_iga') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('file_inovasi_iga'));
            }
        });
    }
}
