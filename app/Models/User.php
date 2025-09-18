<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Support\Facades\Storage; 
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function getFilamentAvatarUrl(): ?string
    {
        // Jika ada path foto di database, buat URL publiknya
        if ($this->profile_photo_path) {
            return asset('storage/' . $this->profile_photo_path);
        }

        // Jika tidak ada, kembalikan URL default dari ui-avatars.com
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=FFFFFF&background=F59E0B';
    }
    public function isSuperAdmin(): bool
    {
        return $this->is_admin;
    }
    /**
     * Method wajib dari FilamentUser yang hilang.
     * Menentukan apakah user boleh mengakses panel admin.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Untuk sekarang, kita izinkan semua user yang terdaftar untuk bisa login ke panel.
        // Hak akses di dalam panel akan diatur oleh Roles & Permissions.
        return true;
    }
}
