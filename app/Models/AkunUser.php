<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class AkunUser extends Authenticatable implements FilamentUser
{
    use HasRoles;
    protected $table = 'akun_user';

    protected $primaryKey = 'id_user';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'role',
        'nim',
        'nama_user',
        'jenis_kelamin',
        'no_hp',
        'email',
        'id_jabatan',
        'foto_profil',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthIdentifierName(): string
    {
        return 'username';
    }

    public function getAuthPassword(): string
    {
        return $this->password;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['Admin', 'Bendahara','Anggota']);
    }

    public function getFilamentName(): string
    {
        return $this->nama_user;
    }

    public function getNameAttribute(): string
    {
        return $this->nama_user;
    }

    protected static function booted()
    {
        static::saved(function ($user) {
            if ($user->role) {
                try {
                    $user->syncRoles($user->role);
                } catch (\Exception $e) {
                    // Silently ignore if Spatie table is missing or doesn't exist
                }
            }
        });
    }

    public function pembayaranIuran()
    {
        return $this->hasMany(
            PembayaranIuran::class,
            'id_user',
            'id_user'
        );
    }

    public function jabatan()
    {
        return $this->belongsTo(
            Jabatan::class,
            'id_jabatan',
            'id_jabatan'
        );
    }
}

