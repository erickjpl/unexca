<?php

namespace App\Observers\Evaluate;

use Illuminate\Support\Facades\DB;
use App\Models\Evaluate\Answer;
use App\Models\Profile\User;

class AnswerObserver
{
    /**
     * Handle the answer "created" event.
     *
     * @param  \App\Models\Evaluate\Answer  $answer
     * @return void
     */
    public function created(Answer $answer)
    {
        try {
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $relativeStudent->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $relativeStudent->toJson(),
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
     * Handle the answer "updated" event.
     *
     * @param  \App\Models\Evaluate\Answer  $answer
     * @return void
     */
    public function updated(Answer $answer)
    {
        //
    }

    /**
     * Handle the answer "deleted" event.
     *
     * @param  \App\Models\Evaluate\Answer  $answer
     * @return void
     */
    public function deleted(Answer $answer)
    {
        //
    }

    /**
     * Handle the answer "restored" event.
     *
     * @param  \App\Models\Evaluate\Answer  $answer
     * @return void
     */
    public function restored(Answer $answer)
    {
        //
    }

    /**
     * Handle the answer "force deleted" event.
     *
     * @param  \App\Models\Evaluate\Answer  $answer
     * @return void
     */
    public function forceDeleted(Answer $answer)
    {
        //
    }
}
