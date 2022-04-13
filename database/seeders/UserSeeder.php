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
        $user1->username = "Admin Angelic";
        $user1->password = Hash::make('@ngel!c', ['rounds' => 10]);
        $user1->role = "admin";
        $user1->save();

        $user2 = new User;
        $user2->username = "Admin Angelic";
        $user2->password = Hash::make('@ngel!c', ['rounds' => 10]);
        $user2->role = "admin";
        $user2->save();
    }
}
