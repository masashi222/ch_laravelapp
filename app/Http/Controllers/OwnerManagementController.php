<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerManagementController extends Controller
{
    public function owner(){
        $user_record = [
            ['name'=>'本田','change'=>route('admin.owner_info_change'),'delete'=>route('admin.owner_info_delete')],
        ];
        return view('admin.owner',['user_record'=>$user_record]);
    }

    public function owner_info_delete(){
        return redirect('admin/owner');
    }

    public function owner_info_change(){
        return view('admin.owner_info_change');
    }

    public function owner_info_change_send(){
        return redirect('admin/owner');
    }

    public function owner_info_register(){
        return view('admin.owner_info_register');
    }

    public function owner_info_register_send(){
        return redirect('admin/owner');
    }
}
