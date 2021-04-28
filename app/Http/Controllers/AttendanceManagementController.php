<?php

namespace App\Http\Controllers;

use App\Stamp;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceChangeRequest;
use App\Http\Requests\AttendanceRegisterRequest;
use App\User;

class AttendanceManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userid = null)
    {
        if(isset($userid)){
            session()->put('userid_attendance',$userid);
        }

         // 表示するカレンダーのデータ
         $calendar['month'] = date('n月',strtotime(session()->get('to_attendance')));
         $calendar['year'] = date('Y',strtotime(session()->get('to_attendance')));

         // ユーザー情報の取得
         $user = User::where('userid',session()->get('userid_attendance'))->first();

        // 選択された期間内の勤怠打刻データの取得
        $to_attendance = date('Y-m-d 23:59:59',strtotime(session()->get('to_attendance')));
        $data = Stamp::whereBetween('go_time',[session()->get('from_attendance'),$to_attendance])->where('user_userid',session()->get('userid_attendance'))
        ->whereNotNull('leave_time')->join('users','stamps.user_userid','=','users.userid')
        ->orderBy('go_time','asc')->get();

            // 勤怠打刻データに'go_date'と'salary'情報を追加
            $week = ['日','月','火','水','木','金','土'];
            foreach($data as $item){
                // 'salary'の追加
                $minute_salary = round($item->hourly_wage/60,5);
                $midnight_minute_salary = round(floor($item->hourly_wage*1.25)/60,5);
                $second_go = strtotime($item->go_time);
                $second_ten = strtotime(date('Y-m-d 22:00:00',strtotime($item->go_time)));
                $second_leave = strtotime($item->leave_time);

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
                $salary = floor($minute_salary*$diff + $midnight_minute_salary*$midnight_diff);
                $item['salary'] = $salary;

                // 'go_date'の追加
                $week_number = date('w',strtotime($item->go_time));
                $item['go_date'] = date('n/j',strtotime($item->go_time)) . '（' . $week[$week_number] . '）';
            }

            // データの成形
            foreach($data as $item){
                $item->go_time = date('H:i',strtotime($item->go_time));
                $item->leave_time = date('H:i',strtotime($item->leave_time));
            }

        // 給与確定できるかどうか
        $second_today = strtotime(date('Y-m-d'));
        $second_to_attendance = strtotime($to_attendance);

        $is_stamps = Stamp::whereBetween('go_time',[session()->get('from_attendance'),$to_attendance])
        ->where('user_userid',session()->get('userid_attendance'))->where('salary_confirmed_status','1')->exists();

        $isnt_stamps = Stamp::whereBetween('go_time',[session()->get('from_attendance'),$to_attendance])
        ->where('user_userid',session()->get('userid_attendance'))->doesntExist();

        $is_stamp = Stamp::whereBetween('go_time',[session()->get('from_attendance'),$to_attendance])
        ->where('user_userid',session()->get('userid_attendance'))->whereNull('leave_time')->exists();

        if($is_stamps){
            // 給与確定ステータス'1'のデータが存在する
            $confirmed = '1';
        }else if($isnt_stamps || $second_today < $second_to_attendance || $is_stamp){
            // 勤怠データがない、締め日を迎えていない、退勤していない
            $confirmed = null;
        }else{
            $confirmed = '0';
        }

        return view ('attendance.index',['data'=>$data,'calendar'=>$calendar,'confirmed'=>$confirmed,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 勤怠を登録するユーザー情報の取得
        $data['userid'] = session()->get('userid_attendance');
        $data['name'] = User::where('userid',session()->get('userid_attendance'))->first()->name;

        // 出勤、退勤のデータ成形
        $data['min_go_time'] = substr_replace(date('Y-m-d H:i',strtotime(session()->get('from_attendance'))),'T',10,1);
        $data['max_go_time'] = substr_replace(date('Y-m-d 23:59:59',strtotime(session()->get('to_attendance'))),'T',10,1);

        // 表示するカレンダーのデータ
        $calendar['month'] = date('n月',strtotime(session()->get('to_attendance')));
        $calendar['year'] = date('Y',strtotime(session()->get('to_attendance')));

        return view ('attendance.register',['data'=>$data,'calendar'=>$calendar]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendanceRegisterRequest $request)
    {
        $stamp = new Stamp;
        $stamp->go_time = $request->format_go_time;
        $stamp->leave_time = $request->format_leave_time;
        $stamp->carfare = $request->carfare;
        $stamp->user_userid = session()->get('userid_attendance');
        $stamp->save();

        return redirect ('/attendance/userid/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($stampid)
    {
        // 対象の勤怠データを取得
        $data = Stamp::where('stampid',$stampid)->join('users','stamps.user_userid','=','users.userid')->first();
        // 出勤データ成形
        $data->go_time = substr_replace(date('Y-m-d H:i',strtotime($data->go_time)),'T',10,1);
        $data['min_go_time'] = substr_replace(date('Y-m-d 00:00',strtotime($data->go_time)),'T',10,1);
        $data['max_go_time'] = substr_replace(date('Y-m-d 23:59:59',strtotime($data->go_time)),'T',10,1);
        // 退勤データ成形
        $data->leave_time = substr_replace(date('Y-m-d H:i',strtotime($data->leave_time)),'T',10,1);

        // 表示するカレンダーのデータ
        $calendar['year'] = date('Y年',strtotime($data->go_time));
        $calendar['month'] = date('n月',strtotime($data->go_time));
        $calendar['date'] = date('j日',strtotime($data->go_time));
        $week = ['日','月','火','水','木','金','土'];
        $calendar['day'] = '（' . $week[date('w',strtotime($data->go_time))] . '）';

        return view ('attendance.change',['calendar'=>$calendar,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttendanceChangeRequest $request, $stampid)
    {
        $stamp = Stamp::where('stampid',$stampid)->first();
        $stamp->go_time = $request->format_go_time;
        $stamp->leave_time = $request->format_leave_time;
        $stamp->carfare = $request->carfare;
        $stamp->save();

        return redirect ('/attendance/userid/' . $stamp->user_userid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($stampid)
    {
        $stamp = Stamp::where('stampid',$stampid)->first();
        $stamp->delete();

        return redirect ('/attendance/userid/' . $stamp->user_userid);
    }
}
