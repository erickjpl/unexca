<?php

namespace App\Models\Evaluate;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
		'question',
		'answer_code',
		'partial_id',
    ];
}
