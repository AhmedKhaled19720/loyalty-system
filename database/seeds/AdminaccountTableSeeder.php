<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class AdminaccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [

                'name' => 'ahmed',
                'email' => 'ahmed@gmail.com',
                'password' => bcrypt('12345678'),
            ]
        );
    }
}
