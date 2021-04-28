<?php

use Illuminate\Database\Seeder;
use App\Closing;

class ClosingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $closings_data = [
                    ['closing_date'=>'2021-04-15'],
                    ['closing_date'=>'2021-04-30'],
                    ['closing_date'=>'2021-05-15'],
        ];
        foreach( $closings_data as $closing_data){
            $closing = new Closing;
            $closing->closing_date = $closing_data['closing_date'];
            $closing->save();
        }
    }
}
