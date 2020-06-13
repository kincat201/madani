<?php

namespace App;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $table = 'product_stocks';
    protected $primaryKey = 'id'; // or null

    protected $fillable = [
        'product_id',
        'order_detail_id',
        'types',
        'qty_before',
        'qty_after',
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
            ->where('product_stocks.deleted', 0);
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
