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
            'name' => 'kincat only',
            'username' => 'kincat@gmail.com',
            'email' => 'kincat@gmail.com',
            'phone' => '123456',
            'password' => bcrypt('1234'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'role'	=> 'ADMIN',
            'birthDay' => '1995-11-01',
        ]);

        DB::table('users')->insert([
            'name' => 'kincat only',
            'username' => 'kincat1@gmail.com',
            'email' => 'kincat1@gmail.com',
            'phone' => '123456',
            'password' => bcrypt('1234'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'role'  => 'USER',
            'birthDay' => '1995-11-01',
        ]);

        $faker = Faker\Factory::create();

        $users = array();

        for ($i=0; $i < 50; $i++) {
            $data['name'] = $faker->name;
            $data['username'] = $faker->email;
            $data['email'] = $faker->email;
            $data['phone'] = $faker->e164PhoneNumber;
            $data['password'] = bcrypt('1234');
            $data['role'] = 'USER';
            $data['birthDay'] = $faker->date();
            $data['created_at'] = $faker->dateTime();
            $data['updated_at'] = $faker->dateTime();
            array_push($users, $data);
        }

        DB::table('users')->insert($users);


    }
}
