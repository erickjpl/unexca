<?php

namespace App\Models\Evaluate;

use Illuminate\Database\Eloquent\Model;

class EvaluationDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
		'question_id',
		'answer_id',
		'evaluation_id',
    ];
}