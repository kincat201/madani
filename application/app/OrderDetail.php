<?php

namespace App;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    public $timestamps = false;
    protected $primaryKey = 'id'; // or null

    protected $fillable = [
        'order_id',
        'product_id',
        'remark',
        'qty',
        'price',
        'hpp',
        'total_price',
        'total_hpp',
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
            ->where('order_details.deleted', 0);
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
