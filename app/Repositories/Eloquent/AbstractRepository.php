<?php

namespace App\Repositories\Eloquent;

use App\Models\AbstractModel;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class AbstractRepository implements RepositoryInterface
{
    private $app;

    /** @var AbstractModel */
    protected $model;

    /**
     * @return string
     */
    public abstract function getModelClass();

    /**
     * @param App $app
     * @throws RepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->getModelClass());

        if ( ! $model instanceof Model) {
            throw new RepositoryException(sprintf('Class %s must be an instance of %s', $this->getModelClass(), Model::class));
        }

        return $this->model = $model;
    }

    /**
     *
     */
    public function resetModel()
    {
        $this->makeModel();
    }

    // ------------------------------------------------------------------------

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * @param array $relations
     * @return $this
     */
    public function with(array $relations)
    {
        $this->model = $this->model->with($relations);
        return $this;
    }


    /**
     * @param int   $perPage
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Create with mass assignment
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Create without mass assignment
     * @param array $attributes
     * @return AbstractModel
     */
    public function createModel(array $attributes)
    {
        $this->makeModel();

        foreach ($attributes as $k => $v) {
            $this->model->$k = $v;
        }

        $this->model->save();

        return $this->model->find($this->model->getKey());
    }

    /**
     * Update with mass assignment
     * @param array $attributes
     * @param int   $id
     * @return bool
     */
    public function update(array $attributes, $id)
    {
        return $this->model->findOrFail($id)->update($attributes);
    }

    /**
     * Update without mass assignment
     * @param array $attributes
     * @param int   $id
     * @return AbstractModel
     */
    public function updateModel(array $attributes, $id)
    {
        $this->model = $this->model->findOrFail($id);

        foreach ($attributes as $k => $v) {
            $this->model->$k = $v;
        }

        $this->model->save();

        return $this->model->find($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param int   $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param int   $id
     * @param array $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param string $attribute
     * @param mixed  $value
     * @param array  $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @param string $attribute
     * @param mixed  $value
     * @param array  $columns
     * @return mixed
     */
    public function findAllBy($attribute, $value, $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->get($columns);
    }
}

