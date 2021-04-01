<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceStampController extends Controller
{
    public function attendance_info(){
        $attendance_record = [];
        return view('staff.attendance_info',['attendance_record'=>$attendance_record]);
    }

    public function stamp(){
        return view('staff.stamp');
    }
}
