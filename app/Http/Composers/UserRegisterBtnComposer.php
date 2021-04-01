<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class UserRegisterBtnComposer
{
    public function compose(View $view) {
        $data = [
            ['name'=>'owner.user','url'=>route('owner.user_info_register')],
            ['name'=>'admin.owner','url'=>route('admin.owner_info_register')],
        ];
        foreach($data as $item){
            if($item['name'] == $view->getName()){
                $view->with('register_href',$item['url']);
            }else{
                continue;
            }
        }
    }
}