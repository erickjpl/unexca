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
     * Handle the answer "updated" event.
     *
     * @param  \App\Models\Evaluate\Answer  $answer
     * @return void
     */
    public function updated(Answer $answer)
    {
        try {
            DB::beginTransaction();
                $relativeStudent->audits()->create([
                    'type' => 'update',
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
     * Handle the answer "deleted" event.
     *
     * @param  \App\Models\Evaluate\Answer  $answer
     * @return void
     */
    public function deleted(Answer $answer)
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
