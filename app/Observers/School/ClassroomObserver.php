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
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $classroom->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $classroom->toJson(),
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
     * Handle the classroom "updated" event.
     *
     * @param  \App\Models\Shool\Classroom  $classroom
     * @return void
     */
    public function updated(Classroom $classroom)
    {
        //
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
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $classroom->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'new' => '{}',
                    'old' => $classroom->toJson(),
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
