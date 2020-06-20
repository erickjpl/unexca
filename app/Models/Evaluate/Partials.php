<?php

namespace App\Models\Evaluate;

use Illuminate\Database\Eloquent\Model;

class Partials extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
		'activity',
		'is_evaluated',
		'opportunities',
		'attempt',
		'attempt_time',
		'temary_id'
    ];
}
