<?php

namespace App\Observers\Profile;

use Illuminate\Support\Facades\DB;
use App\Models\Profile\RelativeStudent;
use App\Models\Profile\User;

class RelativeStudentObserver
{    
    /**
     * Handle the relativeStudent "created" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function created(RelativeStudent $relativeStudent)
    {
        try {
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $relativeStudent->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $relativeStudent->toJson(),
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
     * Handle the relativeStudent "updated" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function updated(RelativeStudent $relativeStudent)
    {
        //
    }

    /**
     * Handle the relativeStudent "deleted" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function deleted(RelativeStudent $relativeStudent)
    {
        try {
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $relativeStudent->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'new' => '{}',
                    'old' => $relativeStudent->toJson(),
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
     * Handle the relativeStudent "restored" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function restored(RelativeStudent $relativeStudent)
    {
        //
    }

    /**
     * Handle the relativeStudent "force deleted" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function forceDeleted(RelativeStudent $relativeStudent)
    {
        //
    }
}
