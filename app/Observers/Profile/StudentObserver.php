<?php

namespace App\Observers\Profile;

use App\Models\Profile\Student;

class StudentObserver
{
    /**
     * Handle the student "retrieved" event.
     *
     * @param  \App\Models\Profile\Student  $student
     * @return void
     */
    public function retrieved(Student $student)
    {
        //
    }
    
    /**
     * Handle the app models profile student "created" event.
     *
     * @param  App\Models\Profile\Student  $student
     * @return void
     */
    public function created(Student $student)
    {
        //
    }

    /**
     * Handle the app models profile student "updated" event.
     *
     * @param  App\Models\Profile\Student  $student
     * @return void
     */
    public function updated(Student $student)
    {
        //
    }

    /**
     * Handle the app models profile student "deleted" event.
     *
     * @param  App\Models\Profile\Student  $student
     * @return void
     */
    public function deleted(Student $student)
    {
        //
    }

    /**
     * Handle the app models profile student "restored" event.
     *
     * @param  App\Models\Profile\Student  $student
     * @return void
     */
    public function restored(Student $student)
    {
        //
    }

    /**
     * Handle the app models profile student "force deleted" event.
     *
     * @param  App\Models\Profile\Student  $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        //
    }
}
