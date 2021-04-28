<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Closing;

class ShiftPeriodSelectController extends Controller
{
    public function get() {
        $closings = Closing::get();
        $latest_closing_date = Closing::orderBy('closing_date','desc')->first()->closing_date;

        foreach( $closings as $closing){
            $check_closing = date('j',strtotime($closing->closing_date));
            if($latest_closing_date == $closing->closing_date && $check_closing == '15'){
                // 最新データかつ15日
                $data[] = ['value'=>date('Y-m-d',strtotime($closing->closing_date)),'display'=>date('Y年n月',strtotime($closing->closing_date)) . '前半'];
                $data[] = ['value'=>date('Y-m-d',strtotime('last day of this month',strtotime($closing->closing_date))),
                    'display'=>date('Y年n月',strtotime($closing->closing_date)) . '後半'];
            }else if($latest_closing_date == $closing->closing_date){
                // 最新データ
                $data[] = ['value'=>date('Y-m-d',strtotime($closing->closing_date)),'display'=>date('Y年n月',strtotime($closing->closing_date)) . '後半'];
                $data[] = ['value'=>date('Y-m-15',strtotime('+1 day',strtotime($closing->closing_date))),
                    'display'=>date('Y年n月',strtotime('+1 day',strtotime($closing->closing_date))) . '前半'];
            }else if( $check_closing == '15'){
                // 15日
                $data[] = ['value'=>date('Y-m-d',strtotime($closing->closing_date)),'display'=>date('Y年n月',strtotime($closing->closing_date)) . '前半'];
            }else{
                // 上記に該当しない場合
                $data[] = ['value'=>date('Y-m-d',strtotime($closing->closing_date)),'display'=>date('Y年n月',strtotime($closing->closing_date)) . '後半'];
            }
        }

        return view ('shift.period_select',['data'=>$data]);
    }

    public function post(Request $request) {
        // 取得データの期間を設定
        $to = $request->period;
        $check_to = date('j',strtotime($to));
        if( $check_to == '15'){
            $from = date("Y-m-01",strtotime($to));
        }else{
            $from = date("Y-m-16",strtotime($to));
        }

        // セッションへ$to,$fromを保存
        if(!empty($request)){
            session()->put('to_shift', $to);
            session()->put('from_shift', $from);
        }
        return redirect ('shift/submit_status');
    }
}
