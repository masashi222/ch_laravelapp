<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Closing;

class SubmitCloseController extends Controller
{
    public function __invoke() {
        $closing_date = Closing::latest()->first()->closing_date;
        $check_closing = substr($closing_date, -2, 2);
        if( $check_closing == '15'){
            $add_closing_date = date("Y-m-d",strtotime("last day of this month",strtotime($closing_date)));
        }else{
            $add_closing_date = date("Y-m-15",strtotime("+ 1 day",strtotime($closing_date)));
        }
        // 締め切りデータ追加
        $closing = new Closing;
        $closing->closing_date = $add_closing_date;
        $closing->save();

        return redirect ('shift/create');
    }
}
