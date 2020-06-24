<?php

namespace App\Observers\Evaluate;

use Illuminate\Support\Facades\DB;
use App\Models\Evaluate\Question;
use App\Models\Profile\User;

class QuestionObserver
{
    /**
     * Handle the question "created" event.
     *
     * @param  \App\Models\Evaluate\Question  $question
     * @return void
     */
    public function created(Question $question)
    {
        try {
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $question->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $question->toJson(),
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
     * Handle the question "updated" event.
     *
     * @param  \App\Models\Evaluate\Question  $question
     * @return void
     */
    public function updated(Question $question)
    {
        //
    }

    /**
     * Handle the question "deleted" event.
     *
     * @param  \App\Models\Evaluate\Question  $question
     * @return void
     */
    public function deleted(Question $question)
    {
        try {
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $question->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'new' => '{}',
                    'old' => $question->toJson(),
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
     * Handle the question "restored" event.
     *
     * @param  \App\Models\Evaluate\Question  $question
     * @return void
     */
    public function restored(Question $question)
    {
        //
    }

    /**
     * Handle the question "force deleted" event.
     *
     * @param  \App\Models\Evaluate\Question  $question
     * @return void
     */
    public function forceDeleted(Question $question)
    {
        //
    }
}
