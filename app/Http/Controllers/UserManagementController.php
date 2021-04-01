<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function user() {
        $user_record = [
            ['name'=>'梶原','change'=>route('owner.user_info_change'),'delete'=>route('owner.user_info_delete')],
        ];
        return view('owner.user',['user_record'=>$user_record]);
    }

    public function user_info_delete() {
        return redirect('owner/user');
    }

    public function user_info_change() {
        return view('owner.user_info_change');
    }

    public function user_info_change_send() {
        return redirect('owner/user');
    }

    public function user_info_register() {
        return view('owner.user_info_register');
    }

    public function user_info_register_send() {
        return redirect('owner/user');
    }
}
