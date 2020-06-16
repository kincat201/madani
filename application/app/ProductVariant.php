<?php

namespace App;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variants';
    protected $primaryKey = 'id'; // or null
    public $timestamps = false;

    protected $fillable = [
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

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
