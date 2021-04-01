<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceManagementController extends Controller
{
    public function attendance_period_select() {
        $form_items = ['action'=>route('owner.attendance_period_select_send'),'year'=>'2021年','month'=>'2/3月'];
        return view('owner.attendance_period_select',['form_items'=>$form_items]);
    }

    public function attendance_period_select_send(){
        return redirect('owner/attendance_staff_select');
    }

    public function attendance_staff_select() {
        $staff_records = [
            ['name'=>'梶原','status'=>'1'],
            ['name'=>'瀬良垣','status'=>'0'],
            ['name'=>'阿久刀川','status'=>''],
        ];
        return view('owner.attendance_staff_select',['staff_records'=>$staff_records]);
    }

    public function attendance_info() {
        $attendance_record = [
            ['date'=>'2月21日（水）','go_work'=>'17:23','leave_work'=>'24:25','carfare'=>'320','salary'=>'5,496'],
            ['date'=>'2月23日（金）','go_work'=>'17:27','leave_work'=>'23:57','carfare'=>'320','salary'=>'14,297'],
        ];
        return view('owner.attendance_info',['attendance_record'=>$attendance_record]);
    }

    public function attendance_info_delete() {
        return redirect('owner/attendance_info');
    }

    public function salary_confirm() {
        return redirect('owner/attendance_staff_select');
    }

    public function attendance_info_change() {
        $form_items = [
            'action'=>route('owner.attendance_info_change_send'),
        ];
        return view('owner.attendance_info_change',['form_items'=>$form_items]);
    }

    public function attendance_info_change_send() {
        return redirect('owner/attendance_info');
    }

    public function attendance_info_register() {
        $form_items = [
            'action'=>route('owner.attendance_info_register_send'),
        ];
        return view('owner.attendance_info_register',['form_items'=>$form_items]);
    }

    public function attendance_info_register_send() {
        return redirect('owner/attendance_info');
    }

    public function payroll_period_select() {
        $form_items = ['action'=>route('owner.payroll_period_select_send'),'year'=>'2021年','month'=>'2/3月'];
        return view('owner.payroll_period_select',['form_items'=>$form_items]);
    }

    public function payroll_period_select_send() {
        return redirect('owner/payroll');
    }

    public function payroll() {
        $payroll_data = [
            ['no'=>'1','name'=>'梶原将志','normal_time'=>'12:29','midnight_time'=>'23:27','normal_salary'=>'45,478','midnight_salary'=>'44,478',
                'salary'=>'98,578','days'=>'18','total_carfare'=>'2,000','carfare'=>'1,400','total_salary'=>'100,467'],
            ['no'=>'1','name'=>'梶原将志','normal_time'=>'12:29','midnight_time'=>'23:27','normal_salary'=>'45,478','midnight_salary'=>'44,478',
                'salary'=>'98,578','days'=>'18','total_carfare'=>'2,000','carfare'=>'1,400','total_salary'=>'100,467'],
        ];
        return view('owner.payroll',['payroll_data'=>$payroll_data]);
    }

    public function stamp_key() {
        $stamp_key = null;
        return view('owner.stamp_key',['stamp_key'=>$stamp_key]);
    }
}
