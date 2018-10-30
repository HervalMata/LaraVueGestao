<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 12:22
 */

namespace App\Repository;

use App\Exceptions\RepositoryException;
use App\Repository\Traits\DeleteTrait;
use App\Repository\Traits\GetTrait;
use App\Repository\Traits\RestoreTrait;
use App\Repository\Traits\UpdateTrait;
use Illuminate\Container\Container as App;
use App\Repository\Traits\StoreTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseRepository
{
    use StoreTrait;
    use UpdateTrait;
    use GetTrait;
    use DeleteTrait;
    use RestoreTrait;

    abstract public function model();

    protected $model;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * makeModel
     *
     * @return Model
     * @throws Repo
     *
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Get model.
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * Add trashed.
     *
     * @return $this
     * @throws RepositoryException
     */
    public function withTrashed()
    {
        if (!in_array(SoftDeletes::class, class_uses($this->model))) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\SoftDeletes");
        }
        $this->model = $this->makeModel()->withTrashed();

        return $this;
    }

    /**
     * Without trashed.
     *
     * @return $this
     */
    public function withoutTrashed()
    {
        $this->model = $this->makeModel();

        return $this;
    }

    /**
     * Only trashed
     *
     * @return $this
     * @throws RepositoryException
     */
    public function onlyTrashed()
    {
        if (!in_array(SoftDeletes::class, class_uses($this->model))) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\SoftDeletes");
        }
        $this->model = $this->makeModel()->onlyTrashed();

        return $this;
    }
}