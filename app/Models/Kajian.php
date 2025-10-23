<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kajian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class);
    }
}
