<?php

namespace App\Repositories\Traits;

use App\Models\Profile\User;
use Illuminate\Support\Facades\DB;

trait AuditTrait
{
    /**
     * @param array $relation
     *
     * @throws \Throwable
     */
    public function audit($type, $old, $new)
    {
        try {
            DB::beginTransaction();
                $audit = \Auth::user() ?? User::findOrFail(1);

                $audit->audits()->create([
                    'type' => $type,
                    'old' => $old,
                    'new' => $new,
                    'user_id' => $audit->id,
                    'create_at' => today(),
                ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}
