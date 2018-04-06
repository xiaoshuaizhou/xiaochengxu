<?php

namespace App\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    /**
     * http状态码
     * @var int
     */
    public $code = 403;
    /**
     * @var string
     */
    public $message = '暂无访问权限';
    /**
     * @var int
     */
    public $error_code = 10001;

    /**
     * IDMustBePostException constructor.
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }
}
