<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Submittal;
use App\Closing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ShiftSubmitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // データの取得期間の設定
        $latest_closing_date = Closing::latest()->first()->closing_date;
        $check_closing = date('j',strtotime($latest_closing_date));
        if($check_closing == '15'){
            $from = date('Y-m-d',strtotime('+ 1day',strtotime($latest_closing_date)));
            $to = date('Y-m-d',strtotime('last day of this month',strtotime($latest_closing_date)));
        }else{
            $from = date('Y-m-d',strtotime('+ 1day',strtotime($latest_closing_date)));
            $to = date('Y-m-15',strtotime('+ 1day',strtotime($latest_closing_date)));
        }

        // データ取得
        $data = Submittal::where('user_userid',Auth::id())->whereBetween('go_date',[$from,$to])->whereIn('submittal_status',[0,1])->get();

        // 提出済みかどうか
        $is_submittal = Submittal::where('user_userid',Auth::id())->whereBetween('go_date',[$from,$to])->exists();
        $is_submitted = Submittal::where('user_userid',Auth::id())->whereBetween('go_date',[$from,$to])->where('submittal_status','0')->doesntExist();
        $isnt_submitted = Submittal::where('user_userid',Auth::id())->whereBetween('go_date',[$from,$to])->where('submittal_status','1')->doesntExist();
        if($is_submittal && $is_submitted){
            $submitted = '1';
        }else if ($isnt_submitted){
            $submitted = null;
        }else{
            echo'エラー';
            exit;
        }

        // 表示するカレンダーに渡すデータ
        $year = date('Y',strtotime($from));
        $month = date('n',strtotime($from)) - 1;
        $from_date = date('j',strtotime($from));
        $to_date = date('j',strtotime($to));
        $calendar_data = ['year'=>$year,'month'=>$month,'from_date'=>$from_date,'to_date'=>$to_date];

        return view ('shift.submit',['data'=>$data,'submitted'=>$submitted,'calendar_data'=>$calendar_data]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->store_btn == 'store'){
            if(isset($request->submittalid)){
                return redirect ('/shift/submit/update/' . $request->submittalid)->withInput($request->all());
            }else{
                $submittal = new Submittal;
                $submittal->go_date = $request->go_date;
                $submittal->go_time = $request->go_time;
                $submittal->leave_time = $request->leave_time;
                $submittal->user_userid = Auth::id();
                $submittal->save();
            }
    
            return redirect ('shift/submit');
        }else if($request->delete_btn == 'delete'){
            return redirect ('/shift/submit/delete/' . $request->submittalid);
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
    public function update(Request $request, $submittalid)
    {
        $submittal = Submittal::where('submittalid',$submittalid)->first();
        $submittal->go_time = $request->old('go_time');
        $submittal->leave_time = $request->old('leave_time');
        $submittal->save();

        return redirect ('shift/submit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($submittalid)
    {
        $submittal = Submittal::where('submittalid',$submittalid)->first();
        $submittal->delete();

        return redirect ('shift/submit');
    }

}
