<?php

namespace App\Models\Things;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
		'title',
		'description',
		'path',
		'size',
		'type',
		'temary_id'
    ];
}
