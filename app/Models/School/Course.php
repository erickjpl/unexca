<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'code',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function period()
    {
        return $this->hasOne(\App\Models\School\Period::class, 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function classroom()
    {
        return $this->hasOne(\App\Models\School\Classroom::class, 'course_id');
    }
}
