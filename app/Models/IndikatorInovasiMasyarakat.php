<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndikatorInovasiMasyarakat extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted() 
    {
        parent::boot();

        static::creating(function($model) {
            $model->user_id = Auth::user()->id;
        });

        static::creating(function($model) {
            $model->tahun = Carbon::now()->format('Y');
        });

        static::updating(function ($model) {
            if ($model->isDirty('kemanfaatan_upload') && ($model->getOriginal('kemanfaatan_upload') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('kemanfaatan_upload'));
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('sosialisasi_upload') && ($model->getOriginal('sosialisasi_upload') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('sosialisasi_upload'));
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('video_inovasi') && ($model->getOriginal('video_inovasi') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('video_inovasi'));
            }
        });
        
    }

    public function inovasi()
    {
        return $this->belongsTo(InovasiMasyarakat::class);
    }
}