<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $url = route('attendance.store');
        $bool = preg_match('{^'. $url .'.*$}',$this->url());
        if ($bool){
            return true;
        }else{
            return false;
        }
    }

    /**
     * バリーデーションのためにデータを準備
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'format_go_time' => substr_replace($this->go_time,' ','10','1'),
            'format_leave_time' => substr_replace($this->leave_time,' ','10','1'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'go_time' => 'required',
            'leave_time' => 'required',
            'format_leave_time' => 'after:format_go_time',
            'carfare' => 'nullable|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'go_time.required' => '出勤時間の入力が必須です',
            'leave_time.required'=> '退勤時間の入力が必須です',
            'format_leave_time.after' => '退勤時間は出勤時間よりも未来である必要があります',
            'carfare.integer' => '整数値で入力してください',
            'carfare.min' => '0以上の整数値で入力してください',
        ];
    }
}
