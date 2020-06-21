<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
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
    public $table = 'periods';

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
        'period_year',
        'grade',
        'course_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'period_year' => 'date:Y-m',
        'grade' => 'string',
        'course_id' => 'integer',
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
    public function course()
    {
        return $this->belongsTo(\App\Models\School\Course::class, 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphByMany
     */
    public function audit()
    {
        return $this->morphMany(\App\Models\Config\Audit::class, 'actionable');
    }
}
