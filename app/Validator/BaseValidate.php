<?php

namespace App\Validator;


use App\Exceptions\CheckIdsException;
use App\Exceptions\IDMustBePostException;
use App\Rules\CheckIds;
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

    /**
     * 验证IDS必须是逗号分割的正整数
     * @param $ids
     * @return bool
     * @throws IDMustBePostException
     */
    public function checkIDs($ids)
    {
        $validator = \Validator::make(['ids' => $ids],
            ['ids' => ['required', new CheckIds()],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            throw new IDMustBePostException($errors->first('ids'));
        }else{
            return true;
        }
    }
}