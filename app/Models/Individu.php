<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Individu extends Model
{
    use HasFactory, HasUuid;

    protected $guarded = [];

    public function bantuans()
    {
        return $this->belongsToMany(Bantuan::class, 'bantuan_individu')
                    ->withPivot('tanggal_terima')
                    ->withTimestamps();
    }
}
