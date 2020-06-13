<?php

namespace App;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;
    protected $primaryKey = 'id'; // or null

    protected $fillable = [
        'name',
        'description',
    ];

    const FORM_FIELD = [
        'name' => 'text',
        'description' => 'textarea',
    ];

    const FORM_DISABLED = [];

    const FORM_LABEL = [
        'name' => 'Nama',
        'description' => 'Deskripsi',
    ];

    const FORM_HELP_LIST = [];

    const FORM_LABEL_HELP = [
    ];

    const FORM_SELECT_LIST = [

    ];

    const FORM_VALIDATION = [
        'name' => 'required',
    ];

    const exportData = [
        'id'=>'Kategory_id',
        'name'=>'Nama',
        'description'=>'Deskripsi',
    ];

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('categories.deleted', 0);
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }
}
