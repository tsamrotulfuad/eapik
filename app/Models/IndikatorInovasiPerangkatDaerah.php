<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndikatorInovasiPerangkatDaerah extends Model
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
    }

    public function inovasi()
    {
        return $this->belongsTo(InovasiPerangkatDaerah::class);
    }
}
