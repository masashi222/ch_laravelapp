<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveWorkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->url() == route('stamp.update')){
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
            'carfare' => 'integer|min:0|required|max:65536'
        ];
    }

    public function messages()
    {
        return [
            'carfare.integer' => '整数値で入力してください',
            'carfare.min' => '0以上の整数値で入力してください',
            'catfare.max' => '交通費の値が大きすぎます'
        ];
    }
}
