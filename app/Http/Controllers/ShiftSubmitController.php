<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShiftSubmitController extends Controller
{
    public function top() {
        $menu_sub_shift = ['シフト確認','シフト作成'];
        $menu_sub_attendance = ['勤怠情報画面'];
        $menu_sub_account = ['ログイン情報変更画面'];
        return view('staff.top',['menu_sub_shift'=>$menu_sub_shift,'menu_sub_attendance'=>$menu_sub_attendance,'menu_sub_account'=>$menu_sub_account]);
    }

    public function shift_submit() {
        return view('staff.shift_submit');
    }
}
