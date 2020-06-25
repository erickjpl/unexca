<?php

namespace App\Observers\School;

use Illuminate\Support\Facades\DB;
use App\Models\Shool\School;
use App\Models\Profile\User;

class SchoolObserver
{
    /**
     * Handle the school "created" event.
     *
     * @param  \App\Models\Shool\School  $school
     * @return void
     */
    public function created(School $school)
    {
        try { 
            DB::beginTransaction();
                $school->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $school->toJson(),
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
     * Handle the school "updated" event.
     *
     * @param  \App\Models\Shool\School  $school
     * @return void
     */
    public function updated(School $school)
    {
        try { 
            DB::beginTransaction();
                $school->audits()->create([
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
     * Handle the school "deleted" event.
     *
     * @param  \App\Models\Shool\School  $school
     * @return void
     */
    public function deleted(School $school)
    {
        try { 
            DB::beginTransaction();
                $school->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $school->toJson(),
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
     * Handle the school "restored" event.
     *
     * @param  \App\Models\Shool\School  $school
     * @return void
     */
    public function restored(School $school)
    {
        //
    }

    /**
     * Handle the school "force deleted" event.
     *
     * @param  \App\Models\Shool\School  $school
     * @return void
     */
    public function forceDeleted(School $school)
    {
        //
    }
}
