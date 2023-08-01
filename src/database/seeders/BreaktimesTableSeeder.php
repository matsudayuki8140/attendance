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
        $start = Carbon::create(2023,7,26,12,0,0);
        $end = Carbon::create(2023,7,26,13,00,0);
        for($worktimeId = 1; $worktimeId <= 50; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = $start->addDay();
        $end = $end->addDay();
        for($worktimeId = 51; $worktimeId <= 100; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = $start->addDay();
        $end = $end->addDay();
        for($worktimeId = 101; $worktimeId <= 150; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = $start->addDay();
        $end = $end->addDay();
        for($worktimeId = 151; $worktimeId <= 200; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = $start->addDay();
        $end = $end->addDay();
        for($worktimeId = 201; $worktimeId <= 250; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = $start->addDay();
        $end = $end->addDay();
        for($worktimeId = 251; $worktimeId <= 300; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = $start->addDay();
        $end = $end->addDay();
        for($worktimeId = 301; $worktimeId <= 350; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = $start->addDay();
        $end = $end->addDay();
        for($worktimeId = 351; $worktimeId <= 400; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = $start->addDay();
        $end = $end->addDay();
        for($worktimeId = 401; $worktimeId <= 450; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }

        $start = $start->addDay();
        $end = $end->addDay();
        for($worktimeId = 451; $worktimeId <= 500; $worktimeId++) {
            $param = [
                'worktime_id' => $worktimeId,
                'start' => $start,
                'end' => $end,
            ];
            DB::table('breaktimes')->insert($param);
        }
    }
}
