<?php

namespace App\Models\Profile;

use App\Models\Traits\AuditTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use AuditTrait, SoftDeletes;
}
