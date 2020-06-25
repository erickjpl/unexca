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
            DB::beginTransaction();
                $classroomStudent->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $classroomStudent->toJson(),
                    'user_id' => auth()->id ?? 1,
                    'create_at' => now(),
                ]);

            DB::commit();
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
        try { 
            DB::beginTransaction();
                $classroomStudent->audits()->create([
                    'type' => 'update',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => '{}',
                    'user_id' => auth()->id ?? 1,
                    'create_at' => now(),
                ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Handle the classroom student "deleted" event.
     *
     * @param  \App\Models\Shool\ClassroomStudent  $classroomStudent
     * @return void
     */
    public function deleted(ClassroomStudent $classroomStudent)
    {
        try { 
            DB::beginTransaction();
                $classroomStudent->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $classroomStudent->toJson(),
                    'user_id' => auth()->id ?? 1,
                    'create_at' => now(),
                ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
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
