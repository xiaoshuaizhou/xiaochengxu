<?php

namespace App\Exceptions;

use Exception;

class UserException extends Exception
{
    /**
     * @var int
     */
    public $code = 60000;
    /**
     * @var string
     */
    public $message = '用户不存在';
    /**
     * @var int
     */
    public $error_code = 404;

    /**
     * WeChatException constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
