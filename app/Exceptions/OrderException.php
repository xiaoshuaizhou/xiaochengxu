<?php

namespace App\Exceptions;

use Exception;

class OrderException extends Exception
{
    /**
     * http状态码
     * @var int
     */
    public $code = 404;
    /**
     * @var string
     */
    public $message = '订单不合法';
    /**
     * @var int
     */
    public $error_code = 80000;

    /**
     * IDMustBePostException constructor.
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}
