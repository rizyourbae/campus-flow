<?php

namespace App\Policies;

use App\Models\LandingPageContent;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LandingPageContentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function before(User $user, string $ability): bool|null
    {
        return $user->hasRole('Super Admin') ? true : false;
    }
}
