<?php

namespace App\Models;

use Filament\Panel;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
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
}
