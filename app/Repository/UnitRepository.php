<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 12:13
 */

namespace App\Repository;


use App\Models\Unit;

class UnitRepository extends BaseRepository
{

    public function model()
    {
        return Unit::class;
    }
}