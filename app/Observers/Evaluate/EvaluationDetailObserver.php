<?php

namespace App\Observers\Evaluate;

use Illuminate\Support\Facades\DB;
use App\Models\Evaluate\EvaluationDetail;
use App\Models\Profile\User;

class EvaluationDetailObserver
{
    /**
     * Handle the evaluation detail "created" event.
     *
     * @param  \App\Models\Evaluate\EvaluationDetail  $evaluationDetail
     * @return void
     */
    public function created(EvaluationDetail $evaluationDetail)
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
     * Handle the evaluation detail "updated" event.
     *
     * @param  \App\Models\Evaluate\EvaluationDetail  $evaluationDetail
     * @return void
     */
    public function updated(EvaluationDetail $evaluationDetail)
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
     * Handle the evaluation detail "deleted" event.
     *
     * @param  \App\Models\Evaluate\EvaluationDetail  $evaluationDetail
     * @return void
     */
    public function deleted(EvaluationDetail $evaluationDetail)
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
     * Handle the evaluation detail "restored" event.
     *
     * @param  \App\Models\Evaluate\EvaluationDetail  $evaluationDetail
     * @return void
     */
    public function restored(EvaluationDetail $evaluationDetail)
    {
        //
    }

    /**
     * Handle the evaluation detail "force deleted" event.
     *
     * @param  \App\Models\Evaluate\EvaluationDetail  $evaluationDetail
     * @return void
     */
    public function forceDeleted(EvaluationDetail $evaluationDetail)
    {
        //
    }
}
