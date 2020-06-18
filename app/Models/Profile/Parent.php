<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class Parent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'family_relationship',
        'student_id',
        'user_id'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\Profile\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function student()
    {
        return $this->belongsTo(\App\Models\Profile\Student::class, 'student_id');
    }
}
