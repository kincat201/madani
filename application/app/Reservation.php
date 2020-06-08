<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id'; // or null

    protected $fillable = [
        'userId',
        'title',
        'room',
        'amount',
        'food',
        'pic',
        'reservationDate',
        'reservationTimeFrom',
        'reservationTimeTo',
        'status',
        'remark',
    ];

    const FORM_FIELD = [
    ];

    const FORM_DISABLED = [];

    const FORM_LABEL = [
    ];

    const FORM_HELP_LIST = [];

    const FORM_LABEL_HELP = [
    ];

    const FORM_SELECT_LIST = [
    ];

    const FORM_VALIDATION = [
        'title' => 'required',
        'pic' => 'required',
        'amount' => 'required',
        'room' => 'required',
        'food' => 'required',
        'reservationDate' => 'required',
    ];

    const exportData = [
        'title' => 'Kegiatan',
        'userId' => 'Pembuat',
        'room' => 'Ruangan',
        'amount' => 'Peserta',
        'pic' => 'PIC',
        'reservationDate' => 'Tanggal',
        'reservationTimeFrom' => 'Mulai',
        'reservationTimeTo' => 'Akhir',
        'food' => 'Makanan',
        'status' => 'Status',
        'remark' => 'Keterangan',
    ];

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('reservation.deleted', 0);
    }

    public function user(){
        return $this->belongsTo(User::class,'userId','id');
    }
}
