<?php

namespace App\Observers\School;

use Illuminate\Support\Facades\DB;
use App\Models\Shool\Classroom;
use App\Models\Profile\User;

class ClassroomObserver
{
    /**
     * Handle the classroom "created" event.
     *
     * @param  \App\Models\Shool\Classroom  $classroom
     * @return void
     */
    public function created(Classroom $classroom)
    {
        try { 
            DB::beginTransaction();
                $classroom->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $classroom->toJson(),
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
     * Handle the classroom "updated" event.
     *
     * @param  \App\Models\Shool\Classroom  $classroom
     * @return void
     */
    public function updated(Classroom $classroom)
    {
        try { 
            DB::beginTransaction();
                $classroom->audits()->create([
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
     * Handle the classroom "deleted" event.
     *
     * @param  \App\Models\Shool\Classroom  $classroom
     * @return void
     */
    public function deleted(Classroom $classroom)
    {
        try { 
            DB::beginTransaction();
                $classroom->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $classroom->toJson(),
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
     * Handle the classroom "restored" event.
     *
     * @param  \App\Models\Shool\Classroom  $classroom
     * @return void
     */
    public function restored(Classroom $classroom)
    {
        //
    }

    /**
     * Handle the classroom "force deleted" event.
     *
     * @param  \App\Models\Shool\Classroom  $classroom
     * @return void
     */
    public function forceDeleted(Classroom $classroom)
    {
        //
    }
}
