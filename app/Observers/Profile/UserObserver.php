<?php

namespace App\Observers\Profile;

use Illuminate\Support\Facades\DB;
use App\Models\Profile\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\Profile\User  $user
     * @return void
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Throwable
     *
     */
    public function created(User $user)
    {
        try { 
            DB::beginTransaction();
                $user->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $user->toJson(),
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
     * Handle the user "updated" event.
     *
     * @param  \App\Models\Profile\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        try { 
            DB::beginTransaction();
                $user->audits()->create([
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
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\Profile\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        try { 
            DB::beginTransaction();
                $user->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $user->toJson(),
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
     * Handle the user "restored" event.
     *
     * @param  \App\Models\Profile\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\Profile\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
