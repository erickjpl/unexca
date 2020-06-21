<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    protected $dates = ['deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'topics';

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
        'weighing',
        'type',
        'start',
        'end',
        'classroom_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'weighing' => 'string',
        'type' => 'string',
        'start' => 'date:Y-m-d',
        'end' => 'date:Y-m-d',
        'classroom_id' => 'integer',
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
    public function classroom()
    {
        return $this->belongsTo(\App\Models\School\Classroom::class, 'classroom_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function partials()
    {
        return $this->hasMany(\App\Models\Things\Partial::class, 'topic_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function publications()
    {
        return $this->hasMany(\App\Models\Things\Publication::class, 'topic_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function multimedia()
    {
        return $this->hasMany(\App\Models\Things\Multimedia::class, 'topic_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphByMany
     */
    public function audit()
    {
        return $this->morphMany(\App\Models\Config\Audit::class, 'actionable');
    }
}
