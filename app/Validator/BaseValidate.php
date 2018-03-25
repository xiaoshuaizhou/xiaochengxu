<?php

namespace App\Validator;


use App\Rules\IDMustBePostiveInt;

class BaseValidate
{
    /**
     * 验证id为正整数
     * @param $id
     */
    public function IdMustBePostiveInt($id)
    {
        $validator = \Validator::make(['id' => $id], [
            'id' => ['required', new IDMustBePostiveInt()],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            dd($errors->get('id'));
        }
    }
}