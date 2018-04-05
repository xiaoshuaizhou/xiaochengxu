<?php

namespace App\Exceptions;

use Exception;

class AddressException extends Exception
{
    /**
     * @var int
     */
    public $code = 10040;
    /**
     * @var string
     */
    public $message = '参数错误';
    /**
     * @var int
     */
    public $error_code = 999;

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
