<?php

namespace App\Observers\School;

use Illuminate\Support\Facades\DB;
use App\Models\Shool\ClassroomStudent;
use App\Models\Profile\User;

class ClassroomStudentObserver
{
    /**
     * Handle the classroom student "created" event.
     *
     * @param  \App\Models\Shool\ClassroomStudent  $classroomStudent
     * @return void
     */
    public function created(ClassroomStudent $classroomStudent)
    {
        try {
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $classroomStudent->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $classroomStudent->toJson(),
                    'user_id' => $auth->id,
                    'create_at' => now(),
                ]);

            DB::commit();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException\ModelNotFoundException $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Handle the classroom student "updated" event.
     *
     * @param  \App\Models\Shool\ClassroomStudent  $classroomStudent
     * @return void
     */
    public function updated(ClassroomStudent $classroomStudent)
    {
        //
    }

    /**
     * Handle the classroom student "deleted" event.
     *
     * @param  \App\Models\Shool\ClassroomStudent  $classroomStudent
     * @return void
     */
    public function deleted(ClassroomStudent $classroomStudent)
    {
        //
    }

    /**
     * Handle the classroom student "restored" event.
     *
     * @param  \App\Models\Shool\ClassroomStudent  $classroomStudent
     * @return void
     */
    public function restored(ClassroomStudent $classroomStudent)
    {
        //
    }

    /**
     * Handle the classroom student "force deleted" event.
     *
     * @param  \App\Models\Shool\ClassroomStudent  $classroomStudent
     * @return void
     */
    public function forceDeleted(ClassroomStudent $classroomStudent)
    {
        //
    }
}
