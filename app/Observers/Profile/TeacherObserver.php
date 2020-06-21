<?php

namespace App\Observers\Profile;

use App\Models\Profile\Teacher;

class TeacherObserver
{
    /**
     * Handle the teacher "retrieved" event.
     *
     * @param  \App\Models\Profile\Teacher  $teacher
     * @return void
     */
    public function retrieved(Teacher $teacher)
    {
        //
    }
    
    /**
     * Handle the teacher "created" event.
     *
     * @param  \App\Models\Profile\Teacher  $teacher
     * @return void
     */
    public function created(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "updated" event.
     *
     * @param  \App\Models\Profile\Teacher  $teacher
     * @return void
     */
    public function updated(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "deleted" event.
     *
     * @param  \App\Models\Profile\Teacher  $teacher
     * @return void
     */
    public function deleted(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "restored" event.
     *
     * @param  \App\Models\Profile\Teacher  $teacher
     * @return void
     */
    public function restored(Teacher $teacher)
    {
        //
    }

    /**
     * Handle the teacher "force deleted" event.
     *
     * @param  \App\Models\Profile\Teacher  $teacher
     * @return void
     */
    public function forceDeleted(Teacher $teacher)
    {
        //
    }
}
