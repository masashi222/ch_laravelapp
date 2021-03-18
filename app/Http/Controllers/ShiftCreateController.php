<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShiftCreateController extends Controller
{
    public function top() {
        $menu_sub_shift = ['シフト確認','シフト作成'];
        $menu_sub_attendance = ['勤怠確認','給与確定手続き','給与計算書表示','勤怠打刻キー確認'];
        $menu_sub_user = ['ユーザー確認'];
        $menu_sub_account = ['ログイン情報変更'];
        return view('owner.top',['menu_sub_shift'=>$menu_sub_shift,'menu_sub_attendance'=>$menu_sub_attendance,
            'menu_sub_user'=>$menu_sub_user,'menu_sub_account'=>$menu_sub_account
        ]);
    }

    public function shift() {
        return view('owner.shift');
    }
}
