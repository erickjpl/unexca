<?php

namespace App\Models\Things;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
		'title',
		'description',
		'temary_id'
    ];
}
