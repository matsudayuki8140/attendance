<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BreaktimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start = Carbon::create(2021,11,1,12,0,0);
        $end = Carbon::create(2021,11,1,13,0,0);
        $param = [
            'worktime_id' => '1',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('breaktimes')->insert($param);

        $start = Carbon::create(2021,11,1,11,0,0);
        $end = Carbon::create(2021,11,1,12,0,0);
        $param = [
            'worktime_id' => '2',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('breaktimes')->insert($param);

        $start = Carbon::create(2021,11,1,15,0,0);
        $end = Carbon::create(2021,11,1,16,0,0);
        $param = [
            'worktime_id' => '2',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('breaktimes')->insert($param);

        $start = Carbon::create(2021,11,1,17,0,0);
        $end = Carbon::create(2021,11,1,18,0,0);
        $param = [
            'worktime_id' => '2',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('breaktimes')->insert($param);

        $start = Carbon::create(2021,11,1,20,0,0);
        $end = Carbon::create(2021,11,1,21,0,0);
        $param = [
            'worktime_id' => '3',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('breaktimes')->insert($param);

        $start = Carbon::create(2021,11,2,0,30,0);
        $end = Carbon::create(2021,11,2,1,0,0);
        $param = [
            'worktime_id' => '4',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('breaktimes')->insert($param);

        $start = Carbon::create(2023,7,4,22,0,0);
        $param = [
            'worktime_id' => '11',
            'start' => $start,
        ];
        DB::table('breaktimes')->insert($param);
    }
}
