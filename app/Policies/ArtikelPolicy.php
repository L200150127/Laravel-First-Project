<?php

namespace App\Policies;

use App\User;
use App\Artikel;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtikelPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the artikel.
     *
     * @param  \App\User  $user
     * @param  \App\Artikel  $artikel
     * @return mixed
     */
    public function view(User $user, Artikel $artikel)
    {
        //
    }

    /**
     * Determine whether the user can create artikels.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the artikel.
     *
     * @param  \App\User  $user
     * @param  \App\Artikel  $artikel
     * @return mixed
     */
    public function update(User $user, Artikel $artikel)
    {
        return $user->id === $artikel->id_user;
    }

    /**
     * Determine whether the user can delete the artikel.
     *
     * @param  \App\User  $user
     * @param  \App\Artikel  $artikel
     * @return mixed
     */
    public function delete(User $user, Artikel $artikel)
    {
        return $user->id === $artikel->id_user;
    }

    /**
     * Determine whether the user can permanently delete the artikel.
     *
     * @param  \App\User  $user
     * @param  \App\Artikel  $artikel
     * @return mixed
     */
    public function forceDelete(User $user, Artikel $artikel)
    {
        return $user->id === 'admin';
    }
}
