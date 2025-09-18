<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Sertifikat extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        parent::boot();

        static::updating(function ($model) {
            if($model->isDirty('file_sert') && ($model->getOriginal('file_sert') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('file_sert'));
            }
        });
    }
}
