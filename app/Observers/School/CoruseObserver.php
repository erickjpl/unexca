<?php

namespace App\Observers\School;

use Illuminate\Support\Facades\DB;
use App\Models\Shool\Course;
use App\Models\Profile\User;

class CoruseObserver
{
    /**
     * Handle the course "created" event.
     *
     * @param  \App\Models\Shool\Course  $course
     * @return void
     */
    public function created(Course $course)
    {
        try { 
            DB::beginTransaction();
                $course->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $course->toJson(),
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
     * Handle the course "updated" event.
     *
     * @param  \App\Models\Shool\Course  $course
     * @return void
     */
    public function updated(Course $course)
    {
        try { 
            DB::beginTransaction();
                $course->audits()->create([
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
     * Handle the course "deleted" event.
     *
     * @param  \App\Models\Shool\Course  $course
     * @return void
     */
    public function deleted(Course $course)
    {
        try { 
            DB::beginTransaction();
                $course->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $course->toJson(),
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
     * Handle the course "restored" event.
     *
     * @param  \App\Models\Shool\Course  $course
     * @return void
     */
    public function restored(Course $course)
    {
        //
    }

    /**
     * Handle the course "force deleted" event.
     *
     * @param  \App\Models\Shool\Course  $course
     * @return void
     */
    public function forceDeleted(Course $course)
    {
        //
    }
}