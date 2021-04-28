<?php

use Illuminate\Database\Seeder;
use App\Key;

class KeysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 本日の日付の取得
        $today_date = date('Y-m-d');
        // 打刻キーの生成
        $length = 4;
        $max = pow(10, $length) - 1;
        $rand = random_int(0, $max);
        $code = sprintf('%0'. $length. 'd', $rand);

        $key = new Key;
        $key->today_date = $today_date;
        $key->key = $code;
        $key->save();
    }
}
