<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usulan extends Model
{
    use HasFactory;
    use HasUuid;
    
    protected $guarded = [];

}
