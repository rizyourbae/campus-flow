<?php

namespace App\Policies;

use App\Models\AcademicYear;
use App\Models\User;

class AcademicYearPolicy
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
        return $user->can('view_any_academicyear');
    }

    public function view(User $user, AcademicYear $academicYear): bool
    {
        return $user->can('view_academicyear');
    }

    public function create(User $user): bool
    {
        return $user->can('create_academicyear');
    }

    public function update(User $user, AcademicYear $academicYear): bool
    {
        return $user->can('update_academicyear');
    }

    public function delete(User $user, AcademicYear $academicYear): bool
    {
        return $user->can('delete_academicyear');
    }
}
