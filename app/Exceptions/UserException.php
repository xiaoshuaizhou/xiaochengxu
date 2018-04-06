<?php

namespace App\Exceptions;

use Exception;

class UserException extends Exception
{
    /**
     * http 状态码
     * @var int
     */
    public $code = 404;
    /**
     * @var string
     */
    public $message = '用户不存在';
    /**
     * @var int
     */
    public $error_code = 60000;

    /**
     * WeChatException constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
