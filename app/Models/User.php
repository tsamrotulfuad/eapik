<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            default => false,
            'admin' => str_starts_with($this->name, 'Super Admin') && $this->hasRole('super_admin'),
            'kepegawaian' => str_starts_with($this->name, 'Admin') && $this->hasRole('panel_admin'),
            'kemiskinan' => str_starts_with($this->name, 'Admin') && $this->hasRole('panel_admin'),
            'perencanaan' => str_starts_with($this->name, 'Admin') && $this->hasRole('panel_admin'),
            // 'perangkat_daerah' => $this->hasRole('panel_user'),
        };
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function bantuan() : HasMany
    {
        return $this->hasMany(Bantuan::class);
    }
}
