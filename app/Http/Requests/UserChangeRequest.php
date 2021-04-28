<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $url = route('user.update');
        $bool = preg_match('{^'. $url .'.*$}',$this->url());
        if ($bool){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|nullable',
            'hourly-wage' => 'numeric|max:65536|min:0|nullable',
            'staff-number' => 'numeric|max:255|min:0|nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => '名前は文字列で入力してください',
            'hourly-wage.numeric' => '整数値で入力してください',
            'hourly-wage.max' => '65536以下の数値で入力してください',
            'hourly-wage.min' => '0以上の数値で入力してください',
            'staff-number.numeric' => '整数値で入力してください',
            'staff-number.max' => '255以下の数値で入力してください',
            'staff-number.min' => '0以上の数値で入力してください',
        ];
    }
}
