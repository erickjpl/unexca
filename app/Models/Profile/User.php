<?php

namespace App\Models\Profile;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    protected $dates = ['deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(\App\Models\Config\Image::class, 'imageable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {
        return $this->hasOne(\App\Models\Profile\Student::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function relativeStudent()
    {
        return $this->hasOne(\App\Models\Profile\RelativeStudent::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacher()
    {
        return $this->hasOne(\App\Models\Profile\Teacher::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userDetail()
    {
        # return $this->hasOne(\App\Models\Profile\UserDetail::class, 'user_id');
    }

    /**
     * Get all parents of students.
     */
    public function parents()
    {
        return $this->hasManyThrough(\App\Models\Profile\RelativeStudent::class, \App\Models\Profile\Student::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphByMany
     */
    public function audits()
    {
        return $this->morphMany(\App\Models\Config\Audit::class, 'actionable');
    }
}
