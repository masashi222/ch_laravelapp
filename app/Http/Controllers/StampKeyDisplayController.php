<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Key;

class StampKeyDisplayController extends Controller
{    
    public function index()
    {
        $key = Key::where('today_date',date('Y-m-d'))->first();
        $week = ['日','月','火','水','木','金','土'];
        $week_number = date('w');
        $today_date = date('Y年n月j日') . '（' . $week[$week_number] . '）';
        $data['today_date'] = $today_date;
        
        if(isset($key)){
            $data['key'] = $key->key;
        }else{
            $data['key'] = null;
        }

        return view ('attendance.stamp_key',['data'=>$data]);
    }

    public function update()
    {
        // 本日の日付の取得
        $today_date = date('Y-m-d');
        // 打刻キーの生成
        $length = 4;
        $max = pow(10, $length) - 1;
        $rand = random_int(0, $max);
        $code = sprintf('%0'. $length. 'd', $rand);

        $key = Key::first();
        $key->today_date = $today_date;
        $key->key = $code;
        $key->save();

        return redirect ('/stamp/key');
    }
}
