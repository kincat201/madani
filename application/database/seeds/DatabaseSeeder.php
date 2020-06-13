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
        $this->call(UserSeeder::class);
        $this->call(ConfigSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(MachinesSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(MemberSeeder::class);
    }
}
