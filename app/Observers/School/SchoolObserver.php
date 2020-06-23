<?php

namespace App\Observers\School;

use Illuminate\Support\Facades\DB;
use App\Models\Shool\School;
use App\Models\Profile\User;

class SchoolObserver
{
    /**
     * Handle the school "created" event.
     *
     * @param  \App\Models\Shool\School  $school
     * @return void
     */
    public function created(School $school)
    {
        try {
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $school->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $school->toJson(),
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
     * Handle the school "updated" event.
     *
     * @param  \App\Models\Shool\School  $school
     * @return void
     */
    public function updated(School $school)
    {
        //
    }

    /**
     * Handle the school "deleted" event.
     *
     * @param  \App\Models\Shool\School  $school
     * @return void
     */
    public function deleted(School $school)
    {
        //
    }

    /**
     * Handle the school "restored" event.
     *
     * @param  \App\Models\Shool\School  $school
     * @return void
     */
    public function restored(School $school)
    {
        //
    }

    /**
     * Handle the school "force deleted" event.
     *
     * @param  \App\Models\Shool\School  $school
     * @return void
     */
    public function forceDeleted(School $school)
    {
        //
    }
}
