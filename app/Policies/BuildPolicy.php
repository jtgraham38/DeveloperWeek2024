<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Build;

class BuildPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function download(User $user, Build $build): bool
    {
        return $user->id === $build->project->user_id;
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->id === $build->project->user_id;
    }
}
