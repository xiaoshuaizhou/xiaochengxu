<?php

namespace App\Validator;


use App\Exceptions\TokenException;
use App\Rules\TokenIsNotEmpty;

class TokenGetValidator
{
    /**
     * 验证code是否为空
     * @param $code
     * @return bool
     * @throws TokenException
     */
    public function checkToken($code)
    {
        $validator = \Validator::make(['code' => $code],
            [
                'code' => [ 'required', new TokenIsNotEmpty(), ],
            ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            throw new TokenException($errors->first('code'));
        } else {
            return true;
        }
    }
}