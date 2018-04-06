<?php

namespace App\Exceptions;

use Exception;

class AddressException extends Exception
{
    /**
     * http状态码
     * @var int
     */
    public $code = 203;
    /**
     * @var string
     */
    public $message = '地址创建失败';
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
