<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class ClassroomStudent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'classroom_id',
        'student_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function classroom()
    {
        return $this->belongsTo(\App\Models\School\Classroom::class, 'classroom_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function student()
    {
        return $this->belongsTo(\App\Models\Profile\Student::class, 'student_id');
    }
}
