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
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $support->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $support->toJson(),
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
     * Handle the support "updated" event.
     *
     * @param  \App\Models\Things\Support  $support
     * @return void
     */
    public function updated(Support $support)
    {
        //
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
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $support->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'new' => '{}',
                    'old' => $support->toJson(),
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
