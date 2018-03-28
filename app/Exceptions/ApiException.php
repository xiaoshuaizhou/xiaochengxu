<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    public function __construct($msg = '')
    {
        parent::__construct($msg);
    }
}
