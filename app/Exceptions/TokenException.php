<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class TokenException extends Exception
{
    /**
     * @var int
     */
    public $code = 400;
    /**
     * @var string
     */
    public $message = 'token不能为空';
    /**
     * @var int
     */
    public $error_code = 999;

    /**
     * TokenException constructor.
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}
