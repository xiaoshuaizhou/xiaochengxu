<?php

namespace App\Validator;


use App\Rules\OrderProducts;

class OrderProductsGetValidator
{
    /**
     * @param $products
     * @return bool
     * @throws \App\Exceptions\OrderProducts
     */
    public function checkProducts($products)
    {
        $validator = \Validator::make(
            ['products' => $products],
            [
                'products' => [ 'required', new OrderProducts(), ],
            ],
            [
                'products.required' => '商品列表参数不能为空',
                'products.OrderProducts' => '商品列表参数错误',
            ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            throw new \App\Exceptions\OrderProducts($errors->first('products'));
        } else {
            return true;
        }
    }
}