<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 21:22
 */

namespace App\Repository\Traits;

use App\Exceptions\RepositoryException;
use Exception;
trait DeleteTrait
{
    /**
     * @param $id
     * @return int
     * @throws RepositoryException
     */
    public function delete($id)
    {
        try {
            return $this->model->destroy($id);
        } catch (Exception $e) {
        }
        throw new RepositoryException('Could not delete the record. You must delete all relationships before proceeding.');
    }

    /**
     * @param int $id
     * @param string $field
     * @return bool|null
     * @throws RepositoryException
     */
    public function forceDelete($id, $field = 'id')
    {
        try {
            return $this->model->where($field, $id)->forceDelete();
        } catch (Exception $e) {
        }
        throw new RepositoryException('Could not delete the record. You must delete all relationships before proceeding.');
    }
}