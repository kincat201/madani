<?php
namespace App\Service;

use App\Order;
use App\OrderMachine;
use App\Product;
use App\Util\Constant;
use Carbon\Carbon;

class OrderService {
    public static function GenerateNumber() {
        return Carbon::today()->format('Y-m-d') . '-' . str_pad((Order::whereDate('payment_date', '=', Carbon::today())->count()) + 1, 4, '0', STR_PAD_LEFT);
    }

    public static function updateStatus($order, $status_before, $status_after, $request) {
        if($status_before == Constant::ORDER_STATUS_NEW && $status_after == Constant::ORDER_STATUS_PAYMENT_COMPLETE){
            $order->down_payment = $request->down_payment;
            $order->total_payment = $request->total_payment;
            $order->grand_total = $request->grand_total;
            $order->payment_status = $request->payment_status;
            $order->payment_method = $request->payment_method;
            $order->payment_date = Carbon::now();

            $order->status = $status_after;
            $order->save();
        } elseif($status_before == Constant::ORDER_STATUS_PAYMENT_COMPLETE && $status_after == Constant::ORDER_STATUS_PROGRESS){

            foreach ($order->items as $item){
                $current = $item->product->qty;
                $after = $current - $item->qty;
                ProductStockService::setProductStock($item->product_id, $item->id, Constant::STOCK_TYPE_ORDER,$current, $after);
                $product = Product::find($item->product_id);
                $product->qty = $after;
                $product->save();
            }

            $orderMachine = new OrderMachine();
            $orderMachine->order_id = $order->id;
            $orderMachine->machine_id = $request->machine_id;
            $orderMachine->status = Constant::ORDER_MACHINE_STATUS_PROGRESS;
            $orderMachine->save();

            $order->status = $status_after;
            $order->remark = $request->remark;
            $order->save();

        } elseif($status_before == Constant::ORDER_STATUS_PROGRESS && $status_after == Constant::ORDER_STATUS_COMPLETED){
            $orderMachine = OrderMachine::where('order_id',$order->id)->first();
            $orderMachine->status = Constant::ORDER_MACHINE_STATUS_COMPLETE;
            $orderMachine->completeDate = Carbon::now();
            $orderMachine->save();

            $order->status = $status_after;
            $order->save();
        } elseif(empty($status_before)){
            $order->status = $status_after;
            $order->save();
        } elseif($status_after == Constant::ORDER_STATUS_CANCELLED) {

            if($status_before == Constant::ORDER_MACHINE_STATUS_PROGRESS){

                foreach ($order->items as $item){
                    $current = $item->product->qty;
                    $after = $current + $item->qty;
                    ProductStockService::setProductStock($item->product_id, $order->id, Constant::STOCK_TYPE_ORDER_CANCEL,$current, $after);
                    $product = Product::find($item->product_id);
                    $product->qty = $after;
                    $product->save();
                }

                $orderMachine = OrderMachine::where('order_id',$order->id)->first();
                $orderMachine->status = Constant::ORDER_MACHINE_STATUS_CANCELLED;
                $orderMachine->completeDate = Carbon::now();
                $orderMachine->save();
            }

            $order->remark = $request->remark;
            $order->status = $status_after;
            $order->save();
        }
    }
}
