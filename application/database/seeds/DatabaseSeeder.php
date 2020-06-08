<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UserSeeder::class);
//        $this->call(ConfigSeeder::class);
//        $this->call(DivisionSeeder::class);
        $this->call(ReservationSeeder::class);
    }
}
