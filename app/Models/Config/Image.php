<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'images';

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
        'path',
        'size',
        'type',
        'imageable_id',
        'imageable_type',
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
        'imageable_id' => 'integer',
        'imageable_type' => 'string',
    ];

    /**
     * Get the owning imageable model.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphByMany
     */
    public function audit()
    {
        return $this->morphMany(\App\Models\Config\Audit::class, 'actionable');
    }
}
