<?php

namespace App\Models\School;

use App\Models\Traits\AuditTrait;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use AuditTrait;
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
		'name',
		'code',
		'phone',
		'creation_date',
		'address'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphByMany
     */
    public function audit()
    {
        return $this->morphMany(\App\Models\Config\Audit::class, 'actionable');
    }
}
