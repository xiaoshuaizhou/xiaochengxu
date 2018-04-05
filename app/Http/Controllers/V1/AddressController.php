<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\UserException;
use App\Models\User;
use App\Repositories\TokenRepository;
use App\Validator\AddressValidator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        (new AddressValidator())->checkAddress($request->all());
        //根据token获取UID
        $uid = TokenRepository::getCurrentUid();
        //根据UID查找用户，判断用户是否存在，不存在抛异常
        $user = User::find($uid);
        if (!$user){
            throw new UserException('用户不存在');
        }
        //获取用户从客户端传递来的地址信息

        //根据用户的地址是否存在，判断是添加地址还是更新地址
    }
}
