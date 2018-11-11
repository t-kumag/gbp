<?php

namespace App\Http\Validator;

use Illuminate\Validation\Validator;

use Session;
use DB;
use Response;

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

    /**
     * child_idの家族のuserか確認する
     *
     * @param $attrivute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateChildUser($attrivute, $value, $parameters)
    {
        $user_id = Session::get('user_id');
        $family = DB::table('families')->where('child_id', '=', $value)->where('user_id', '=', $user_id)->first();
        if (!empty($family)) {
            return true;
        }
        return false;
    }

}