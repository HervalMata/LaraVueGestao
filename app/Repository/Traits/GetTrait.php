<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 17:21
 */

namespace App\Repository\Traits;


use App\Exceptions\RepositoryException;
use Illuminate\Pagination\LengthAwarePaginator;

trait GetTrait
{
    /**
     * Get all item of model
     *
     * @param array $columns
     * @param array $with
     * @param array $orders
     * @param int $limit
     * @param int $page
     * @return LengthAwarePaginator
     *
     * @throws \Exception
     */
    public function all(array $columns = ['*'], array $with = [], $orders = [], $limit = 50, $page =1) {
        $all = $this->model;

        if (!empty($with)) {
            $all = $all->with($with);
        }

        foreach ($orders as $order) {
            $order['order'] = isset($order['order']) ? $order['order'] : 'ASC';

            $all = $all->orderBy($order['column'], $order['order']);
        }

        $all = $all->paginate($limit, $columns, 'page', $page);

        return $all;
    }

    /**
     * @param $id
     * @param array $columns
     * @param array $with
     * @param array $load
     * @return mixed
     * @throws RepositoryException
     */
    public function get($id, array $columns = ['*'], array $with = [], array $load = []) {
        $item = $this->model;

        if (!empty($with)) {
            $item = $item->with($with);
        }

        $item = $item->find($id, $columns);

        if (!empty($load) and !is_null($item)) {
            $item->load($load);
        }

        if ($item) {
            return $item;
        }

        throw new RepositoryException('Item not found');
    }
}