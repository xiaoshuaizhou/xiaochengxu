<?php

namespace App\Http\Middleware;

use App\Enum\ScopeEnum;
use App\Exceptions\ForbiddenException;
use App\Exceptions\TokenException;
use App\Repositories\TokenRepository;
use Closure;

/**
 * 验证初级权限,根据缓存中的scope值判断
 * Class CheckPrimaryScope
 * @package App\Http\Middleware
 */
class CheckPrimaryScope
{
    /**
     * 获取缓存中的 scope 值 判断访问权限
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws ForbiddenException
     * @throws TokenException
     */
    public function handle($request, Closure $next)
    {
        if (TokenRepository::getCurrentTokenVar('scope')){
            if (TokenRepository::getCurrentTokenVar('scope') >= ScopeEnum::USER){
                return $next($request);
            }else{
                throw new ForbiddenException('暂无访问权限');
            }
        }else{
            throw new TokenException('token无效或已过期');
        }

    }
}
