<?php

namespace App\Policies;

use App\Models\Bulo;
use App\Models\User;

class BuloPolicy
{
    /**
     * Determina si el usuario puede actualizar el bulo
     */
    public function update(User $user, Bulo $bulo): bool
    {
        return $bulo->user_id === $user->id;
    }

    /**
     * Determina si el usuario puede eliminar el bulo
     */
    public function delete(User $user, Bulo $bulo): bool
    {
        return $bulo->user_id === $user->id;
    }
}
