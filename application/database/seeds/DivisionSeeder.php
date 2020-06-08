<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = [
            'DIVISI AKUNTING',
            'DIVISI AR PENAGIHAN',
            'DIVISI FINANCE',
            'DIVISI FINANCE PENCAIRAN',
            'DIVISI IT',
            'DIVISI KEANGGOTAAN',
            'DIVISI KESRA',
            'DIVISI MARKETING',
            'DIVISI PINJAMAN',
            'DIVISI SIMPAN',
        ];

        $datas = array();

        for ($i=0; $i < count($divisions); $i++) {
            $data['name'] = $divisions[$i];
            $data['status'] = \App\Util\Constant::COMMON_STATUS_ACTIVE;
            array_push($datas, $data);
        }

        DB::table('division')->insert($datas);
    }
}
