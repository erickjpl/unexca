<?php

namespace App\Observers\Things;

use Illuminate\Support\Facades\DB;
use App\Models\Things\Multimedia;
use App\Models\Profile\User;

class MultimediaObserver
{
    /**
     * Handle the multimedia "created" event.
     *
     * @param  \App\Models\Things\Multimedia  $multimedia
     * @return void
     */
    public function created(Multimedia $multimedia)
    {
        try {
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $multimedia->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $multimedia->toJson(),
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
     * Handle the multimedia "updated" event.
     *
     * @param  \App\Models\Things\Multimedia  $multimedia
     * @return void
     */
    public function updated(Multimedia $multimedia)
    {
        //
    }

    /**
     * Handle the multimedia "deleted" event.
     *
     * @param  \App\Models\Things\Multimedia  $multimedia
     * @return void
     */
    public function deleted(Multimedia $multimedia)
    {
        //
    }

    /**
     * Handle the multimedia "restored" event.
     *
     * @param  \App\Models\Things\Multimedia  $multimedia
     * @return void
     */
    public function restored(Multimedia $multimedia)
    {
        //
    }

    /**
     * Handle the multimedia "force deleted" event.
     *
     * @param  \App\Models\Things\Multimedia  $multimedia
     * @return void
     */
    public function forceDeleted(Multimedia $multimedia)
    {
        //
    }
}
