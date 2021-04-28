<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stamp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AttendancePeriodSelectController extends Controller
{
    public function get()
    {
        // 期間の選択が可能な最初の月
        $stamp =  Stamp::orderBy('go_time','asc')->first();
        if(isset($stamp)){
            $param_date = date('j',strtotime($stamp->go_time));
            if($param_date <= 20){
                // 当月の１月前の21から期間の選択ができる
                $from = date('Y-m-21',strtotime('first day of last month',strtotime($stamp->go_time)));
            }else{
                // 当月の21から選択できる
                $from = date('Y-m-21',strtotime($stamp->go_time));
            }

            // 期間の選択が可能な最後の月
            $today = date('j');
            if($today <= 20){
                // 今月の20までの期間の選択ができる
                $to = date('Y-m-20');
            }else{
                // 来月の20までの期間の選択ができる
                $to = date('Y-m-20',strtotime('first day of next month'));
            }
            
            // viewに渡す変数作成
            $count = 0;
            while($count < 100){
                if($count == 0){
                    $sep = date('Y-m-20',strtotime('+ 1month',strtotime($from)));
                }else{
                    $sep = date('Y-m-20',strtotime('+ 1month',strtotime($sep)));
                }
                $data[] = [
                    'value'=>date('Y-m-d',strtotime($sep)),'display'=>date('Y年n月',strtotime($sep))
                ];

                if($sep == $to){
                    break;
                }else{
                    $count++;
                    continue;
                }
            }
        }else{
            $data = null;
        }

        return view ('attendance.period_select',['data'=>$data]);
    }

    public function post(Request $request)
    {
        // 取得データの期間を設定
        $to = $request->period;
        $from = date('Y-m-21',strtotime('- 1month',strtotime($to)));

        // セッションへ$to,$fromを保存
        if(!empty($request)){
            session()->put('to_attendance', $to);
            session()->put('from_attendance', $from);
        }

        // リダイレクト
        if(Gate::allows('staff')){
            // スタッフ権限のみのリダイレクト先
            return redirect ('/attendance/userid/' . Auth::id());
        }else if(Gate::allows(('owner-higher'))){
            // オーナー権限以上のみのリダイレクト先
            return redirect ('/attendance/staff/select');
        }
    }
}
