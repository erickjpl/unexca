<?php

namespace App\Repositories\Profile;

use App\Models\Profile\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories\API\Profile
 * @version May 21, 2020, 11:02 pm UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    /**
     * @var array
     */
    protected $realtionSearchable = [
        'userDetail',
        'parent',
        'student',
        'teacher'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Return searchable relations
     *
     * @return array
     */
    public function getRealtionsSearchable()
    {
        return $this->realtionSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
