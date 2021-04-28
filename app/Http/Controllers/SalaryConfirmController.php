<?php

namespace App\Http\Controllers;

use App\Stamp;
use Illuminate\Http\Request;

class SalaryConfirmController extends Controller
{
    public function __invoke()
    {
        // 期間内で退勤済みで確定ステータスが0のデータの取得
        $to_attendance = date('Y-m-d 23:59:59',strtotime(session()->get('to_attendance')));
        $is_stamping = Stamp::where('user_userid',session()->get('userid_attendance'))->whereBetween('go_time',[session()->get('from_attendance'),$to_attendance])
        ->whereNull('leave_time')->where('salary_confirmed_status','0')->doesntExist();
        if($is_stamping){
            // 打刻中のデータがない時、給与確定
            $stamps = Stamp::where('user_userid',session()->get('userid_attendance'))->whereBetween('go_time',[session()->get('from_attendance'),$to_attendance])
            ->whereNotNull('leave_time')->where('salary_confirmed_status','0')->get();   

            foreach($stamps as $stamp){
                $stamp->salary_confirmed_status = '1';
                $stamp->save();
            }   
        }

        return redirect ('/attendance/staff/select');
    }
}
