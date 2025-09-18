<?php

namespace App\Policies;

use App\Models\Lecturer;
use App\Models\User;

class LecturerPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('Super Admin')) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_lecturer');
    }

    public function view(User $user, Lecturer $lecturer): bool
    {
        return $user->can('view_lecturer');
    }

    public function create(User $user): bool
    {
        return $user->can('create_lecturer');
    }

    public function update(User $user, Lecturer $lecturer): bool
    {
        return $user->can('update_lecturer');
    }

    public function delete(User $user, Lecturer $lecturer): bool
    {
        return $user->can('delete_lecturer');
    }
}
