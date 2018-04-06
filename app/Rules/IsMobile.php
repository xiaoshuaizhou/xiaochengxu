<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsMobile implements Rule
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
        $patten = '/^1(3|4|5|7|8)[0-9]\d{8}$/';

        return preg_match($patten, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '请输入正确的手机号';
    }
}
