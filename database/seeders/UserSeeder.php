<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User;
        $user1->username = "admin1";
        $user1->password = Hash::make('admin1', ['rounds' => 10]);
        $user1->role = "admin";
        $user1->save();

        $user2 = new User;
        $user2->username = "admin2";
        $user2->password = Hash::make('admin2', ['rounds' => 10]);
        $user2->role = "admin";
        $user2->save();


        $user3 = new User;
        $user3->username = "admin3";
        $user3->password = Hash::make('admin3', ['rounds' => 10]);
        $user3->role = "admin";
        $user3->save();

    }
}
