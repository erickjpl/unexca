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
            DB::beginTransaction();
                $multimedia->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $multimedia->toJson(),
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
     * Handle the multimedia "updated" event.
     *
     * @param  \App\Models\Things\Multimedia  $multimedia
     * @return void
     */
    public function updated(Multimedia $multimedia)
    {
        try { 
            DB::beginTransaction();
                $multimedia->audits()->create([
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
     * Handle the multimedia "deleted" event.
     *
     * @param  \App\Models\Things\Multimedia  $multimedia
     * @return void
     */
    public function deleted(Multimedia $multimedia)
    {
        try { 
            DB::beginTransaction();
                $multimedia->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $multimedia->toJson(),
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
