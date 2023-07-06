<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'tarou' => '太郎',
            'jirou' => '次郎',
            'saburou' => '三郎',
            'sirou' => '四郎',
            'gorou' => '五郎',
            'test' => 'test',
        ];

        foreach($names as $email => $user){
            User::create([
                'name' => $user,
                'email' => $email . '@example.com',
                'password' => bcrypt('password')
            ]);
        }
    }
}
