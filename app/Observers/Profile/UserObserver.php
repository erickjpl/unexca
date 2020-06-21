<?php

namespace App\Observers\Profile;

use App\Models\Profile\User;

class UserObserver
{
    /**
     * Handle the parent "retrieved" event.
     *
     * @param  \App\Models\Profile\User  $user
     * @return void
     */
    public function retrieved(User $user)
    {
        //
    }

    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\Profile\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\Profile\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\Profile\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\Profile\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\Profile\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
