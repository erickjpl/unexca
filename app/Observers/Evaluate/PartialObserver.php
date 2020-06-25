<?php

namespace App\Observers\Evaluate;

use Illuminate\Support\Facades\DB;
use App\Models\Evaluate\Partial;
use App\Models\Profile\User;

class PartialObserver
{
    /**
     * Handle the partial "created" event.
     *
     * @param  \App\Models\Evaluate\Partial  $partial
     * @return void
     */
    public function created(Partial $partial)
    {
        try { 
            DB::beginTransaction();
                $partial->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $partial->toJson(),
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
     * Handle the partial "updated" event.
     *
     * @param  \App\Models\Evaluate\Partial  $partial
     * @return void
     */
    public function updated(Partial $partial)
    {
        try { 
            DB::beginTransaction();
                $partial->audits()->create([
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
     * Handle the partial "deleted" event.
     *
     * @param  \App\Models\Evaluate\Partial  $partial
     * @return void
     */
    public function deleted(Partial $partial)
    {
        try { 
            DB::beginTransaction();
                $partial->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $partial->toJson(),
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
     * Handle the partial "restored" event.
     *
     * @param  \App\Models\Evaluate\Partial  $partial
     * @return void
     */
    public function restored(Partial $partial)
    {
        //
    }

    /**
     * Handle the partial "force deleted" event.
     *
     * @param  \App\Models\Evaluate\Partial  $partial
     * @return void
     */
    public function forceDeleted(Partial $partial)
    {
        //
    }
}
