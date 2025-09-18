<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
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
        return $user->can('view_any_course');
    }

    public function view(User $user, Course $course): bool
    {
        return $user->can('view_course');
    }

    public function create(User $user): bool
    {
        return $user->can('create_course');
    }

    public function update(User $user, Course $course): bool
    {
        return $user->can('update_course');
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->can('delete_course');
    }
}
