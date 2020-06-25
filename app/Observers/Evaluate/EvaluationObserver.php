<?php

namespace App\Observers\Evaluate;

use Illuminate\Support\Facades\DB;
use App\Models\Evaluate\Evaluation;
use App\Models\Profile\User;

class EvaluationObserver
{
    /**
     * Handle the evaluation "created" event.
     *
     * @param  \App\Models\Evaluate\Evaluation  $evaluation
     * @return void
     */
    public function created(Evaluation $evaluation)
    {
        try { 
            DB::beginTransaction();
                $evaluation->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => '{}',
                    'new' => $evaluation->toJson(),
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
     * Handle the evaluation "updated" event.
     *
     * @param  \App\Models\Evaluate\Evaluation  $evaluation
     * @return void
     */
    public function updated(Evaluation $evaluation)
    {
        try { 
            DB::beginTransaction();
                $evaluation->audits()->create([
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
     * Handle the evaluation "deleted" event.
     *
     * @param  \App\Models\Evaluate\Evaluation  $evaluation
     * @return void
     */
    public function deleted(Evaluation $evaluation)
    {
        try { 
            DB::beginTransaction();
                $evaluation->audits()->create([
                    'type' => 'delete',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'new' => '{}',
                    'old' => $evaluation->toJson(),
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
     * Handle the evaluation "restored" event.
     *
     * @param  \App\Models\Evaluate\Evaluation  $evaluation
     * @return void
     */
    public function restored(Evaluation $evaluation)
    {
        //
    }

    /**
     * Handle the evaluation "force deleted" event.
     *
     * @param  \App\Models\Evaluate\Evaluation  $evaluation
     * @return void
     */
    public function forceDeleted(Evaluation $evaluation)
    {
        //
    }
}
