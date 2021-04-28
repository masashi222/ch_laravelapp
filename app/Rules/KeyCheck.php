<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Key;

class KeyCheck implements Rule
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
        $key = Key::first();
        if($key->today_date == date('Y-m-d') && $key->key == $value){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '本日の打刻キーを入力してください';
    }
}
