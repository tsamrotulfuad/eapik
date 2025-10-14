<?php

namespace App\Models;

use Filament\Panel;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InovasiMasyarakat extends Model
{ 
    use HasFactory;
    use HasUuid;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function indikators()
    {
        return $this->hasMany(IndikatorInovasiMasyarakat::class);
    }

    protected static function booted() 
    {
        static::updating(function ($model) {
            if ($model->isDirty('hki-document') && ($model->getOriginal('hki-document') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('hki-document'));
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('penghargaan-inovasi') && ($model->getOriginal('penghargaan-inovasi') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('penghargaan-inovasi'));
            }
        });

         static::updating(function ($model) {
            if ($model->isDirty('skt') && ($model->getOriginal('skt') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('skt'));
            }
        });
    }
}