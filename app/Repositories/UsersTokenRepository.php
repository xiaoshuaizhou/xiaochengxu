<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UsersRepository
 * @package App\Repositories
 */
class UsersTokenRepository
{
    /**
     * @var
     */
    protected $code;
    /**
     * @var mixed
     */
    protected $wxAppId;
    /**
     * @var string
     */
    protected $wxLoginUrl;
    /**
     * @var mixed
     */
    protected $wxAppsecret;
    /**
     * @var User
     */
    public $user;

    /**
     * UserTokenRepository constructor.
     * @param $code
     */
    public function __construct($code)
    {
        $this->code = $code;
        $this->wxAppId = env('APPID');
        $this->wxAppsecret = env('APPSECRET');
        $this->wxLoginUrl = sprintf(env('WXLOGINURL'), $this->wxAppId, $this->wxAppsecret, $this->code['code']);
    }

    public function getToken($code)
    {

    }



}