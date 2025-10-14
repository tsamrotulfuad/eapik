<?php

namespace App\Models;

use Filament\Panel;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InovasiPerangkatDaerah extends Model
{
    use HasFactory;
    use HasUuid;

    protected $guarded = [];

    protected $casts = [
        'urusan_inovasi' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function indikators()
    {
        return $this->hasMany(IndikatorInovasiPerangkatDaerah::class, 'inovasi_id', 'id');
    }

    protected static function booted() 
    {
        static::updating(function ($model) {
            if ($model->isDirty('anggaran_inovasi') && ($model->getOriginal('anggaran_inovasi') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('anggaran_inovasi'));
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('profilbisnis_inovasi') && ($model->getOriginal('profilbisnis_inovasi') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('profilbisnis_inovasi'));
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('hki_inovasi') && ($model->getOriginal('hki_inovasi') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('hki_inovasi'));
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('penghargaan_inovasi') && ($model->getOriginal('penghargaan_inovasi') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('penghargaan_inovasi'));
            }
        });
    }
}
