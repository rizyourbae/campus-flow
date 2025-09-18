<?php

namespace App\Policies;

use App\Models\Room;
use App\Models\User;

class RoomPolicy
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
        return $user->can('view_any_room');
    }

    public function view(User $user, Room $room): bool
    {
        return $user->can('view_room');
    }

    public function create(User $user): bool
    {
        return $user->can('create_room');
    }

    public function update(User $user, Room $room): bool
    {
        return $user->can('update_room');
    }

    public function delete(User $user, Room $room): bool
    {
        return $user->can('delete_room');
    }
}
