<?php

namespace App\Http\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class SetForBackBtnComposer
{
    public function compose(View $view) {
        if(Gate::allows('accountant-higher')){
            $data[] = ['name'=>'login.account','url'=>route('top')];
        }
        if(Gate::allows('staff') || Gate::allows('admin')){
            // スタッフ権限
            $data[] = ['name'=>'shift.submit','url'=>route('top')];
            $data[] = ['name'=>'attendance.index','url'=>route('attendance.period.select')];
            $data[] = ['name'=>'attendance.stamp','url'=>route('top')];
        }
        if(Gate::allows('staff-higher')){
            // スタッフ権限以上
            $data[] = ['name'=>'shift.index','url'=>route('top')];
            $data[] = ['name'=>'attendance.period_select','url'=>route('top')];
        }
        if(Gate::allows('owner-higher')){
            // オーナー権限以上
            $data[] = ['name'=>'shift.period_select','url'=>route('top')];
            $data[] = ['name'=>'shift.submit_status','url'=>route('shift.period.select')];
            $data[] = ['name'=>'shift.create','url'=>route('shift.submit.status')];
            $data[] = ['name'=>'attendance.staff_select','url'=>route('attendance.period.select')];
            $data[] = ['name'=>'attendance.index','url'=>route('attendance.staff.select')];
            $data[] = ['name'=>'attendance.change','url'=>route('attendance.index')];
            $data[] = ['name'=>'attendance.register','url'=>route('attendance.index')];
            $data[] = ['name'=>'attendance.stamp_key','url'=>route('top')];
            $data[] = ['name'=>'user.index','url'=>route('top')];
            $data[] = ['name'=>'user.change','url'=>route('user')];
            $data[] = ['name'=>'user.register','url'=>route('user')];
        }
        if(Gate::allows('owner-higher') || Gate::allows('accountant')){
            // オーナー権限以上と税理士権限
            $data[] = ['name'=>'attendance.payroll_period_select','url'=>route('top')];
            $data[] = ['name'=>'attendance.payroll','url'=>route('payroll.period.select')];
        }

        if(isset($data)){
            foreach($data as $item){
                if($item['name'] == $view->getName()){
                    $view->with('href',$item['url']);
                }else{
                    continue;
                }
            }
        }
    }
}