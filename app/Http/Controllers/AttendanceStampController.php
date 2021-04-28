<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stamp;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\GoWorkRequest;
use App\Http\Requests\LeaveWorkRequest;

class AttendanceStampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stamp = Stamp::where('user_userid',Auth::id())->latest()->first();
        if(isset($stamp->leave_time) || empty($stamp)){
            // 最新レコードがないまたは、最新レコードのleave_timeがnullでない場合
            $gone = null;
            return view ('attendance.stamp',['gone'=>$gone]);
        }else{
            // 最新レコードがあって、leave_timeがnull
            return redirect ('/stamp/show');
        }
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
    public function store(GoWorkRequest $request)
    {
            // レコード追加
            $go_time = date('Y-m-d H:i:s');
            $stamp = new Stamp;
            $stamp->go_time = $go_time;
            if(isset($request->cafare)){
                $stamp->carfare = $request->carfare;
            }
            $stamp->user_userid = Auth::id();
            $stamp->save();

            return redirect ('/stamp/show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $stamp = Stamp::where('user_userid',Auth::id())->latest()->first();
        if(isset($stamp) && empty($stamp->leave_time)){
            // 退勤前であることを示す
            $gone = '1'; 
            // 出勤時に入力した交通費
            $carfare = $stamp->carfare;
        }else{
            echo 'エラー';
            exit;
        }

        return view ('attendance.stamp',['gone'=>$gone,'carfare'=>$carfare]);
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
    public function update(LeaveWorkRequest $request)
    {
        $leave_time = date('Y-m-d H:i:s');
        $stamp = Stamp::where('user_userid',Auth::id())->latest()->first();
        $stamp->leave_time = $leave_time;
        if(isset($request->cafare)){
            $stamp->carfare = $request->carfare;
        }
        $stamp->save();

        return redirect ('/stamp');
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
