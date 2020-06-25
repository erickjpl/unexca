<?php

namespace App\Observers\Profile;

use Illuminate\Support\Facades\DB;
use App\Models\Profile\Teacher;
use App\Models\Profile\User;

class TeacherObserver
{    
    /**
     * Handle the teacher "created" event.
     *
     * @param  \App\Models\Profile\Teacher  $teacher
     * @return void
     */
    public function created(Teacher $teacher)
    {
        try { 
            DB::beginTransaction();
                $teacher->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $teacher->toJson(),
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
     * Handle the teacher "updated" event.
     *
     * @param  \App\Models\Profile\Teacher  $teacher
     * @return void
     */
    public function updated(Teacher $teacher)
    {
        try { 
            DB::beginTransaction();
                $teacher->audits()->create([
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
     * Handle the teacher "deleted" event.
     *
     * @param  \App\Models\Profile\Teacher  $teacher
     * @return void
     */
    public function deleted(Teacher $teacher)
    {
        try { 
            DB::beginTransaction();
                $teacher->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $teacher->toJson(),
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
