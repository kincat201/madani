<?php

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            'id'=>'1',
            'name'=>'A3',
            'description'=>'Satu Lembar',
        ]);

        DB::table('units')->insert([
            'id'=>'2',
            'name'=>'A4',
            'description'=>'Satu Lembar',
        ]);

        DB::table('units')->insert([
            'id'=>'3',
            'name'=>'meter',
            'description'=>'Per meter',
        ]);

        DB::table('units')->insert([
            'id'=>'4',
            'name'=>'pcs',
            'description'=>'Per Satuan',
        ]);

        DB::table('units')->insert([
            'id'=>'5',
            'name'=>'set',
            'description'=>'Per Set',
        ]);

        DB::table('units')->insert([
            'id'=>'6',
            'name'=>'1 Box',
            'description'=>'Isi 100',
        ]);

        DB::table('units')->insert([
            'id'=>'7',
            'name'=>'1 Rim',
            'description'=>'Per Rim',
        ]);

        DB::table('units')->insert([
            'id'=>'8',
            'name'=>'1 Warna',
            'description'=>'Satu Warna',
        ]);

        DB::table('units')->insert([
            'id'=>'9',
            'name'=>'2 Warna',
            'description'=>'Dua Warna',
        ]);

        DB::table('units')->insert([
            'id'=>'10',
            'name'=>'3 Warna',
            'description'=>'Tiga Warna',
        ]);

        DB::table('units')->insert([
            'id'=>'11',
            'name'=>'HVS F4',
            'description'=>'HVS F4 1 rim',
        ]);

        DB::table('units')->insert([
            'id'=>'12',
            'name'=>'NCR F4',
            'description'=>'NCR uk F4 60gr',
        ]);

    }
}
