<?php

namespace App;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;

class OrderMachine extends Model
{
    protected $table = 'order_machines';
    protected $primaryKey = 'id'; // or null

    protected $fillable = [
        'order_id',
        'machine_id',
        'completeDate',
        'status',
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
    ];

    const exportData = [

    ];

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('order_machines.deleted', 0);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class,'machine_id','id');
    }
}
