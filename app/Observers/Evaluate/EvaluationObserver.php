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
            $auth = \Auth::id() ?? User::findOrFail(1);

            DB::beginTransaction();
                $evaluation->audits()->create([
                    'type' => 'create',
                    'ip' => request()->ip(),
                    'user' => $auth->nickname,
                    'old' => '{}',
                    'new' => $evaluation->toJson(),
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
     * Handle the evaluation "updated" event.
     *
     * @param  \App\Models\Evaluate\Evaluation  $evaluation
     * @return void
     */
    public function updated(Evaluation $evaluation)
    {
        //
    }

    /**
     * Handle the evaluation "deleted" event.
     *
     * @param  \App\Models\Evaluate\Evaluation  $evaluation
     * @return void
     */
    public function deleted(Evaluation $evaluation)
    {
        //
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
