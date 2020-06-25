<?php

namespace App\Repositories\Traits;

use Illuminate\Support\Facades\DB;
use App\Models\Config\Audit;

trait AuditTrait
{
    /**
     * @param array $relation
     *
     * @throws \Throwable
     */
    public function audit($data)
    {
        try {
            DB::beginTransaction();

                Audit::create([
                    'type' => 'read',
                    'ip' => request()->ip(),
                    'user' => auth()->user()->nickname ?? 'guest',
                    'old' => (Object) ['action' => $data],
                    'new' => (Object) ['action' => $data],
                    'user_id' => auth()->id ?? 1,
                    'create_at' => now(),
                    'actionable_id' => auth()->id ?? 1,
                    'actionable_type' => $this->model(),
                ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }
}
