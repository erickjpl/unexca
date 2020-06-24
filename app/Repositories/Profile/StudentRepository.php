<?php

namespace App\Repositories\Profile;

use App\Models\Profile\Student;
use App\Repositories\BaseRepository;

/**
 * Class StudentRepository
 * @package App\Repositories\API\Profile
 * @version May 21, 2020, 11:02 pm UTC
*/

class StudentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'status',
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
        return Student::class;
    }
}
