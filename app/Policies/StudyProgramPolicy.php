<?php

namespace App\Policies;

use App\Models\StudyProgram;
use App\Models\User;

class StudyProgramPolicy
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
        return $user->can('view_any_studyprogram');
    }

    public function view(User $user, StudyProgram $studyProgram): bool
    {
        return $user->can('view_studyprogram');
    }

    public function create(User $user): bool
    {
        return $user->can('create_studyprogram');
    }

    public function update(User $user, StudyProgram $studyProgram): bool
    {
        return $user->can('update_studyprogram');
    }

    public function delete(User $user, StudyProgram $studyProgram): bool
    {
        return $user->can('delete_studyprogram');
    }
}
