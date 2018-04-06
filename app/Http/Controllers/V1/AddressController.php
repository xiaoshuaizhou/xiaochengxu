<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\AddressException;
use App\Exceptions\UserException;
use App\Models\User;
use App\Repositories\TokenRepository;
use App\Validator\AddressValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    /**
     * AddressController constructor.
     */
    public function __construct()
    {
        $this->middleware('primaryScope')->only('createOrUpdate');
    }
    /**
     * 新增或创建地址
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws UserException
     * @throws \App\Exceptions\AddressException
     * @throws \App\Exceptions\TokenException
     */
    public function createOrUpdate(Request $request)
    {
        //接受参数
        $dataArray = $request->only(['name', 'mobile', 'province', 'city', 'country', 'detail']);


        (new AddressValidator())->checkAddress($dataArray);
        //根据token获取UID
        $uid = TokenRepository::getCurrentUid();
        //根据UID查找用户，判断用户是否存在，不存在抛异常
        $user = User::find($uid);
        if (!$user){
            throw new UserException('用户不存在');
        }
        //获取用户从客户端传递来的地址信息
        //根据用户的地址是否存在，判断是添加地址还是更新地址

        $dataArray['user_id'] = $uid;
        $userAddress = $user->address;


        if (!$userAddress){
            try{
                $user->address()->create($dataArray);
            }catch (\Exception $exception){

                throw new AddressException('创建失败');
            }
        }else{
            try{
                $user->address()->update($dataArray);
            }catch (\Exception $exception){

                throw new AddressException('更新失败');
            }
        }

        return \Response::json(['message' => 'success', 'status_code'=>201], 201);
    }
}
