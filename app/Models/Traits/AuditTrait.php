<?php

namespace App\Models\Traits;

trait AuditTrait
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphByMany
     */
    public function audits()
    {
        return $this->morphMany(\App\Models\Config\Audit::class, 'actionable');
    }
}
