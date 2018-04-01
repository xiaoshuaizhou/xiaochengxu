<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProductCount extends IDMustBePostiveInt
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
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (parent::passes($attribute, $value) && $value >=1 && $value <= 15){
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '商品数量必须是正整数且在1到15之间';
    }
}
