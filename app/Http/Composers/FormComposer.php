<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class FormComposer
{
    public function compose(View $view) {
        $data = [
            ['name'=>'shift.period_select','action'=>'shift.period.select.send'],
            ['name'=>'attendance.period_select','action'=>'attendance.period.select.send'],
            ['name'=>'attendance.change','action'=>'attendance.update'],
            ['name'=>'attendance.register','action'=>'attendance.store'],
            ['name'=>'attendance.payroll_period_select','action'=>'payroll.period.select.send'],
        ];
        foreach($data as $item){
            if($item['name'] == $view->getName()){
                $view->with('form_action',$item['action']);
            }else{
                continue;
            }
        }
    }
}