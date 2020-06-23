<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $dates = ['create_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'audits';

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
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'type',
        'ip',
        'user',
        'old',
        'new',
        'user_id',
        'create_at',
        'actionable_id',
        'actionable_type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'string',
        'ip' => 'string',
        'user' => 'string',
        'old' => 'json',
        'new' => 'json',
        'user_id' => 'integer',
        'create_at' => 'date:Y-m-d H:i:s',
        'actionable_id' => 'integer',
        'actionable_type' => 'string',
    ];

    /**
     * Get the owning actionable model.
     */
    public function actionable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\Profile\User::class, 'user_id');
    }
}
