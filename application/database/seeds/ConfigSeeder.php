<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config')->insert([
            'title' => 'Reservasi Ruangan',
            'logo' => 'config/logo.png',
            'logoSecond' => 'config/logo-back.png',
            'icon' => 'config/favicon.ico',
            'email' => 'teman@koperasi-astra.com',
            'phone' => '089635594784',
            'address' => 'Jl. Mitra Sunter Boulevard Blok C2 Kav 90 Sunter Jaya, Jakarta 14350',
            'about' => 'Koperasi Astra merupakan salah satu upaya PT. Astra International Tbk, untuk menambah kesejahteraan karyawan tetapnya di seluruh anak perusahaan  melalui manfaat ekonomi yang dikelola Koperasi. Sebagai koperasi konsumen, Koperasi Astra tidak hanya memfasilitasi berbagai produk layanan simpan pinjam namun juga mampu meningkatkan kinerja melalui anak perusahaan yang bergerak dalam berbagai bidang.',
            'facebook' => 'http://www.facebook.com',
            'twitter' => 'http://www.twitter.com',
            'instagram' => 'http://www.instagram.com',
            'whatsapp' => '6289635594784',
        ]);
    }
}
