<?php

namespace App\Repositories;

use App\Exceptions\TokenException;
use Redis;
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

    /**
     * 获取UID
     * @return mixed
     * @throws TokenException
     */
    public static function getCurrentUid()
    {
        return self::getCurrentTokenVar('uid');
    }

    /**
     * 根据 key 获取缓存中指定 value
     * @param $key
     * @return mixed
     * @throws TokenException
     */
    public static function getCurrentTokenVar($key)
    {
        //获取token【所有的token都必须通过http请求的header中传递】
        $token = request()->header('token');
        $vars = \Illuminate\Support\Facades\Redis::get($token);
        if (!$vars){
            throw new TokenException('token过期或token无效');
        }else{
            if (!is_array($vars)) {
                $vars = json_decode($vars, true);
            }
            //根据key取出对应的值
            if (array_key_exists($key, $vars)){
                return $vars[$key];
            }else{
                throw new TokenException('尝试获取token变量不存在');
            }

        }


    }
}