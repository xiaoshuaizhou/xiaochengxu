<?php

namespace App\Validator;


use App\Rules\IDMustBePostiveInt;

class BaseValidate
{
    /**
     * 验证id 必须是正整数
     * @param $id
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function IdMustBePostiveInt($id)
    {
        $validator = \Validator::make(['id' => $id], [
            'id' => ['required', new IDMustBePostiveInt()],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'error_code' => 204,
                'message' => $errors->first('id')
            ]);
        }else{
            return true;
        }
    }
}