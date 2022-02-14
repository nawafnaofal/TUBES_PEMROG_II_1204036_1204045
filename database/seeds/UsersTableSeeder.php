<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Daffa Ulhaq',
            'email' => 'udaffa09gmail.com',
            'password' => Hash::make('daffa123'),
            'alamat' => 'Cianjur',
            'no_hp' => '087770966633',
            'roles' => 'BUYER'
        ]);
    }
}
