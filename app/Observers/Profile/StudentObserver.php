<?php

namespace App\Observers\Profile;

use Illuminate\Support\Facades\DB;
use App\Models\Profile\Student;
use App\Models\Profile\User;

class StudentObserver
{    
    /**
     * Handle the app models profile student "created" event.
     *
     * @param  App\Models\Profile\Student  $student
     * @return void
     */
    public function created(Student $student)
    {
        try { 
            DB::beginTransaction();
                $student->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $student->toJson(),
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
     * Handle the app models profile student "updated" event.
     *
     * @param  App\Models\Profile\Student  $student
     * @return void
     */
    public function updated(Student $student)
    {
        try { 
            DB::beginTransaction();
                $student->audits()->create([
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
     * Handle the app models profile student "deleted" event.
     *
     * @param  App\Models\Profile\Student  $student
     * @return void
     */
    public function deleted(Student $student)
    {
        try { 
            DB::beginTransaction();
                $student->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $student->toJson(),
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
