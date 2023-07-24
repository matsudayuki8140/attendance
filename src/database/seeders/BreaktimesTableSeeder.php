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
        $end = Carbon::create(2021,11,1,13,00,0);
        for($worktimeId = 1; $worktimeId <= 100; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = Carbon::create(2021,10,31,12,0,0);
        $end = Carbon::create(2021,10,31,13,00,0);
        for($worktimeId = 101; $worktimeId <= 200; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = Carbon::create(2021,11,2,12,0,0);
        $end = Carbon::create(2021,11,2,13,00,0);
        for($worktimeId = 201; $worktimeId <= 300; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }
    }
}
