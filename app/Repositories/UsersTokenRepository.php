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

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getToken()
    {
        $resoult = curl_get($this->wxLoginUrl);

        $wxResult = json_decode($resoult, true);
        if (empty($wxResult)){
            throw new \Exception('获取session_key及openid时异常，微信内部错误');
        }else{
            $LoginFail = array_key_exists('errcode', $wxResult);
            if ($LoginFail){
                //TODO 获取失败
            }else{
                return $wxResult;
            }
        }
    }



}