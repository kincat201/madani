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
        'deadline',
        'design_fee',
        'marketing_fee',
        'finishing_fee',
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
        'phone' => 'required',
        'name' => 'required',
    ];

    const exportData = [
        'code'=>'Order Number',
        'name'=>'Pelanggan',
        'phone'=>'Telepon',
        'deadline'=>'Deadline',
        'created_at'=>'Tanggal Pesan',
        'payment_date'=>'Tanggal Bayar',
        'design_fee'=>'Biaya Desain',
        'finishing_fee'=>'Biaya Finishing',
        'down_payment'=>'Total Bayar',
        'total_payment'=>'Sisa Bayar',
        'grand_total'=>'Total Harga',
        'status'=>'Status',
        'payment_method'=>'Cara Pembayaran',
        'payment_status'=>'Status Pembayaran',
        'remark'=>'Keterangan',
    ];

    const exportDataItem = [
        'code'=>'Order Number',
        'product'=>'Produk',
        'product_type'=>'Jenis Harga',
        'remark'=>'Keterangan',
        'qty'=>'Jumlah',
        'price'=>'Harga Satuan',
        'hpp'=>'Harga Modal',
        'total_price'=>'Total Harga',
        'total_hpp'=>'Total Modal',
    ];

    const exportDataMachine = [
        'code'=>'Order Number',
        'machine'=>'Mesin',
        'completeDate'=>'Tanggal Selesai',
        'status'=>'Status',
    ];

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('orders.deleted', 0);
    }

    public function items()
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
