<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 16:09
 */

namespace App\Exceptions;

use Exception;

class RepositoryException extends Exception
{
    protected $message = 'Error no CRUD';
    protected $code = 500;
}