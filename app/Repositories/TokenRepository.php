<?php

namespace App\Repositories;


/**
 * 处理 token 基类 便于UserToken 和 AppToken 继承使用
 * Class TokenRepository
 * @package App\Repositories
 */
class TokenRepository
{
    /**
     * 定义 缓存 key
     * @return string
     */
    public static function generateToken()
    {
        //定义一组32位无意义的字符串 自定义helpers函数中
        $randChars = getRanChars(32);
        //考虑安全性 使用三组字符串[随机字符串，时间戳 ，盐]进行md5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT']; //时间戳
        $salt = env('TOKEN_SALT');

        return md5($randChars . $timestamp . $salt);
    }
}