<?php

namespace App\Exceptions;
use Exception;

/**
 * id必须是正整数异常
 * Class IDMustBePostException
 * @package App\Exceptions
 */
class IDMustBePostException extends Exception
{
    public $code = 999;
    public $message = 'id必须是正整数';
    public $error_code = 400;

    /**
     * IDMustBePostException constructor.
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }

}
