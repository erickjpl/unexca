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
            DB::beginTransaction();
                $question->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $question->toJson(),
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
     * Handle the question "updated" event.
     *
     * @param  \App\Models\Evaluate\Question  $question
     * @return void
     */
    public function updated(Question $question)
    {
        try { 
            DB::beginTransaction();
                $question->audits()->create([
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
     * Handle the question "deleted" event.
     *
     * @param  \App\Models\Evaluate\Question  $question
     * @return void
     */
    public function deleted(Question $question)
    {
        try { 
            DB::beginTransaction();
                $question->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $question->toJson(),
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
