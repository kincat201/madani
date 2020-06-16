<?php

namespace App;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id'; // or null

    protected $fillable = [
        'name',
        'description',
        'qty',
        'category_id',
        'unit_id',
        'status',
        'prices',
        'online',
    ];

    const FORM_FIELD = [
        'name' => 'text',
        'description' => 'textarea',
        'qty' => 'number',
        'category_id' => 'select',
        'unit_id' => 'select',
        'status' => 'select',
        'online' => 'select',
        'image' => 'image',
    ];

    const FORM_DISABLED = [];

    const FORM_LABEL = [
        'name' => 'Nama',
        'description' => 'Deskripsi',
        'qty' => 'Jumlah',
        'category_id' => 'Kategori',
        'unit_id' => 'Satuan',
        'status' => 'Status',
        'online' => 'Online',
        'image' => 'Foto',
    ];

    const FORM_HELP_LIST = [ 'image' ];

    const FORM_LABEL_HELP = [
        'image' => 'Format File(PNG,JPG),Ukuran Max(100kb), Ukuran Gambar (200 x 191)',
    ];

    const FORM_SELECT_LIST = [
        'category_id' => 'getCategoryList',
        'unit_id' => 'getUnitList',
        'status' => 'getCommonStatus',
        'online' => 'getCommonStatus',
    ];

    const FORM_VALIDATION_LIST = [
        'name',
        'qty',
        'category_id',
        'unit_id',
        'status',
        'online',
    ];

    const FORM_VALIDATION = [
        'name' => 'required',
        'qty' => 'required',
        'category_id' => 'required',
        'unit_id' => 'required',
        'status' => 'required',
        'online' => 'required',
    ];

    const exportData = [

    ];

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('products.deleted', 0);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class,'product_id','id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
