<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submittal;
use Illuminate\Support\Facades\Auth;
use App\Closing;

class SubmitStatusController extends Controller
{
    /**
     * 提出ステータスを0->1にする
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function submit() {
        // 取得データの期間設定
        $closing = Closing::latest()->first();
        $from = date('Y-m-d',strtotime('+ 1day',strtotime($closing->closing_date)));
        $check_closing = substr($closing->closing_date,-2,2);
        if($check_closing == '15'){
            $to = date('Y-m-d',strtotime('last day of this month',strtotime($from)));
        }else{
            $to = date('Y-m-15',strtotime('+ 1day',strtotime($from)));
        }
        // 提出ステータスの変更
        $is_submittals = Submittal::where('user_userid',Auth::id())->where('submittal_status','0')
        ->whereBetween('go_date',[$from,$to])->exists();
        if($is_submittals){
            $submittals = Submittal::where('user_userid',Auth::id())->where('submittal_status','0')
            ->whereBetween('go_date',[$from,$to])->get();
            foreach($submittals as $submittal){
                $submittal->submittal_status = '1';
                $submittal->save();
            }
        }else{
            $submittal = new Submittal;
            // 次の締め切りの最終日を挿入
            $submittal->go_date = $to;
            $submittal->submittal_status = '2';
            $submittal->user_userid = Auth::id();
            $submittal->save();
        }

        return redirect('shift/submit');
    }

    /**
     * 提出ステータスを1->0にする
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function back() {
        // 取得データの期間設定
        $closing = Closing::latest()->first();
        $from = date('Y-m-d',strtotime('+ 1day',strtotime($closing->closing_date)));
        $check_closing = substr($closing->closing_date,-2,2);
        if($check_closing == '15'){
            $to = date('Y-m-d',strtotime('last day of this month',strtotime($from)));
        }else{
            $to = date('Y-m-15',strtotime('+ 1day',strtotime($from)));
        }
        // 提出ステータスの変更
        $is_submittals = Submittal::where('user_userid',Auth::id())->where('submittal_status','1')
        ->whereBetween('go_date',[$from,$to])->exists();
        if($is_submittals){
            $submittals = Submittal::where('user_userid',Auth::id())->where('submittal_status','1')
            ->whereBetween('go_date',[$from,$to])->get();
            foreach($submittals as $submittal){
                $submittal->submittal_status = '0';
                $submittal->save();
            }
        }else{
            $submittal = Submittal::where('user_userid',Auth::id())->where('submittal_status','2')
            ->whereBetween('go_date',[$from,$to])->first();
            $submittal->delete();
        }

        return redirect('shift/submit');
    }
}
