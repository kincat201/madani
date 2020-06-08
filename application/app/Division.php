<?php

namespace App;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'division';
    public $timestamps = false;
    protected $primaryKey = 'id'; // or null

    protected $fillable = [
        'name',
        'status',
    ];

    const FORM_FIELD = [
        'name' => 'text',
        'status' => 'select',
    ];

    const FORM_DISABLED = [];

    const FORM_LABEL = [
        'name' => 'Nama',
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

    ];

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('division.deleted', 0);
    }

    public function scopeActive($query)
    {
        return $query->where('division.status', Constant::COMMON_STATUS_ACTIVE);
    }

    public function pics()
    {
        return $this->belongsToMany(Pic::class,'pic_division','divisionId','picId');
    }
}
