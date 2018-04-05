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
    public $error_code = 503;

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
