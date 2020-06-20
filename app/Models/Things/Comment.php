<?php

namespace App\Models\Things;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'comment',
        'commentable_id',
        'commentable_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'comment' => 'string',
        'commentable_id' => 'integer',
        'commentable_type' => 'string',
    ];

    /**
     * Get the owning commentable model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
