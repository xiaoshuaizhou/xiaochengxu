<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class WeChatException extends Exception
{
    /**
     * @var int
     */
    public $code = 10040;
    /**
     * @var string
     */
    public $message = '微信登录错误';
    /**
     * @var int
     */
    public $error_code = 10000;

    /**
     * WeChatException constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = "", int $code = 0)
    {
        parent::__construct($message, $code);
    }
}
