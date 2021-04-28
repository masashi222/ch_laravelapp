<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_data = [
            ['userid'=>'1','name'=>'鈴木一郎','email'=>'iciro@mail','password'=>'$2y$10$zV8ILNjB/1lpVkkd1tadRuHh5t73YZi6OuOFWr088ggAS7PTjsLBW',
                'hourly_wage'=>null,'staff_number'=>null,'auth'=>'1','color'=>'#0dcaf0'],
            ['userid'=>'2','name'=>'山田太郎','email'=>'taro@mail','password'=>'$2y$10$zV8ILNjB/1lpVkkd1tadRuHh5t73YZi6OuOFWr088ggAS7PTjsLBW',
                'hourly_wage'=>null,'staff_number'=>null,'auth'=>'4','color'=>'#0dcaf0'],
            ['userid'=>'3','name'=>'田中花子','email'=>'hanko@mail','password'=>'$2y$10$zV8ILNjB/1lpVkkd1tadRuHh5t73YZi6OuOFWr088ggAS7PTjsLBW',
                'hourly_wage'=>'900','staff_number'=>'1','auth'=>'7','color'=>'#d63384'],
            ['userid'=>'4','name'=>'松本人志','email'=>'hitoshi@mail','password'=>'$2y$10$zV8ILNjB/1lpVkkd1tadRuHh5t73YZi6OuOFWr088ggAS7PTjsLBW',
                'hourly_wage'=>'850','staff_number'=>'2','auth'=>'7','color'=>'#dc3545'],
            ['userid'=>'5','name'=>'磯野カツオ','email'=>'katsuo@mail','password'=>'$2y$10$zV8ILNjB/1lpVkkd1tadRuHh5t73YZi6OuOFWr088ggAS7PTjsLBW',
                'hourly_wage'=>'850','staff_number'=>'3','auth'=>'7','color'=>'#fd7e14'],
            ['userid'=>'6','name'=>'本田圭佑','email'=>'keisuke@mail','password'=>'$2y$10$zV8ILNjB/1lpVkkd1tadRuHh5t73YZi6OuOFWr088ggAS7PTjsLBW',
                'hourly_wage'=>'1000','staff_number'=>'4','auth'=>'7','color'=>'#ffc107'],
            ['userid'=>'7','name'=>'習近平','email'=>'china@mail','password'=>'$2y$10$zV8ILNjB/1lpVkkd1tadRuHh5t73YZi6OuOFWr088ggAS7PTjsLBW',
                'hourly_wage'=>'900','staff_number'=>'5','auth'=>'7','color'=>'#198754'],
            ['userid'=>'8','name'=>'川本次郎','email'=>'joro@mail','password'=>'$2y$10$zV8ILNjB/1lpVkkd1tadRuHh5t73YZi6OuOFWr088ggAS7PTjsLBW',
                'hourly_wage'=>null,'staff_number'=>null,'auth'=>'10','color'=>'#0dcaf0'],
        ];
        foreach( $users_data as $user_data){
            $user = new User;
            $user->name = $user_data['name'];
            $user->email = $user_data['email'];
            // password='password'
            $user->password = $user_data['password'];
            $user->hourly_wage = $user_data['hourly_wage'];
            $user->staff_number = $user_data['staff_number'];
            $user->auth = $user_data['auth'];
            $user->color = $user_data['color'];
            $user->save();
        }
    }
}
