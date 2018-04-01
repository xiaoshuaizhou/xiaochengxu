<?php

namespace App\Rules;

class CheckIds extends IDMustBePostiveInt
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
        $ids = explode(',', $value);

        if (empty($value)) return false;

        foreach ($ids as $id) {
            if (! parent::passes($attribute, $id)) return false;
        }

        return true;

    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ids必须是以逗号分割的正整数';
    }
}
