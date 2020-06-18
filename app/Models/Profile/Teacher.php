<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'speciality',
        'status',
        'user_id'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\Profile\User::class, 'user_id');
    }
}
