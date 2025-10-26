<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Infografis extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kajian(): BelongsTo
    {
        return $this->belongsTo(Kajian::class);
    }
}
