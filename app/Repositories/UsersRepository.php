<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UsersRepository
 * @package App\Repositories
 */
class UsersRepository
{
    /**
     * 根据openID获取用户信息
     * @param $openId
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public static function getUserByOpenId($openId)
    {
        return User::where('openid', $openId)->first();
    }

    /**
     * @param $openid
     * @return int|mixed
     */
    public static function create($openid)
    {
        $user = User::create([
            'openid' => $openid,
            'name' => 'monkey',
//            'nickname' => 'monkeyzhou',
            'email' => 'laravel@outlook.com',
            'password' => bcrypt('password'),
        ]);

        return $user->id;
    }
}