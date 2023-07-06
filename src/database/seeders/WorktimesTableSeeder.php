<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WorktimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start = Carbon::create(2021,11,1,10,0,0);
        $end = Carbon::create(2021,11,1,20,0,0);
        $param = [
            'user_id' => '1',
            'date' => '2021-11-01',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('worktimes')->insert($param);

        $start = Carbon::create(2021,11,1,10,0,10);
        $end = Carbon::create(2021,11,1,20,0,0);
        $param = [
            'user_id' => '2',
            'date' => '2021-11-01',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('worktimes')->insert($param);

        $start = Carbon::create(2021,11,1,15,0,0);
        $end = Carbon::create(2021,11,2,0,0,0);
        $param = [
            'user_id' => '3',
            'date' => '2021-11-01',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('worktimes')->insert($param);

        $start = Carbon::create(2021,11,2,0,0,0);
        $end = Carbon::create(2021,11,2,2,0,0);
        $param = [
            'user_id' => '3',
            'date' => '2021-11-02',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('worktimes')->insert($param);

        $start = Carbon::create(2021,11,2,10,0,0);
        $end = Carbon::create(2021,11,2,20,0,0);
        $param = [
            'user_id' => '1',
            'date' => '2021-11-02',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('worktimes')->insert($param);

        $start = Carbon::create(2021,11,2,17,0,0);
        $end = Carbon::create(2021,11,3,0,0,0);
        $param = [
            'user_id' => '2',
            'date' => '2021-11-02',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('worktimes')->insert($param);

        $start = Carbon::create(2021,11,2,10,0,0);
        $end = Carbon::create(2021,11,2,20,0,0);
        $param = [
            'user_id' => '3',
            'date' => '2021-11-02',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('worktimes')->insert($param);

        $start = Carbon::create(2021,11,3,0,0,0);
        $end = Carbon::create(2021,11,3,1,0,0);
        $param = [
            'user_id' => '2',
            'date' => '2021-11-03',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('worktimes')->insert($param);

        $start = Carbon::create(2021,11,3,10,0,0);
        $end = Carbon::create(2021,11,3,20,0,0);
        $param = [
            'user_id' => '1',
            'date' => '2021-11-03',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('worktimes')->insert($param);

        $start = Carbon::create(2021,11,3,10,0,0);
        $end = Carbon::create(2021,11,3,20,0,0);
        $param = [
            'user_id' => '3',
            'date' => '2021-11-03',
            'start' => $start,
            'end' => $end,
        ];
        DB::table('worktimes')->insert($param);

        $start = Carbon::create(2023,7,4,10,0,0);
        $param = [
            'user_id' => '5',
            'date' => '2023-07-04',
            'start' => $start,
        ];
        DB::table('worktimes')->insert($param);
    }
}
