<?php

namespace App\Exceptions;

use Exception;

class IDMustBePostException extends Exception
{
    public function __construct($msg = '')
    {
        parent::__construct($msg);
    }
}
