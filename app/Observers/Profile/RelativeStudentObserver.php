<?php

namespace App\Observers\Profile;

use App\Models\Profile\RelativeStudent;

class RelativeStudentObserver
{
    /**
     * Handle the relativeStudent "retrieved" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function retrieved(RelativeStudent $relativeStudent)
    {
        //
    }
    
    /**
     * Handle the relativeStudent "created" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function created(RelativeStudent $relativeStudent)
    {
        //
    }

    /**
     * Handle the relativeStudent "updated" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function updated(RelativeStudent $relativeStudent)
    {
        //
    }

    /**
     * Handle the relativeStudent "deleted" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function deleted(RelativeStudent $relativeStudent)
    {
        //
    }

    /**
     * Handle the relativeStudent "restored" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function restored(RelativeStudent $relativeStudent)
    {
        //
    }

    /**
     * Handle the relativeStudent "force deleted" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function forceDeleted(RelativeStudent $relativeStudent)
    {
        //
    }
}
