<?php

namespace App\Http\Validator;

use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{
    /**
     * カタカナのバリデーション
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateKana($attribute, $value, $parameters)
    {
        if (mb_strlen($value) > 100) {
            return false;
        }

        if (preg_match('/[^ァ-ヶー]/u', $value) !== 0) {
            return false;
        }

        return true;
    }

}