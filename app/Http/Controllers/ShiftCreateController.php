<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submittal;
use App\User;
use App\Creation;
use Illuminate\Support\Facades\DB;

class ShiftCreateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 提出者データとシフト作成テーブルデータの取得
        $shift_data = Submittal::leftJoin('creations','submittals.submittalid','=','creations.submittal_submittalid')
        ->join('users','submittals.user_userid','=','users.userid')
        ->where('submittal_status','1')->whereBetween('go_date',[session()->get('from_shift'),session()->get('to_shift')])->where('auth','7')
        ->select('submittalid','go_date','submittals.go_time','submittals.leave_time','user_userid',
        'creationid','creations.go_time as creation.go_time','creations.leave_time as creation.leave_time','submittal_submittalid',
        'userid','name','color')
        ->get();
        foreach($shift_data as $shift_item){
            $shift_item['split_go_time'] = $shift_item->split_go_time;
            $shift_item['split_leave_time'] = $shift_item->split_leave_time;
        }

        // 提出済みかどうか
        $is_creation = Submittal::join('creations','submittals.submittalid','=','creations.submittal_submittalid')
        ->where('submittal_status','1')->whereBetween('go_date',[session()->get('from_shift'),session()->get('to_shift')])
        ->select('creationid')
        ->exists();
        $is_created = Submittal::join('creations','submittals.submittalid','=','creations.submittal_submittalid')
        ->where('submittal_status','1')->whereBetween('go_date',[session()->get('from_shift'),session()->get('to_shift')])
        ->where('creation_status','0')
        ->doesntExist();
        $isnt_created = Submittal::join('creations','submittals.submittalid','=','creations.submittal_submittalid')
        ->where('submittal_status','1')->whereBetween('go_date',[session()->get('from_shift'),session()->get('to_shift')])
        ->where('creation_status','1')
        ->doesntExist();

        if($is_creation && $is_created){
            $created = '1';
        }else if ($is_creation && $isnt_created){
            $created = '0';
        }else if(!$is_creation){
            $created = null;
        }

        // 表示するカレンダーに渡すデータ
        $year = date('Y',strtotime(session()->get('from_shift')));
        $month = date('n',strtotime(session()->get('from_shift'))) - 1;
        $from_date = date('j',strtotime(session()->get('from_shift')));
        $to_date = date('j',strtotime(session()->get('to_shift')));
        $calendar_data = ['year'=>$year,'month'=>$month,'from_date'=>$from_date,'to_date'=>$to_date];

        // ユーザー情報の取得
        $users = User::where('auth','7')->get();

        return view ('shift.create',['shift_data'=>$shift_data,'calendar_data'=>$calendar_data,'users'=>$users,'created'=>$created]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * シフト提出テーブルにデータ保存
     */
    public function add(Request $request){
        if(!empty($request->old('staff_select'))){
            $submittal = new Submittal;
            $submittal->go_date = $request->old('go_date');
            $submittal->go_time = ($request->old('go_time'))['add'];
            $submittal->leave_time = ($request->old('leave_time'))['add'];
            $submittal->submittal_status = '1';
            $submittal->user_userid = $request->old('staff_select');
            $submittal->save();
        }

        return redirect ('shift/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->store_btn == 'store'){
            // 保存の時の処理
            if(isset($request->registation_status)){
                $registation_ids = array_keys($request->registation_status);
                foreach($request->submittalsid as $submittalid){
                    $is_creation = Creation::where('submittal_submittalid',$submittalid)->exists();
                    if($is_creation && in_array($submittalid,$registation_ids)){
                        // レコードが存在するかつ、登録
                        $creation = Creation::where('submittal_submittalid',$submittalid)->first();
                        $creation->go_time = ($request->go_time)[$submittalid];
                        $creation->leave_time = ($request->leave_time)[$submittalid];
                        $creation->save();
                    }else if($is_creation){
                        // レコードが存在するかつ、未登録
                        $creation = Creation::where('submittal_submittalid',$submittalid)->first();
                        $creation->delete();
                    }else if(in_array($submittalid,$registation_ids)){
                        // レコードが存在しないかつ、登録
                        $creation = new Creation;
                        $creation->go_time = ($request->go_time)[$submittalid];
                        $creation->leave_time = ($request->leave_time)[$submittalid];
                        $creation->submittal_submittalid = $submittalid;
                        $creation->save();
                    }else{
                        continue;
                    }                    
                }   
            }else{
                foreach($request->submittalsid as $submittalid){
                    // レコードが存在するかつ
                    $is_creation = Creation::where('submittal_submittalid',$submittalid)->exists();
                    if($is_creation){
                        $creation = Creation::where('submittal_submittalid',$submittalid)->first();
                        $creation->delete();     
                    }else{
                        continue;
                    }
                }   
            }
            return redirect ('shift/create');
        }else if($request->add_btn == 'add'){
            // 追加の時の処理
            return redirect ('shift/add')->withInput($request->all());
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
