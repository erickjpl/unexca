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
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $partial->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $partial->toJson(),
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
     * Handle the partial "updated" event.
     *
     * @param  \App\Models\Evaluate\Partial  $partial
     * @return void
     */
    public function updated(Partial $partial)
    {
        //
    }

    /**
     * Handle the partial "deleted" event.
     *
     * @param  \App\Models\Evaluate\Partial  $partial
     * @return void
     */
    public function deleted(Partial $partial)
    {
        //
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
