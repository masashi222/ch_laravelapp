<?php

namespace App\Http\Requests;

use App\Rules\KeyCheck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class GoWorkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        if ($this->url() == route('stamp.store')){
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
            'key' => 'required|integer|size:4',
            'key' => new KeyCheck,
            'carfare' => 'integer|min:0|nullable|max:65536'
        ];
    }

    public function messages()
    {
        return [
            'key.required' => '打刻キーの入力が必須です',
            'key.integer' => '整数値以外の入力はできません',
            'key.size' => '4桁の数字で入力してください',
            'carfare.integer' => '整数値以外の入力はできません',
            'carfare.min' => '0以上の整数値での入力してください' ,
            'carfare.max' => '交通費の値が大きすぎます'
        ];
    }
}
