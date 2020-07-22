<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        \App\User::truncate();

        $data = new \App\User;
        $data->name = "Muhammad Fahrul";
        $data->email = "fahrul@gmail.com";
        $data->password = Hash::make("fahrul");

        $data->save();
    }
}
