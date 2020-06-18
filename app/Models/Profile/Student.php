<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'type',
        'status',
        'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\Profile\User::class, 'user_id');
    }
}
