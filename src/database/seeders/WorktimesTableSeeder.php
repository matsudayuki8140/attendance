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
        for($userId = 1; $userId <= 105; $userId++) {
            $param = [
                'user_id' => $userId,
                'date' => $start->toDateString(),
                'start' => $start,
                'end' => $end,
            ];
            DB::table('worktimes')->insert($param);
        }
    }
}
