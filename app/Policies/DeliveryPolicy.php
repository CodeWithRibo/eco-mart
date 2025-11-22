<?php

namespace App\Policies;

use App\Models\Delivery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Delivery $delivery): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Delivery $delivery): bool
    {
    }

    public function delete(User $user, Delivery $delivery): bool
    {
    }

    public function restore(User $user, Delivery $delivery): bool
    {
    }

    public function forceDelete(User $user, Delivery $delivery): bool
    {
    }
}
