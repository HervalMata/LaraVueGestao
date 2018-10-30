<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 16:29
 */

namespace App\Repository\Traits;


use App\Exceptions\RepositoryException;

trait UpdateTrait
{
    /**
     * Update item of model.
     *
     * @param array $data
     * @param $id
     * @return mixed
     * @throws RepositoryException
     */
    public function update(array $data, $id)
    {
        if (empty($data)) {
            throw new RepositoryException('Empty data');
        }

        $model = $this->model->find($id);

        if (!$model) {
            throw new RepositoryException('Item not found');
        }

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
            throw new RepositoryException('Eroor update');
        }
    }
}