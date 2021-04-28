<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->url() == route('user.store')){
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
            'name' => 'required|string',
            'email' => 'email|required',
            'check_email' => 'email|required|same:email',
            'hourly_wage' => 'integer|max:65536|min:0|nullable',
            'staff_number' => 'integer|max:255|min:0|nullable',
            'auth' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前の登録が必須です',
            'name.string' => '名前は文字列で入力してください',
            'email.email' => '正しいメールアドレスを入力してください',
            'email.required' => 'メールアドレスの入力が必要です',
            'check_email.email' => '正しいメールアドレスを入力してください',
            'check_email.required' => 'メールアドレスの入力が必要です',
            'check_email.same' => '同じメールアドレスを入力してください',
            'hourly_wage.integer' => '整数値で入力してください',
            'hourly_wage.max' => '65536以下の数値で入力してください',
            'hourly_wage.min' => '0以上の数値で入力してください',
            'staff_number.integer' => '整数値で入力してください',
            'staff_number.max' => '255以下の数値で入力してください',
            'staff_number.min' => '0以上の数値で入力してください',
            'auth.required' => '権限を選択してください',
        ];
    }
}
