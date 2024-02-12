<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

class ProjectPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
            // ? Response::allow()
            // : Response::deny('You do not own this project.');
    }

    public function show(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }

    public function destroy(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }
}
