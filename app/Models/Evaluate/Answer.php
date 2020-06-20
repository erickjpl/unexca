<?php

namespace App\Models\Evaluate;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
		'code',
		'answer',
		'question_id',
    ];
}
