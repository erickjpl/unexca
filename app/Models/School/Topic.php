<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
		'weighing',
		'type',
		'start',
		'end',
		'classroom_id',
    ];
}
