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
        $start = Carbon::create(2023,7,26,10,0,0);
        $end = Carbon::create(2023,7,26,20,0,0);

        for ($number = 1; $number <= 20; $number++) {
            for ($userId = 1; $userId <= 50; $userId++) {
                $param = [
                    'user_id' => $userId,
                    'date' => $start->toDateString(),
                    'start' => $start,
                    'end' => $end,
                ];
                DB::table('worktimes')->insert($param);
            }
            $start = $start->addDay();
            $end = $end->addDay();
        }
    }
}
