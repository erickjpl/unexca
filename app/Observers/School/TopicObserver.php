<?php

namespace App\Observers\School;

use Illuminate\Support\Facades\DB;
use App\Models\Shool\Topic;
use App\Models\Profile\User;

class TopicObserver
{
    /**
     * Handle the topic "created" event.
     *
     * @param  \App\Models\Shool\Topic  $topic
     * @return void
     */
    public function created(Topic $topic)
    {
        try {
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $topic->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $topic->toJson(),
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
     * Handle the topic "updated" event.
     *
     * @param  \App\Models\Shool\Topic  $topic
     * @return void
     */
    public function updated(Topic $topic)
    {
        //
    }

    /**
     * Handle the topic "deleted" event.
     *
     * @param  \App\Models\Shool\Topic  $topic
     * @return void
     */
    public function deleted(Topic $topic)
    {
        //
    }

    /**
     * Handle the topic "restored" event.
     *
     * @param  \App\Models\Shool\Topic  $topic
     * @return void
     */
    public function restored(Topic $topic)
    {
        //
    }

    /**
     * Handle the topic "force deleted" event.
     *
     * @param  \App\Models\Shool\Topic  $topic
     * @return void
     */
    public function forceDeleted(Topic $topic)
    {
        //
    }
}
