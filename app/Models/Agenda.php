<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }
}
