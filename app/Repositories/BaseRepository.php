<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Traits\AuditTrait;

abstract class BaseRepository
{
    use AuditTrait;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->app = new Application();
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     *
     * @return array
     */
    abstract public function getFieldsSearchable();

    /**
     * Get searchable relations array
     *
     * @return array
     */
    abstract public function getRealtionsSearchable();

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model();

    /**
     * Make Model instance
     *
     * @throws \Exception
     *
     * @return Model
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Paginate records for scaffold.
     *
     * @param int $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     *
     * @throws \Illuminate\Database\QueryException
     * @throws \PDOException
     * @throws \Exception
     */
    public function paginate($perPage, $search = [], $relation = [], $columns = ['*'])
    {
        try {
            $query = $this->allQuery($search, $relation);

            $this->audit('read', 'read paginated data', 'read paginated data');

            return $query->paginate($perPage, $columns);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\PDOException $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Build a query for retrieving all records.
     *
     * @param array $search
     * @param array $relation
     * @param int|null $skip
     * @param int|null $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function allQuery($search = [], $relation = [], $skip = null, $limit = null)
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) 
                    $query->where($key, $value);
            }
        }

        if (count($relation))
            $query = $this->getRelations($query,$relation);

        if (!is_null($skip))
            $query->skip($skip);

        if (!is_null($limit))
            $query->limit($limit);

        return $query;
    }

    /**
     * Add relationships to retrieve all records.
     *
     * @param array $relation
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getRelations($query, $relation)
    {
        foreach($relation as $value) {
            if (in_array($value, $this->getRealtionsSearchable())) {
                $query->with($value);
            }
        }

        return $query;
    }

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     *
     * @throws \Illuminate\Database\QueryException
     * @throws \PDOException
     * @throws \Exception
     */
    public function all($search = [], $relation = [], $skip = null, $limit = null, $columns = ['*'])
    {
        try {
            $query = $this->allQuery($search, $relation, $skip, $limit);

            $this->audit('read', 'read data', 'read data');

            return $query->get($columns);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\PDOException $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Model
     *
     * @throws \Throwable
     * @throws \Illuminate\Database\QueryException
     * @throws \PDOException
     * @throws \Exception
     */
    public function create($input)
    {
        try {
            \DB::beginTransaction();

                $model = $this->model->newInstance($input);

                $model->save();

            \DB::commit();
            
            return $model;
        } catch (\Throwable $e) {
            \DB::rollback();
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\Illuminate\Database\QueryException $e) {
            \DB::rollback();
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\PDOException $e) {
            \DB::rollback();
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            \DB::rollback();
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Find model record for given id
     *
     * @param mixed $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Database\QueryException
     * @throws \PDOException
     * @throws \Exception
     */
    public function find($id, $relation = [], $columns = ['*'])
    {
        try {
            $query = $this->model->newQuery();

            if (count($relation))
                $query = $this->getRelations($query,$relation);

            return $query->findOrFail($id, $columns);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw $e;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\PDOException $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * First model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Database\QueryException
     * @throws \PDOException
     * @throws \Exception
     */
    public function first($search = [], $relation = [], $skip = null, $limit = null, $columns = ['*'])
    {
        try {
            $query = $this->allQuery($search, $relation, $skip, $limit);

            return $query->firstOrFail($columns);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            throw $e;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\PDOException $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     *
     * @throws \Throwable
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Database\QueryException
     * @throws \PDOException
     * @throws \Exception
     */
    public function update($input, $id)
    {
        try {
            \DB::beginTransaction();

                $query = $this->model->newQuery();

                $model = $query->findOrFail($id);

                $model->fill($input);

                $model->save();

            \DB::commit();

            return $model;
        } catch (\Throwable $e) {
            \DB::rollback();
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \DB::rollback();
            throw $e;
        } catch (\Illuminate\Database\QueryException $e) {
            \DB::rollback();
            throw $e;
        } catch (\PDOException $e) {
            \DB::rollback();
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            \DB::rollback();
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return bool|mixed|null
     *
     * @throws \Throwable
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Illuminate\Database\QueryException
     * @throws \PDOException
     * @throws \Exception
     */
    public function delete($id)
    {
        try {
            \DB::beginTransaction();
            
                $query = $this->model->newQuery();

                $model = $query->findOrFail($id);

            \DB::commit();

            return $model->delete();
        } catch (\Throwable $e) {
            \DB::rollback();
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \DB::rollback();
            throw $e;
        } catch (\Illuminate\Database\QueryException $e) {
            \DB::rollback();
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\PDOException $e) {
            \DB::rollback();
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            \DB::rollback();
            throw new \App\Exceptions\CustomException($e->getMessage(), $e->getCode());
        }
    }
}
