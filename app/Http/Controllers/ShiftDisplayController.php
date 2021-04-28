<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Creation;
use App\Submittal;

class ShiftDisplayController extends Controller
{
    public function __invoke()
    {
        $today = date('j');
        if($today <= 15){
            // 今月の1日から末日
            $from = date('Y-m-01');
            $to = date('Y-m-d',strtotime('last day of this month'));
        }else{
            // 今月の16日から翌月の15日
            $from = date('Y-m-16');
            $to = date('Y-m-15',strtotime('+ 1month'));
        }

        $shift_data = Submittal::join('creations','submittals.submittalid','=','creations.submittal_submittalid')
            ->join('users','submittals.user_userid','=','users.userid')
            ->select('submittalid','go_date','submittals.go_time as submittals.go_time','submittals.leave_time as submittals.leave_time',
             'user_userid','creations.go_time','creations.leave_time','submittal_submittalid','name','color')
             ->whereBetween('go_date',[$from,$to])->where('creation_status','1')->get();

        foreach($shift_data as $shift_item){
            $shift_item['split_go_time'] = $shift_item->split_go_time;
            $shift_item['split_leave_time'] = $shift_item->split_leave_time;
        }

        return view ('shift.index',['shift_data'=>$shift_data]);
    }
}
