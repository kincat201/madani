<?php
namespace App\Service;

use App\ProductStock;
use App\Util\Constant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ProductStockService {
    public static function setProductStock($product_id, $order_id, $types, $current, $after){

        if($current == $after) return;

        return ProductStock::insert([
            'product_id' => $product_id,
            'order_detail_id' => $order_id,
            'types' => $types,
            'qty_before' => $current,
            'qty_after' => $after,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
