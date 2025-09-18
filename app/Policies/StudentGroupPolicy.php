<?php

namespace App\Policies;

use App\Models\StudentGroup;
use App\Models\User;

class StudentGroupPolicy
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
        return $user->can('view_any_studentgroup');
    }

    public function view(User $user, StudentGroup $studentGroup): bool
    {
        return $user->can('view_studentgroup');
    }

    public function create(User $user): bool
    {
        return $user->can('create_studentgroup');
    }

    public function update(User $user, StudentGroup $studentGroup): bool
    {
        return $user->can('update_studentgroup');
    }

    public function delete(User $user, StudentGroup $studentGroup): bool
    {
        return $user->can('delete_studentgroup');
    }
}
