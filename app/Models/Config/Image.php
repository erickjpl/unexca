<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $table = 'images';
    
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
        'imageable_type',
        'imageable_id'
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
        'imageable_type' => 'string',
        'imageable_id' => 'string',
    ];

    /**
     * Get the owning imageable model.
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
