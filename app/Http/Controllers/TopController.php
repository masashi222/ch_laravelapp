<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends Controller
{
    public function owner() {
        $menu_sub_shift = [
            ['url'=>route('owner.shift'),'title'=>'シフト確認'],
            ['url'=>route('owner.shift_period_select'),'title'=>'シフト作成']
        ];
        $menu_sub_attendance = [
            ['url'=>route('owner.attendance_period_select'),'title'=>'給与確定手続き'],
            ['url'=>route('owner.payroll_period_select'),'title'=>'給与計算書表示'],
            ['url'=>route('owner.stamp_key'),'title'=>'勤怠打刻キー確認']
        ];
        $menu_sub_user = [
            ['url'=>route('owner.user'),'title'=>'ユーザー確認']
        ];
        $menu_sub_account = [
            ['url'=>'','title'=>'ログイン情報変更']
        ];
        return view('owner.top',['menu_sub_shift'=>$menu_sub_shift,'menu_sub_attendance'=>$menu_sub_attendance,
            'menu_sub_user'=>$menu_sub_user,'menu_sub_account'=>$menu_sub_account
        ]);
    }

    public function staff() {
        $menu_sub_shift = [
            ['url'=>route('owner.shift'),'title'=>'シフト確認'],
            ['url'=>route('staff.shift_submit'),'title'=>'シフト作成']
        ];
        $menu_sub_attendance = [
            ['url'=>route('owner.attendance_info'),'title'=>'勤怠情報確認'],
        ];
        $menu_sub_account = [
            ['url'=>'','title'=>'ログイン情報変更']
        ];
        return view('staff.top',['menu_sub_shift'=>$menu_sub_shift,'menu_sub_attendance'=>$menu_sub_attendance,'menu_sub_account'=>$menu_sub_account]);
    }

    public function admin() {
        $menu_sub_shift = [
            ['url'=>route('owner.shift'),'title'=>'シフト確認'],
            ['url'=>route('owner.shift_period_select'),'title'=>'シフト作成']
        ];
        $menu_sub_attendance = [
            ['url'=>route('owner.attendance_period_select'),'title'=>'給与確定手続き'],
            ['url'=>route('owner.payroll_period_select'),'title'=>'給与計算書表示'],
            ['url'=>route('owner.stamp_key'),'title'=>'勤怠打刻キー確認']
        ];
        $menu_sub_user = [
            ['url'=>route('owner.user'),'title'=>'ユーザー確認']
        ];
        $menu_sub_owner = [
            ['url'=>route('admin.owner'),'title'=>'オーナー確認'],
        ];
        $menu_sub_account = [
            ['url'=>'','title'=>'ログイン情報変更']
        ];
        return view('admin.top',['menu_sub_shift'=>$menu_sub_shift,'menu_sub_attendance'=>$menu_sub_attendance,
            'menu_sub_user'=>$menu_sub_user,'menu_sub_owner'=>$menu_sub_owner,'menu_sub_account'=>$menu_sub_account
        ]);
    }

    public function accountant() {
        $menu_sub_attendance = [
            ['url'=>route('owner.payroll'),'title'=>'給与計算書表示'],
        ];
        $menu_sub_account = [
            ['url'=>'','title'=>'ログイン情報変更']
        ];
        return view('accountant.top',['menu_sub_attendance'=>$menu_sub_attendance,'menu_sub_account'=>$menu_sub_account]);
    }
}
