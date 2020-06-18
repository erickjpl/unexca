<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
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
}
