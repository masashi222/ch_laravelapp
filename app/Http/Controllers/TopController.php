<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TopController extends Controller
{
    public function __invoke()
    {
        $data_shift = [];
        $data_attendance = [];
        $data_user = [];
        $data_account = [
            ['url'=>'account','item'=>'アカウント管理'],
        ];
        if(Gate::allows('staff-higher')){
            // 'staff'ユーザー以上
            $data_attendance[] = ['url'=>'attendance.period.select','item'=>'勤怠管理'];
            $data_shift[] = ['url'=>'shift','item'=>'シフト一覧'];
        }
        if(Gate::allows('owner-higher')){
            // 'owner'ユーザー以上
            $data_attendance[] = ['url'=>'payroll.period.select','item'=>'給与計算書'];
            $data_attendance[] = ['url'=>'stamp.key','item'=>'勤怠打刻キー表示'];
            $data_shift[] = ['url'=>'shift.period.select','item'=>'シフト作成'];
            $data_user[] = ['url'=>'user','item'=>'ユーザー管理'];
        }
        if(Gate::allows('accountant')){
            // 'accountant'ユーザー
            $data_attendance[] = ['url'=>'payroll.period.select','item'=>'給与計算書'];
        }
        if(Gate::allows('staff') || Gate::allows('admin')){
            // 'staff''admin'ユーザーのみ
            $data_attendance[] = ['url'=>'stamp','item'=>'勤怠打刻画面'];
            $data_shift[] = ['url'=>'shift.submit','item'=>'シフト提出'];
        }

        return view ('top.index',['data_shift'=>$data_shift,'data_attendance'=>$data_attendance,'data_user'=>$data_user,'data_account'=>$data_account,]);
    }

}
