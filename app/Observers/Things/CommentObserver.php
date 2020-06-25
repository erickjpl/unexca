<?php

namespace App\Observers\Things;

use Illuminate\Support\Facades\DB;
use App\Models\Things\Comment;
use App\Models\Profile\User;

class CommentObserver
{
    /**
     * Handle the comment "created" event.
     *
     * @param  \App\Models\Things\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        try { 
            DB::beginTransaction();
                $comment->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $comment->toJson(),
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
     * Handle the comment "updated" event.
     *
     * @param  \App\Models\Things\Comment  $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
        try { 
            DB::beginTransaction();
                $comment->audits()->create([
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
     * Handle the comment "deleted" event.
     *
     * @param  \App\Models\Things\Comment  $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        try { 
            DB::beginTransaction();
                $comment->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $comment->toJson(),
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
     * Handle the comment "restored" event.
     *
     * @param  \App\Models\Things\Comment  $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "force deleted" event.
     *
     * @param  \App\Models\Things\Comment  $comment
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        //
    }
}
