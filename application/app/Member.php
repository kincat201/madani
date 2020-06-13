<?php

namespace App;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id'; // or null

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'types',
    ];

    const FORM_FIELD = [
        'name' => 'text',
        'email' => 'email',
        'phone' => 'text',
        'address' => 'textarea',
        'types' => 'select',
    ];

    const FORM_DISABLED = [];

    const FORM_LABEL = [
        'name' => 'Nama',
        'email' => 'Email',
        'phone' => 'Phone',
        'address' => 'Tempat Tinggal',
        'types' => 'Tipe',
    ];

    const FORM_HELP_LIST = [];

    const FORM_LABEL_HELP = [
    ];

    const FORM_SELECT_LIST = [
        'status' => 'getCommonStatus',
    ];

    const FORM_VALIDATION = [
        'name' => 'required',
        'types' => 'required',
    ];

    const exportData = [

    ];

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('members.deleted', 0);
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'member_id','id');
    }
}
