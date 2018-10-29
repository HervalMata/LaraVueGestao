<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 03:26
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];
}