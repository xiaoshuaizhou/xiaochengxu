<?php

namespace App\Exceptions;


/**
 * Class BannerExcption
 * @package App\Exceptions
 */
class BannerExcption extends BaseException
{
    /**
     * http 状态码
     * @var int
     */
    public $code = 404;
    /**
     * 错误信息
     * @var string
     */
    public $message = '请求的banner不存在';
    /**
     * 错误码
     * @var int
     */
    public $error_code = 40000;

    /**
     * BannerExcption constructor.
     * @param string $message
     */
    public function __construct(string $message = "")
    {
        parent::__construct($message);
    }

}