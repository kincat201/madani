<?php

namespace App;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id'; // or null

    protected $fillable = [
        'member_id',
        'code',
        'is_design',
        'payment_date',
        'deadline',
        'design_fee',
        'marketing_fee',
        'finishing_fee',
        'down_payment',
        'total_payment',
        'grand_total',
        'payment_method',
        'payment_status',
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
    ];

    const exportData = [

    ];

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('orders.deleted', 0);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }

    public function orderMachine()
    {
        return $this->hasMany(OrderMachine::class,'order_id','id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class,'member_id','id');
    }
}
