<?php

namespace App\Validator;


use App\Exceptions\IDMustBePostException;
use App\Rules\IDMustBePostiveInt;

class BaseValidate
{
    /**
     * 验证id 必须是正整数
     * @param $id
     * @return bool
     * @throws \App\Exceptions\IDMustBePostException
     */
    public function IdMustBePostiveInt($id)
    {
        $validator = \Validator::make(['id' => $id], [
            'id' => ['required', new IDMustBePostiveInt()],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            throw new IDMustBePostException($errors->first('id'));
        }else{
            return true;
        }
    }
}