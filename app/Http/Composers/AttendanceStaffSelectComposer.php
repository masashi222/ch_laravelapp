<?php
namespace App\Http\Composers;

use Illuminate\View\View;

class AttendanceStaffSelectComposer
{
    public function compose(View $view) {
        foreach($view->staff_records as $staff_record){
            switch($staff_record['status']){
                case '-1':
                    $staff_record['status'] = "<i class=\"fas fa-exclamation-circle text-danger\"></i>";
                    break;
                case '0':
                    $staff_record['status'] = "<i class=\"fas fa-minus-circle text-success\"></i>";
                    break;
                case '1':
                    $staff_record['status'] = "<i class=\"fas fa-check-circle text-primary\"></i>";
                    break;
                default:
                    $staff_record['status'] = "<i class=\"fas fa-minus-circle text-secondary\"></i>";
            }
            $staff_records[] = [
                'name'=>$staff_record['name'],
                'status'=>$staff_record['status'],
            ];
        }
        $view->with('staff_records',$staff_records);
    }
}