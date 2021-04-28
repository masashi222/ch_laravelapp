<?php

use App\Submittal;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SubmittalsTableSeeder extends Seeder
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
                    $go_dates = ['2021-04-15','2021-04-30','2021-05-15'];
                    foreach($go_dates as $go_date){
                        $value = [
                            'go_date' => $go_date,
                            'go_time' => null,
                            'leave_time' => null,
                            'submittal_status' => '2',
                            'user_userid' => $userid,
                        ];
                        $dummyData[] = $value;
                    }
                    for($i = 0; $i < 7; $i++){
                        $value = [
                            'go_date' => $faker->dateTimeBetween($startDate = '2021-05-15', $endDate='2021-05-31')->format('Y-m-d'),
                            'go_time' => $faker->randomElement($array = array ('17:00:00','17:30:00','18:00:00','18:30:00','19:00:00','19:30:00')),
                            'leave_time' => $faker->randomElement($array = array ('22:00:00','22:30:00','23:00:00','23:30:00','24:00:00','29:00:00')),
                            'submittal_status' => '0',
                            'user_userid' => $userid,
                        ];
                        if( !in_array($value['go_date'],$tmp) ){
                            $tmp[] = $value['go_date'];
                            $dummyData[] = $value;
                        }
                    }
            }else{
                for($i = 0; $i < 28; $i++){
                    $value = [
                        'go_date' => $faker->dateTimeBetween($startDate = '2021-04-01', $endDate='2021-05-31')->format('Y-m-d'),
                        'go_time' => $faker->randomElement($array = array ('17:00:00','17:30:00','18:00:00','18:30:00','19:00:00','19:30:00')),
                        'leave_time' => $faker->randomElement($array = array ('22:00:00','22:30:00','23:00:00','23:30:00','24:00:00','29:00:00')),
                        'submittal_status' => '1',
                        'user_userid' => $userid,
                    ];
                    if( !in_array($value['go_date'],$tmp) ){
                        $tmp[] = $value['go_date'];
                        $dummyData[] = $value;
                    }
                }
            }
            
        }
        foreach($dummyData as $dummyItem){
            $submittal = new Submittal;
            $submittal->go_date = $dummyItem['go_date'];
            $submittal->go_time = $dummyItem['go_time'];
            $submittal->leave_time = $dummyItem['leave_time'];
            $submittal->submittal_status = $dummyItem['submittal_status'];
            $submittal->user_userid = $dummyItem['user_userid'];
            $submittal->save();

        }
    }
}
