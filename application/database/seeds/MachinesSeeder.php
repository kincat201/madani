<?php

use Illuminate\Database\Seeder;

class MachinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('machines')->insert([
            'name'=>'Printer A',
            'description'=>'Buat cetak kertas',
            'status'=> \App\Util\Constant::COMMON_STATUS_AVAILABLE,
        ]);

        DB::table('machines')->insert([
            'name'=>'Printer B',
            'description'=>'Buat cetak baner',
            'status'=> \App\Util\Constant::COMMON_STATUS_AVAILABLE,
        ]);

        DB::table('machines')->insert([
        'name'=>'Printer C',
        'description'=>'Buat cetak grosir',
        'status'=> \App\Util\Constant::COMMON_STATUS_AVAILABLE,
    ]);
    }
}
