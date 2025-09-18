<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * "Jalur VVIP" untuk Super Admin.
     * Method ini akan dijalankan pertama kali. Jika user adalah Super Admin, dia langsung diizinkan.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }
        return null; // Jika bukan Super Admin, lanjutkan ke pengecekan di bawah
    }

    /**
     * Boleh liat daftar user?
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_user');
    }

    /**
     * Boleh liat detail user?
     */
    public function view(User $user, User $model): bool
    {
        return $user->can('view_user');
    }

    /**
     * Boleh bikin user baru?
     */
    public function create(User $user): bool
    {
        return $user->can('create_user');
    }

    /**
     * Boleh update user?
     */
    public function update(User $user, User $model): bool
    {
        return $user->can('update_user');
    }

    /**
     * Boleh hapus user?
     */
    public function delete(User $user, User $model): bool
    {
        return $user->can('delete_user');
    }
}
