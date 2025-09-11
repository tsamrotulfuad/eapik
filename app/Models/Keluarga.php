<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keluarga extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    public function individues()
    {
        return $this->hasMany(Individu::class);
    }

    public function bantuans()
    {
        return $this->belongsToMany(Bantuan::class, 'bantuan_keluarga')
            ->withPivot('tanggal_terima')
            ->withTimestamps();
    }
}
