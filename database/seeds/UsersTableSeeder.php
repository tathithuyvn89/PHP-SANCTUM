<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \App\User::create([
            'name'=> 'Ta Thi Thuy',
            'email'=>'thuy@gmail.com',
            'password'=>\Illuminate\Support\Facades\Hash::make('12345678'),

        ]);
    }
}
