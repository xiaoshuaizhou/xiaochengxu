<?php

namespace App\Repositories;

use App\Exceptions\WeChatException;
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
        $this->wxLoginUrl = sprintf(env('WXLOGINURL'), $this->wxAppId, $this->wxAppsecret, $this->code);
    }

    /**
     * @return mixed
     * @throws WeChatException
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
                $this->processLoginError($wxResult);
            }else{
                $this->grantToken($wxResult);
            }
        }
    }

    /**
     * @param $wxResoult
     * @throws WeChatException
     */
    protected function processLoginError($wxResoult)
    {
        throw new WeChatException($wxResoult['errmsg'], $wxResoult['errcode']);
    }

    /**
     * 颁发令牌
        //拿到openID
        //查询数据库，这个openID是否存在
        //如果存在不处理，如果没有存在新增一条User数据
        //生成令牌，准备缓存数据，写入缓存
        //返回令牌到客户端
     * @param $wxResult
     */
    private function grantToken($wxResult)
    {
        $openid = $wxResult['openid'];
        $user = UsersRepository::getUserByOpenId($openid);
        if ($user){
            $uid = $user->id;
        }else{
            $uid = $this->newUser($openid,$wxResult);
        }
    }

    /**
     * @param $openid
     * @param $wxResult
     * @return mixed
     * @throws WeChatException
     */
    private function newUser($openid, $wxResult)
    {
        try{
            $user = UsersRepository::create($openid);
        }catch (\Exception $e){
            throw new WeChatException($wxResult['errmsg'],$wxResoult['errcode']);
        }

        return $user->id;
    }


}