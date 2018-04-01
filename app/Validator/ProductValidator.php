<?php

namespace App\Validator;


use App\Exceptions\IDMustBePostException;
use App\Rules\ProductCount;

class ProductValidator extends BaseValidate
{
    /**
     * 验证每页商品数量
     * @param $count
     * @return bool
     * @throws IDMustBePostException
     */
    public function checkCount($count)
    {
        $validator = \Validator::make(['count' => $count],
            [
                'count' => [ new ProductCount(), ],
            ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            throw new IDMustBePostException($errors->first('count'));
        } else {
            return true;
        }
    }
}