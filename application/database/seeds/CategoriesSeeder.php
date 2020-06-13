<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert([
            'id'=>'1',
            'name'=>'Cetakan Kertas',
            'description'=>'Cetakan kertas Art carton, Hvs, Sticker, Concord',
        ]);

        DB::table('categories')->insert([
            'id'=>'2',
            'name'=>'Cetakan Banner',
            'description'=>'Cetakan banner Flexy, Korcid, Luster, Vynil, Banner, Roll up',
        ]);

        DB::table('categories')->insert([
            'id'=>'3',
            'name'=>'Cetakan Grosir',
            'description'=>'Cetakan grosir Kartu Nama, Kop Surat, Stempel, Nota',
        ]);

    }
}
