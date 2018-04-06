<?php

namespace App\Repositories;

use App\Enum\ScopeEnum;
use App\Exceptions\TokenException;
use App\Exceptions\WeChatException;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

/**
 * 处理 UserToken 类
 * Class UsersRepository
 * @package App\Repositories
 */
class UsersTokenRepository extends TokenRepository
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
     * 获取token
     * @return string
     * @throws TokenException
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
                return $this->grantToken($wxResult);
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
        //生成令牌，准备缓存数据，写入缓存  key: 令牌  value: wxResoult  uid   scope[访问权限]
        //返回令牌到客户端
     * @param $wxResult
     * @return string
     * @throws TokenException
     * @throws WeChatException
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
        //拼装 缓存 value数据
        $cachedValue = $this->prepareCachedValue($wxResult, $uid);

        return $this->saveToCache($cachedValue);
    }

    /**
     * 拼装缓存 value
     * @param $wxResult  scope 代表是访问权限 16 代表APP用户
     * @param $uid
     * @return mixed
     */
    protected function prepareCachedValue($wxResult, $uid)
    {
        $cachedValue = $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = ScopeEnum::USER;

        return $cachedValue;
    }

    /**
     * 保存缓存 Redis  令牌的有效时间就是缓存的有效时间
     * @param $cachedValue
     * @return string
     * @throws TokenException
     */
    public function saveToCache($cachedValue)
    {
        //生成 key
        $key = parent::generateToken();
        $value = json_encode($cachedValue);
        //写入Redis缓存
        try{
            Redis::set($key, $value);
            Redis::EXPIRE($key, env('MINUTES'));
        }catch (\Exception $exception){
            throw new TokenException('Token已过期或无效token');
        }

        return $key;
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
            throw new WeChatException($wxResult['errmsg'], $wxResult['errcode']);
        }

        return $user->id;
    }


}