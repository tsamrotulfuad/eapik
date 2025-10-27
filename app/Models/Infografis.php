<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Infografis extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'tag' => 'array',
        'file_infografis' => 'array'
    ];

    protected static function booted() 
    {
        static::updating(function ($model) {
            if ($model->isDirty('file_infografis') && ($model->getOriginal('file_infografis') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('file_infografis'));
            }
        });
    }

    public function kajian(): BelongsTo
    {
        return $this->belongsTo(Kajian::class);
    }

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class);
    }
}
