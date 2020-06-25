<?php

namespace App\Observers\Things;

use Illuminate\Support\Facades\DB;
use App\Models\Things\Publication;
use App\Models\Profile\User;

class PublicationObserver
{
    /**
     * Handle the publication "created" event.
     *
     * @param  \App\Models\Things\Publication  $publication
     * @return void
     */
    public function created(Publication $publication)
    {
        try { 
            DB::beginTransaction();
                $publication->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $publication->toJson(),
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
     * Handle the publication "updated" event.
     *
     * @param  \App\Models\Things\Publication  $publication
     * @return void
     */
    public function updated(Publication $publication)
    {
        try { 
            DB::beginTransaction();
                $publication->audits()->create([
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
     * Handle the publication "deleted" event.
     *
     * @param  \App\Models\Things\Publication  $publication
     * @return void
     */
    public function deleted(Publication $publication)
    {
        try { 
            DB::beginTransaction();
                $publication->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $publication->toJson(),
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
     * Handle the publication "restored" event.
     *
     * @param  \App\Models\Things\Publication  $publication
     * @return void
     */
    public function restored(Publication $publication)
    {
        //
    }

    /**
     * Handle the publication "force deleted" event.
     *
     * @param  \App\Models\Things\Publication  $publication
     * @return void
     */
    public function forceDeleted(Publication $publication)
    {
        //
    }
}
