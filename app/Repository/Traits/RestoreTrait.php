<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 21:44
 */

namespace App\Repository\Traits;


trait RestoreTrait
{
    /**
     * @param int $id
     * @param string $field
     * @return bool
     */
    public function restore($id, $field = 'id')
    {
        return $this->model->onlyTrashed()->where($field, $id)->restore();
    }
}