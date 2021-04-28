<?php

namespace App\Http\Controllers;

use App\Stamp;
use App\User;
use Illuminate\Http\Request;

class PayrollDisplayController extends Controller
{
    public function __invoke()
    {
        // 従業員のデータの取得
        $users = User::where('auth','7')->orderBy('staff_number','asc')->get();

        foreach($users as $user){
            // ユーザーの分給設定
            $minute_salary = round($user->hourly_wage/60,5);
            $midnight_minute_salary = round(floor($user->hourly_wage*1.25)/60,5);
            // 期間内の従業員の打刻データの取得
            $to_payroll = date('Y-m-d 23:59:59',strtotime(session()->get('to_payroll')));
            $is_stamps = Stamp::whereBetween('go_time',[session()->get('from_payroll'),$to_payroll])
            ->where('salary_confirmed_status','1')->where('user_userid',$user->userid)->exists();
            $isnt_stamps = Stamp::whereBetween('go_time',[session()->get('from_payroll'),$to_payroll])
            ->where('user_userid',$user->userid)->doesntExist();

            if($is_stamps){
                $item = ['name'=>$user->name,'staff_number'=>$user->staff_number,'normal_time'=>0,'midnight_time'=>0,'normal_salary'=>0,'midnight_salary'=>0,'total_carfare'=>0,
                'days'=>0];

                $stamps = Stamp::whereBetween('go_time',[session()->get('from_payroll'),$to_payroll])
                ->where('user_userid',$user->userid)->where('salary_confirmed_status','1')->get();
                
                foreach($stamps as $stamp){
                    $second_go = strtotime($stamp->go_time);
                    $second_ten = strtotime(date('Y-m-d 22:00:00',strtotime($stamp->go_time)));
                    $second_leave = strtotime($stamp->leave_time);

                    $diff = 0;
                    $midnight_diff = 0;
                    if($second_leave <= $second_ten){
                        // 退勤が22:00以前
                        $diff = floor(($second_leave - $second_go)/60);
                    }else if($second_go >= $second_ten){
                        // 出勤が22:00以降
                        $midnight_diff = floor(($second_leave - $second_go)/60);
                    }else{
                        $midnight_diff = floor(($second_leave - $second_ten)/60);
                        $diff = floor(($second_ten - $second_go)/60);
                    }
                    // 就業時間と給与の設定
                    $item['normal_time'] = $item['normal_time'] + $diff;
                    $item['midnight_time'] = $item['midnight_time'] + $midnight_diff;
                    $item['normal_salary'] = $item['normal_salary'] + floor($minute_salary*$diff);
                    $item['midnight_salary'] = $item['midnight_salary'] + floor($midnight_minute_salary*$midnight_diff);
                    $item['total_carfare'] = $item['total_carfare'] + $stamp->carfare;
                    $item['days'] = $item['days'] + 1;
                }
                $item['normal_time'] = floor($item['normal_time']/60) . ':' . substr(('0' .$item['normal_time']%60),-2);
                $item['midnight_time'] = floor($item['midnight_time']/60) . ':' . substr(('0' .$item['midnight_time']%60),-2);
                $item['salary'] = number_format($item['normal_salary'] + $item['midnight_salary'] + $item['total_carfare']*0.7);
                $item['carfare'] = number_format($item['total_carfare']*0.7);
                $item['total_carfare'] = number_format($item['total_carfare']);
                $item['total_salary'] = number_format($item['normal_salary'] + $item['midnight_salary']);
                $item['normal_salary'] = number_format($item['normal_salary']);
                $item['midnight_salary'] = number_format($item['midnight_salary']);
            }else if($isnt_stamps){
                // 給与なし
                $item = ['name'=>$user->name,'staff_number'=>$user->staff_number,'normal_time'=>0,'midnight_time'=>0,'normal_salary'=>0,
                'midnight_salary'=>0,'total_carfare'=>0,'days'=>0,'carfare'=>0,'total_salary'=>0,'salary'=>0];
            }else{
                continue;
            }
            $data[] = $item;
        }

        // 期間データの送信
        $period['from'] = date('Y/n/j',strtotime(session()->get('from_payroll')));
        $period['to'] = date('Y/n/j',strtotime(session()->get('to_payroll')));

        return view ('attendance.payroll',['data'=>$data,'period'=>$period]);
    }
}
