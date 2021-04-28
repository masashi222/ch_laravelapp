<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submittal;
use App\User;
use App\Closing;
use Illuminate\Support\Facades\DB;

class SubmitStatusDisplayController extends Controller
{
    public function __invoke(Request $request) {
        // 提出者データの取得
        $shift_data = Submittal::join('users','submittals.user_userid','=','users.userid')
        ->where('submittal_status','1')->whereBetween('go_date',[session()->get('from_shift'),session()->get('to_shift')])->get();
        foreach($shift_data as $shift_item){
            $shift_item['split_go_time'] = $shift_item->split_go_time;
            $shift_item['split_leave_time'] = $shift_item->split_leave_time;
        }

        // 未提出者データの取得
        $is_submittals = Submittal::whereBetween('go_date',[session()->get('from_shift'),session()->get('to_shift')])->exists();
        if($is_submittals){
            // 1人以上提出
            $usersid = User::where('auth','7')->pluck('userid');
            foreach($usersid as $userid){
                $usersid_array[] = $userid;
            }
            $submittals = Submittal::whereBetween('go_date',[session()->get('from_shift'),session()->get('to_shift')])
            ->whereIn('submittal_status',[1,2])->pluck('user_userid');
            foreach($submittals as $submittal){
                $submittals_array[] = $submittal;
            }

            $usersid_diff = array_diff($usersid_array,$submittals_array);
            
            $unsubmitters_data = [];
            foreach($usersid_diff as $userid_diff){
                $user = User::where('userid',$userid_diff)->first();
                $unsubmitters_data[] = [
                    'user_name'=> $user->name,
                    'user_color'=> $user->color,
                ];
            }
        }else{
            // 全員未提出
            $users = User::where('auth','7')->get();
            foreach ($users as $user){
                $unsubmitters_data[] = [
                    'user_name'=> $user->name,
                    'user_color'=> $user->color,
                ];
            }
        }

        // シフト提出締め切りデータの取得
        $closing_date = Closing::orderBy('closing_date','desc')->first()->closing_date;
        if(strtotime($closing_date) < strtotime(session()->get('to_shift'))){
            $check_closing = date('j',strtotime($closing_date));
            if( $check_closing == '15'){
                $from = date("n/j",strtotime("+ 1 day",strtotime($closing_date)));
                $to = date("n/j",strtotime("last day of this month",strtotime($closing_date)));
            }else{
                $from = date("n/j",strtotime("+ 1 day",strtotime($closing_date)));
                $to = date("n/15",strtotime("+ 1 day",strtotime($closing_date)));
            }
            $closing_data = ['from'=>$from,'to'=>$to];
        }else{
            $closing_data = null;
        }

        // 表示するカレンダーに渡すデータ
        $year = date('Y',strtotime(session()->get('from_shift')));
        $month = date('n',strtotime(session()->get('from_shift'))) - 1;
        $from_date = date('j',strtotime(session()->get('from_shift')));
        $to_date = date('j',strtotime(session()->get('to_shift')));
        $calendar_data = ['year'=>$year,'month'=>$month,'from_date'=>$from_date,'to_date'=>$to_date];

        return view('shift.submit_status',['shift_data'=>$shift_data,'unsubmitters_data'=>$unsubmitters_data,'closing_data'=>$closing_data,'calendar_data'=>$calendar_data]);
    }
}
