<?php

namespace App\Validator;

use App\Exceptions\AddressException;
use App\Rules\IsMobile;
use App\Rules\IsNotEmpty;

class AddressValidator extends BaseValidate
{
    /**
     * 地址信息验证
     * @param $data
     * @return bool
     * @throws AddressException
     */
    public function checkAddress($data)
    {
        $validator = \Validator::make(
            [
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'province' => $data['province'],
                'city' => $data['city'],
                'country' => $data['country'],
                'detail' => $data['detail'],
            ],
            [
                'name' => ['required', new IsNotEmpty(),],
                'mobile' => ['required', new IsMobile(),],
                'province' => ['required', new IsNotEmpty(),],
                'city' => ['required', new IsNotEmpty()],
                'country' => ['required', new IsNotEmpty(),],
                'detail' => ['required', new IsNotEmpty(),],
            ],
            [
                'name.required' => '名字不能为空',
                'mobile.required' => '手机号不能为空',
                'mobile.IsMobile' => '请输入正确的手机号',
                'province.required' => '省份不能为空',
                'city.required' => '城市不能为空',
                'country.required' => '县不能为空',
                'detail.required' => 'detail不能为空',
            ]
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $error){
                throw new AddressException($error);
            }
        } else {
            return true;
        }
    }
}