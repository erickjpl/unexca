<?php

namespace App\Observers\School;

use Illuminate\Support\Facades\DB;
use App\Models\Shool\Period;
use App\Models\Profile\User;

class PeriodObserver
{
    /**
     * Handle the period "created" event.
     *
     * @param  \App\Models\Shool\Period  $period
     * @return void
     */
    public function created(Period $period)
    {
        try {
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $period->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $period->toJson(),
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
     * Handle the period "updated" event.
     *
     * @param  \App\Models\Shool\Period  $period
     * @return void
     */
    public function updated(Period $period)
    {
        //
    }

    /**
     * Handle the period "deleted" event.
     *
     * @param  \App\Models\Shool\Period  $period
     * @return void
     */
    public function deleted(Period $period)
    {
        try {
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $period->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'new' => '{}',
                    'old' => $period->toJson(),
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
     * Handle the period "restored" event.
     *
     * @param  \App\Models\Shool\Period  $period
     * @return void
     */
    public function restored(Period $period)
    {
        //
    }

    /**
     * Handle the period "force deleted" event.
     *
     * @param  \App\Models\Shool\Period  $period
     * @return void
     */
    public function forceDeleted(Period $period)
    {
        //
    }
}
