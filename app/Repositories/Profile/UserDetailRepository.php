<?php

namespace App\Repositories\Profile;

use App\Models\Profile\UserDetail;
use App\Repositories\BaseRepository;

/**
 * Class UserDetailRepository
 *
 * @author Erick Pérez
 * @package App\Repositories\API\Profile
*/

class UserDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * @var array
     */
    protected $realtionSearchable = [
        'user',
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
        return UserDetail::class;
    }
}
