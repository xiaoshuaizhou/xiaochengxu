<?php

namespace App\Validator;

use App\Exceptions\AddressException;
use App\Rules\IsMobile;
use App\Rules\IsNotEmpty;

class AddressValidator extends BaseValidate
{
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
            ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            throw new AddressException($errors->all());
        } else {
            return true;
        }
    }
}