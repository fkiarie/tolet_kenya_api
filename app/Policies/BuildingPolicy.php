<?php

namespace App\Policies;

use App\Models\Building;
use App\Models\User;

class BuildingPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // All users can list buildings
    }

    public function view(User $user, Building $building): bool
    {
        return $user->role === 'admin' ||
            ($user->role === 'landlord' && $building->landlord->user_id === $user->id);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['landlord', 'admin']);
    }

    public function update(User $user, Building $building): bool
    {
        
        return $user->role === 'admin' ||
            ($user->role === 'landlord' && $building->landlord->user_id === $user->id);
    }

    public function delete(User $user, Building $building): bool
    {
        return $user->role === 'admin' ||
            ($user->role === 'landlord' && $building->landlord->user_id === $user->id);
    }
}
