<?php

use Illuminate\Database\Seeder;
use App\City;
use App\Kecamatan;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'kincat admin',
            'username' => 'kincat',
            'email' => 'kincat@gmail.com',
            'role'	=> \App\Util\Constant::USER_ROLE_ADMIN,
            'phone' => '123456',
            'password' => bcrypt('1234'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'kincat cashier',
            'username' => 'kincat1',
            'email' => 'kincat1@gmail.com',
            'role'  => \App\Util\Constant::USER_ROLE_CASHIER,
            'phone' => '123456',
            'password' => bcrypt('1234'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'kincat designer',
            'username' => 'kincat2',
            'email' => 'kincat2@gmail.com',
            'role'  => \App\Util\Constant::USER_ROLE_DESIGNER,
            'phone' => '123456',
            'password' => bcrypt('1234'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'kincat engineer',
            'username' => 'kincat3',
            'email' => 'kincat3@gmail.com',
            'role'  => \App\Util\Constant::USER_ROLE_ENGINEER,
            'phone' => '123456',
            'password' => bcrypt('1234'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
