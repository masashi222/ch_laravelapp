<?php

namespace App\Http\Controllers;

use App\Stamp;
use Illuminate\Http\Request;
use App\User;

class AttendanceStaffSelectController extends Controller
{

    public function __invoke()
    {
        // ユーザーデータの取得
        $data = User::where('auth','7')->get();

        // 給与状態のデータの追加
        $to_attendance = date('Y-m-d 23:59:59',strtotime(session()->get('to_attendance')));
        $stamps = Stamp::whereBetween('go_time',[session()->get('from_attendance'),$to_attendance])
        ->select('user_userid','salary_confirmed_status')->distinct()->get();

        foreach($data as $item){
            $item['status'] = '給与なし';
            foreach($stamps as $stamp){
                if($stamp->user_userid == $item->userid && $stamp->salary_confirmed_status == '0'){
                    $item['status'] = '未確定';
                }else if($stamp->user_userid == $item->userid && $stamp->salary_confirmed_status == '1'){
                    $item['status'] = '確定済';
                }
            }
        }

         // 表示するカレンダーのデータ
        $calendar['month'] = date('n月',strtotime(session()->get('to_attendance')));
        $calendar['year'] = date('Y',strtotime(session()->get('to_attendance')));

        return view ('attendance.staff_select',['data'=>$data,'calendar'=>$calendar]);
    }
}
