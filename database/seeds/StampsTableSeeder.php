<?php

use App\Stamp;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class StampsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $userids = ['3','4','5','6','7'];
        $dummyData = [];
        foreach($userids as $userid){
            $tmp = [];
            if($userid == '7'){
                for($i = 0; $i < 10; $i++){
                    $go_date = $faker->dateTimeBetween($startDate = '2021-03-01', $endDate='2021-03-15')->format('Y-m-d');
                    $value = [
                        'go_time' => $go_date . ' ' . $faker->dateTimeBetween($startDate = '2021-03-01 17:00:00', $endDate='2021-03-01 19:30:00')->format('H:i:s'),
                        'leave_time' => $go_date . ' ' . $faker->dateTimeBetween($startDate = '2021-03-01 22:00:00', $endDate='2021-03-01 23:59:59')->format('H:i:s'),
                        'carfare' => '320',
                        'user_userid' => $userid,
                        'salary_confirmed_status' => '1'
                    ];
                    if( !in_array($go_date,$tmp) ){
                        $tmp[] = $go_date;
                        $dummyData[] = $value;
                    }
                }
            }else{
                // 'salary_confirmed_status'が1
                for($i = 0; $i < 20; $i++){
                    $go_date = $faker->dateTimeBetween($startDate = '2021-03-01', $endDate='2021-04-20')->format('Y-m-d');
                    $value = [
                        'go_time' => $go_date . ' ' . $faker->dateTimeBetween($startDate = '2021-03-01 17:00:00', $endDate='2021-03-01 19:30:00')->format('H:i:s'),
                        'leave_time' => $go_date . ' ' . $faker->dateTimeBetween($startDate = '2021-03-01 22:00:00', $endDate='2021-03-01 23:59:59')->format('H:i:s'),
                        'carfare' => $faker->randomElement($array = array('0','100','320')),
                        'user_userid' => $userid,
                        'salary_confirmed_status' => '1'
                    ];
                    if( !in_array($go_date,$tmp) ){
                        $tmp[] = $go_date;
                        $dummyData[] = $value;
                    }
                }
                for($j = 0; $j < 20; $j++){
                    $go_date = $faker->dateTimeBetween($startDate = '2021-03-01', $endDate='2021-04-20')->format('Y-m-d');
                    $leave_date = date('Y-m-d',strtotime('+ 1day',strtotime($go_date)));
                    $value = [
                        'go_time' => $go_date . ' ' . $faker->dateTimeBetween($startDate = '2021-03-01 17:00:00', $endDate='2021-03-01 19:30:00')->format('H:i:s'),
                        'leave_time' => $leave_date . ' ' . $faker->dateTimeBetween($startDate = '2021-03-01 00:00:00', $endDate='2021-03-01 02:00:00')->format('H:i:s'),
                        'carfare' => $faker->randomElement($array = array('0','100','320')),
                        'user_userid' => $userid,
                        'salary_confirmed_status' => '1'
                    ];
                    if( !in_array($go_date,$tmp) ){
                        $tmp[] = $go_date;
                        $dummyData[] = $value;
                    }
                }
                // 'salary_confirmed_status'が0
                for($k = 0; $k < 5; $k++){
                    $go_date = $faker->dateTimeBetween($startDate = '2021-04-21', $endDate='2021-04-27')->format('Y-m-d');
                    $value = [
                        'go_time' => $go_date . ' ' . $faker->dateTimeBetween($startDate = '2021-03-01 17:00:00', $endDate='2021-03-01 19:30:00')->format('H:i:s'),
                        'leave_time' => $go_date . ' ' . $faker->dateTimeBetween($startDate = '2021-03-01 22:00:00', $endDate='2021-03-01 23:59:59')->format('H:i:s'),
                        'carfare' => $faker->randomElement($array = array('0','100','320')),
                        'user_userid' => $userid,
                        'salary_confirmed_status' => '0'
                    ];
                    if( !in_array($go_date,$tmp) ){
                        $tmp[] = $go_date;
                        $dummyData[] = $value;
                    }
                }
                for($l = 0; $l < 5; $l++){
                    $go_date = $faker->dateTimeBetween($startDate = '2021-04-21', $endDate='2021-04-27')->format('Y-m-d');
                    $leave_date = date('Y-m-d',strtotime('+ 1day',strtotime($go_date)));
                    $value = [
                        'go_time' => $go_date . ' ' . $faker->dateTimeBetween($startDate = '2021-03-01 17:00:00', $endDate='2021-03-01 19:30:00')->format('H:i:s'),
                        'leave_time' => $leave_date . ' ' . $faker->dateTimeBetween($startDate = '2021-03-01 00:00:00', $endDate='2021-03-01 02:00:00')->format('H:i:s'),
                        'carfare' => $faker->randomElement($array = array('0','100','320')),
                        'user_userid' => $userid,
                        'salary_confirmed_status' => '0'
                    ];
                    if( !in_array($go_date,$tmp) ){
                        $tmp[] = $go_date;
                        $dummyData[] = $value;
                    }
                }
            }
        }
        foreach($dummyData as $dummyItem){
            $stamp = new Stamp;
            $stamp->go_time = $dummyItem['go_time'];
            $stamp->leave_time = $dummyItem['leave_time'];
            $stamp->carfare = $dummyItem['carfare'];
            $stamp->user_userid = $dummyItem['user_userid'];
            $stamp->salary_confirmed_status = $dummyItem['salary_confirmed_status'];
            $stamp->save();
        }
    }
}
