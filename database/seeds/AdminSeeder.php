<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin1',
            'email' => 'admin@fazastore.com',
            'password' => Hash::make('admin123'),
            'alamat' => null,
            'no_hp' => null,
            'roles' => 'ADMIN'
        ]);
    }
}
