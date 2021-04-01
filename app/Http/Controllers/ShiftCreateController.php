<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShiftCreateController extends Controller
{
    public function shift() {
        $shift_record = [
            ['name'=>'梶原','go_work'=>'19:00','leave_work'=>'24:00'],
            ['name'=>'梶原','go_work'=>'19:00','leave_work'=>'24:00'],
            ['name'=>'梶原','go_work'=>'19:00','leave_work'=>'24:00'],
        ];
        return view('owner.shift',['shift_record'=>$shift_record]);
    }

    public function shift_period_select() {
        $form_items = ['action'=>route('owner.shift_period_select_send'),'year'=>'2021年','month'=>'3月後半'];
        return view('owner.shift_period_select',['form_items'=>$form_items]);
    }

    public function shift_period_select_send() {
        return redirect('owner/shift_submit_check');
    }

    public function shift_submit_check() {
        $shift_record = [
            ['name'=>'梶原','go_work'=>'19:00','leave_work'=>'24:00'],
            ['name'=>'梶原','go_work'=>'19:00','leave_work'=>'24:00'],
            ['name'=>'梶原','go_work'=>'19:00','leave_work'=>'24:00'],
        ];
        return view('owner.shift_submit_check',['shift_record'=>$shift_record]);
    }

    public function shift_create(Request $request) {
        $shift_select_record = [
            ['name'=>'梶原','go_work'=>'19:00','leave_work'=>'24:00'],
            ['name'=>'梶原','go_work'=>'19:00','leave_work'=>'24:00'],
            ['name'=>'梶原','go_work'=>'19:00','leave_work'=>'24:00'],
        ];
        return view('owner.shift_create',['shift_select_record'=>$shift_select_record]);
    }

    public function shift_create_add() {
        return redirect('owner/shift_create');
    }

}
