<?php

namespace App\Observers\Things;

use Illuminate\Support\Facades\DB;
use App\Models\Things\Support;
use App\Models\Profile\User;

class SupportObserver
{
    /**
     * Handle the support "created" event.
     *
     * @param  \App\Models\Things\Support  $support
     * @return void
     */
    public function created(Support $support)
    {
        try { 
            DB::beginTransaction();
                $support->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $support->toJson(),
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
     * Handle the support "updated" event.
     *
     * @param  \App\Models\Things\Support  $support
     * @return void
     */
    public function updated(Support $support)
    {
        try { 
            DB::beginTransaction();
                $support->audits()->create([
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
     * Handle the support "deleted" event.
     *
     * @param  \App\Models\Things\Support  $support
     * @return void
     */
    public function deleted(Support $support)
    {
        try { 
            DB::beginTransaction();
                $support->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $support->toJson(),
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
     * Handle the support "restored" event.
     *
     * @param  \App\Models\Things\Support  $support
     * @return void
     */
    public function restored(Support $support)
    {
        //
    }

    /**
     * Handle the support "force deleted" event.
     *
     * @param  \App\Models\Things\Support  $support
     * @return void
     */
    public function forceDeleted(Support $support)
    {
        //
    }
}
