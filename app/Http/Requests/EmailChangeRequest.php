<?php

namespace App\Http\Requests;

use App\Rules\PasswordCheck;
use Illuminate\Foundation\Http\FormRequest;

class EmailChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->url() == route('account.update')){
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
            'email' => 'required|email',
            'check_email' => 'required|email|same:email',
            'password' => 'required',
            'password' => new PasswordCheck,
        ];
    }

    public function messages()
    {
        return  [
            'email.required' => 'アドレスを入力してください',
            'email.email' => '正しいアドレスを入力してください',
            'check_email.required' => 'アドレスを入力してください',
            'check_email.email' => '正しいアドレスを入力してください',
            'check_email.same' => '上記と同じアドレスを入力してください',
            'password.required' => 'パスワードを入力してください',
        ];
    }
}
