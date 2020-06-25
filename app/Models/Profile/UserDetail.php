<?php

namespace App\Models\Profile;

use App\Models\Traits\AuditTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use AuditTrait, SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    protected $dates = ['deleted_at', 'birthdate'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'user_details';

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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
		'name',
		'lastname',
		'dni',
		'phone',
		'birthdate',
		'address',
		'genre',
		'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'  => 'string',
		'lastname'  => 'string',
		'dni'  => 'string',
		'phone'  => 'string',
		'birthdate'  => 'date:Y-m-d',
		'address'  => 'string',
		'genre'  => 'string',
		'user_id'  => 'integer',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\Profile\User::class, 'user_id');
    }
}
