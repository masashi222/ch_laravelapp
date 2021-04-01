<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class SetForBackBtnComposer
{
    public function compose(View $view) {
        $data = [
            ['name'=>'owner.shift','url'=>route('owner.top')],
            ['name'=>'owner.shift_period_select','url'=>route('owner.top')],
            ['name'=>'owner.shift_submit_check','url'=>route('owner.shift_period_select')],
            ['name'=>'owner.shift_create','url'=>route('owner.shift_submit_check')],
            ['name'=>'owner.attendance_period_select','url'=>route('owner.top')],
            ['name'=>'owner.attendance_staff_select','url'=>route('owner.attendance_period_select')],
            ['name'=>'owner.attendance_info','url'=>route('owner.attendance_staff_select')],
            ['name'=>'owner.attendance_info_change','url'=>route('owner.attendance_info')],
            ['name'=>'owner.attendance_info_register','url'=>route('owner.attendance_info')],
            ['name'=>'owner.payroll_period_select','url'=>route('owner.top')],
            ['name'=>'owner.payroll','url'=>route('owner.payroll_period_select')],
            ['name'=>'owner.stamp_key','url'=>route('owner.top')],
            ['name'=>'owner.user','url'=>route('owner.top')],
            ['name'=>'owner.user_info_change','url'=>route('owner.user')],
            ['name'=>'owner.user_info_register','url'=>route('owner.user')],
            ['name'=>'staff.shift_submit','url'=>route('staff.top')],
            ['name'=>'staff.attendance_info','url'=>route('staff.top')],
            ['name'=>'staff.stamp','url'=>route('staff.top')],
            ['name'=>'admin.owner','url'=>route('admin.top')],
            ['name'=>'admin.owner_info_change','url'=>route('admin.owner')],
            ['name'=>'admin.owner_info_register','url'=>route('admin.owner')],
        ];
        foreach($data as $item){
            if($item['name'] == $view->getName()){
                $view->with('data_url',$item['url']);
            }else{
                continue;
            }
        }
    }
}