<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 12:26
 */

namespace App\Repository\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Exceptions\RepositoryException;

trait StoreTrait
{
    /**
     * Store new item on model
     *
     * @param array $data
     * @return Model
     *
     * @throws \Exception
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new RepositoryException('Empty data');
        }

        $model = $this->model;

        try {
            $model->fill($data);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new RepositoryException('Empty fillable');
        }

        try {
            $model->save();
            return $model;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new RepositoryException('Eroor store');
        }
    }
}