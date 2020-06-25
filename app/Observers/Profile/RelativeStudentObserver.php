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
            DB::beginTransaction();
                $relativeStudent->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $relativeStudent->toJson(),
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
     * Handle the relativeStudent "updated" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function updated(RelativeStudent $relativeStudent)
    {
        try { 
            DB::beginTransaction();
                $relativeStudent->audits()->create([
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
     * Handle the relativeStudent "deleted" event.
     *
     * @param  \App\Models\Profile\RelativeStudent  $relativeStudent
     * @return void
     */
    public function deleted(RelativeStudent $relativeStudent)
    {
        try { 
            DB::beginTransaction();
                $relativeStudent->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $relativeStudent->toJson(),
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
