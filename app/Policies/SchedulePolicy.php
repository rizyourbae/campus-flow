<?php

namespace App\Policies;

use App\Models\Schedule;
use App\Models\User;

class SchedulePolicy
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
        return $user->can('view_any_schedule');
    }

    public function view(User $user, Schedule $schedule): bool
    {
        return $user->can('view_schedule');
    }

    public function create(User $user): bool
    {
        return $user->can('create_schedule');
    }

    public function update(User $user, Schedule $schedule): bool
    {
        return $user->can('update_schedule');
    }

    public function delete(User $user, Schedule $schedule): bool
    {
        return $user->can('delete_schedule');
    }
}
