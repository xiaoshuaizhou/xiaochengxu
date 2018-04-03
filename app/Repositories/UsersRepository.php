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
     * @param $data
     * @return UsersRepository|\Illuminate\Database\Eloquent\Model|null|object
     */
    public static function create($openid)
    {
        $user = User::create([
            'openid' => $openid,
            'nickname' => '',
            'email' => 'laravel@outlook.com',
            'password' => bcrypt('password'),
        ]);

        return $user->id;
    }
}