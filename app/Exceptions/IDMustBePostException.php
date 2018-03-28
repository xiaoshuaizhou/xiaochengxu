<?php

namespace App\Exceptions;

/**
 * id必须是正整数异常
 * Class IDMustBePostException
 * @package App\Exceptions
 */
class IDMustBePostException extends BaseException
{
    public $code = 999;
    public $message = 'id必须是正整数';
    public $error_code = 400;

}
