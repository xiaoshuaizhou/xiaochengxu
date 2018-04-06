<?php

namespace App\Rules;

class OrderProducts extends IDMustBePostiveInt
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws \App\Exceptions\OrderProducts
     */
    public function passes($attribute, $value)
    {
        if (!is_array($value)){
            throw new \App\Exceptions\OrderProducts('商品不能为空');
        }
        if (empty($value)) {
            throw new \App\Exceptions\OrderProducts('商品参数错误');
        }

        $status = true;

        foreach ($value as $item){
            foreach ($item as $k => $v){
                if (! parent::passes($attribute, $v)){
                    $status = false;
                }
            }
        }

        return $status;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '商品列表参数错误';
    }

}
