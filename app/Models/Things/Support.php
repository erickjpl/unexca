<?php

namespace App\Models\Things;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    public $table = 'supports';
    
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
        'path',
        'size',
        'type',
        'supportable_id',
        'supportable_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'path' => 'string',
        'size' => 'string',
        'type' => 'string',
        'supportable_id' => 'integer',
        'supportable_type' => 'string',
    ];

    /**
     * Get the owning supportable model.
     */
    public function supportable()
    {
        return $this->morphTo();
    }
}
