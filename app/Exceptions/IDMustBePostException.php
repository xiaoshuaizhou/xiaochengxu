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
    /**
     * @var int
     */
    public $code = 400;
    /**
     * @var string
     */
    public $message = 'id必须是正整数';
    /**
     * @var int
     */
    public $error_code = 10000;

    /**
     * IDMustBePostException constructor.
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }

}
