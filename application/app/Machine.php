<?php

namespace App;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $table = 'machines';
    public $timestamps = false;
    protected $primaryKey = 'id'; // or null

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    const FORM_FIELD = [
        'name' => 'text',
        'description' => 'textarea',
        'status' => 'select',
    ];

    const FORM_DISABLED = [];

    const FORM_LABEL = [
        'name' => 'Nama',
        'description' => 'Deskripsi',
        'status' => 'Status',
    ];

    const FORM_HELP_LIST = [];

    const FORM_LABEL_HELP = [
    ];

    const FORM_SELECT_LIST = [
        'status' => 'getCommonStatus',
    ];

    const FORM_VALIDATION = [
        'name' => 'required',
        'status' => 'required',
    ];

    const exportData = [
        'id'=>'Mesin Id',
        'name'=>'Nama',
        'description'=>'Deskripsi',
        'status'=>'Status',
    ];

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('machines.deleted', 0);
    }

    public function orders()
    {
        return $this->hasMany(OrderMachine::class,'machine_id','id');
    }
}
