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
            DB::beginTransaction();
                $period->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $period->toJson(),
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
     * Handle the period "updated" event.
     *
     * @param  \App\Models\Shool\Period  $period
     * @return void
     */
    public function updated(Period $period)
    {
        try { 
            DB::beginTransaction();
                $period->audits()->create([
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
     * Handle the period "deleted" event.
     *
     * @param  \App\Models\Shool\Period  $period
     * @return void
     */
    public function deleted(Period $period)
    {
        try { 
            DB::beginTransaction();
                $period->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $period->toJson(),
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
