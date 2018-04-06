<?php

namespace App\Exceptions;

use Exception;

class OrderProducts extends Exception
{
    /**
     * http状态码
     * @var int
     */
    public $code = 203;
    /**
     * @var string
     */
    public $message = '商品参数错误';
    /**
     * @var int
     */
    public $error_code = 20000;

    /**
     * IDMustBePostException constructor.
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}
