<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Creation;

class CreateStatusController extends Controller
{
    /**
     * 作成ステータスを0->1にする
     */
    public function create() {
        $creations = Creation::leftJoin('submittals','creations.submittal_submittalid','=','submittals.submittalid')->whereBetween('go_date',[session()->get('from_shift'),session()->get('to_shift')])->get();
        if(!empty($creations)){
            foreach($creations as $creation){
                $creation->creation_status = '1';
                $creation->save();
            }
        }
        return redirect ('shift/create');
    }

    /**
     * 作成ステータスを1->0にする
     */
    public function back() {
        $creations = Creation::leftJoin('submittals','creations.submittal_submittalid','=','submittals.submittalid')->whereBetween('go_date',[session()->get('from_shift'),session()->get('to_shift')])->get();
        if(!empty($creations)){
            foreach($creations as $creation){
                $creation->creation_status = '0';
                $creation->save();
            }
        }
        return redirect ('shift/create');
    }
}
