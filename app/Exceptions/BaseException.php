<?php

namespace App\Exceptions;
use Exception;
use Throwable;

/**
 * 封装异常基类
 * Class BaseException
 * @package App\Exceptions
 */
class BaseException extends Exception
{
    /**
     * http状态码
     * @var int
     */
    public $code = 400;
    /**
     * 错误信息
     * @var string
     */
    public $message = '参数错误';
    /**
     * 错误码
     * @var int
     */
    public $error_code = 10000;
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }

}