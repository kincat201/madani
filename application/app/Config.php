<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public $timestamps = false;
    protected $table = 'config';

    protected $fillable = [
        'title',
        'logo',
        'logoSecond',
        'icon',
        'email',
        'phone',
        'address',
        'about',
        'slider',
        'facebook',
        'instagram',
        'whatsapp',
    ];

    const FORM_FIELD = [
        'title' => 'text',
        'email' => 'text',
        'phone' => 'text',
        'facebook' => 'text',
        'instagram' => 'text',
        'whatsapp' => 'text',
        'address' => 'textarea',
        'about' => 'textarea',
        'logo' => 'image',
        'logoSecond' => 'image',
        'icon' => 'image',
    ];

    const FORM_LABEL = [
        'title' => 'Judul Website',
        'email' => 'Email Admin',
        'phone' => 'Telepon Admin',
        'facebook' => 'Facebook Link',
        'instagram' => 'Instagram Link',
        'whatsapp' => 'Whatsapp Admin',
        'address' => 'Alamat Kantor',
        'about' => 'Deskripsi singkat',
        'logo' => 'Logo Depan',
        'logoSecond' => 'Logo Belakang',
        'icon' => 'Fav Icon Website',
    ];

    const FORM_HELP_LIST = ['whatsapp','logo','logoSecond','icon'];

    const FORM_LABEL_HELP = [
        'whatsapp' => 'Gunakan Nomor dengan Kode Negara (62)',
        'logo' => 'Format File(PNG,JPG),Ukuran Max(100kb), Ukuran Gambar (200 x 191)',
        'logoSecond' => 'Format File(PNG,JPG),Ukuran Max(100kb), Ukuran Gambar (180 x 80)',
        'icon' => 'Format File(PNG,JPG),Ukuran Max(100kb), Ukuran Gambar (17 x 17)',
    ];

    const FORM_DISABLED = [

    ];

    const FORM_SELECT_LIST = [

    ];

    const FORM_VALIDATION_DETAIL = [
        'title' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'address' => 'required',
    ];

}
