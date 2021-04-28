<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserChangeRequest;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Gate;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('admin')){
            // 'admin'ユーザー
            $data = User::select('userid','name')->get();
        }else{
            // それ以外のユーザー
            $data = User::where('auth','7')->orwhere('auth','10')->select('userid','name')->get();
        }

        return view ('user.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('user.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        //初期パスワードの発行
        //$length = 8;
        //$init_pass = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
        $init_pass = "password";

        //初期パスワードをメールで送信


        $init_pass = Hash::make($init_pass);

        // カラー
        $color_list = [
            'infigo'=>'#6610f2',
            'purple'=>'#6f42c1',
            'pink'=>'#d63384',
            'orange'=>'#fd7e14',
            'teal'=>'#20c997',
            'gray-dark'=>'#343a40',
            'primary'=>'#0d6efd',
            'secondary'=>'#6c757d',
            'success'=>'#198754',
            'warning'=>'#ffc107',
            'danger'=>'#dc3545',
            'brown'=>'#734e30',
            'gold'=>'#ffd700',
            'silver'=>'#c0c0c0',
        ];

        $users = User::where('auth','7')->get();
        $users_color = [];
        foreach($users as $user){
            $users_color[] = $user->color;
        }
        $color_diff = array_diff($color_list,$users_color);

        //テーブルに保存
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $init_pass;
        $user->hourly_wage = $request->hourly_wage;
        $user->staff_number = $request->staff_number;
        $user->auth = $request->auth;
        if($request->auth == '7'){
            $user->color = reset($color_diff);
        }
        $user->save();

        return redirect ('user');
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
    public function edit($userid)
    {
        $user = User::where('userid',$userid)->first();

        return view ('user.change',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserChangeRequest $request, $userid)
    {
        $user = User::where('userid',$userid)->first();

        if(isset($request->name)){
            $user->name = $request->name;
        }else if(isset($request->hourly_wage)){
            $user->hourly_wage = $request->hourly_wage;
        }else if(isset($request->staff_number)){
            $user->staff_number = $request->staff_number;
        }
        $user->save();

        return redirect ('user/userid/' . $userid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userid)
    {
        User::where('userid',$userid)->delete();

        return redirect ('user');
    }
}
