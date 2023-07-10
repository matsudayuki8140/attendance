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
        $end = Carbon::create(2021,11,1,12,30,0);
        $param = [
            'worktime_id' => 1,
            'start' => $start,
            'end' => $end,
        ];
        DB::table('breaktimes')->insert($param);

        $start = Carbon::create(2021,11,1,15,0,0);
        $end = NULL;
        $param = [
            'worktime_id' => 1,
            'start' => $start,
            'end' => $end,
        ];
        DB::table('breaktimes')->insert($param);

        $start = Carbon::create(2021,11,1,12,0,0);
        $end = Carbon::create(2021,11,1,12,30,0);
        for($worktimeId = 2; $worktimeId <= 105; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = Carbon::create(2021,10,31,12,0,0);
        $end = Carbon::create(2021,10,31,12,30,0);
        for($worktimeId = 2; $worktimeId <= 105; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = Carbon::create(2021,11,2,12,0,0);
        $end = Carbon::create(2021,11,2,12,30,0);
        for($worktimeId = 1; $worktimeId <= 105; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }
    }
}
