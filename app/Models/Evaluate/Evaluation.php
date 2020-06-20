<?php

namespace App\Models\Evaluate;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
		'file',
		'rating',
		'user_id',
		'partial_id',
    ];
}
