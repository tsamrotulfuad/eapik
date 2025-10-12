<?php

namespace App\Models;

use Filament\Panel;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use HasPanelShield;

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            default => false,
            'superadmin'  => $this->hasRole('super_admin'),
            'admin'       => $this->hasRole(['panel_admin', 'super_admin']),
            'kepegawaian' => $this->hasRole('panel_user') || $this->hasRole('super_admin'),
            'kemiskinan'  => $this->hasRole('panel_user') || $this->hasRole('super_admin'),
            'perencanaan' => $this->hasRole('panel_user') || $this->hasRole('super_admin'),
            'brida'       => $this->hasRole('panel_brida') || $this->hasRole('super_admin'),
            'masyarakat'  => $this->hasRole('panel_masyarakat'),
            // 'masyarakat'  => str_ends_with($this->username, 'masyarakat') || $this->hasVerifiedEmail(),
            'perangkatdaerah' => $this->hasRole('panel_perangkat_daerah'),
        };
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
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
