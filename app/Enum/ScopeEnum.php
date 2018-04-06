<?php

namespace App\Enum;


/**
 * 枚举表示用户访问权限
 * Class ScopeEnum
 * @package App\Enum
 */
class ScopeEnum
{
    /**
     * 普通APP用户访问权限
     */
    const   USER = 16;
    /**
     * 管理员的访问权限
     */
    const   SUPER = 32;
}