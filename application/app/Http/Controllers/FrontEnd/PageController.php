<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\ImportProduct;
use App\Member;
use App\Order;
use App\OrderDetail;
use App\OrderProduct;
use App\Product;
use App\ProductVariant;
use App\Service\MailerService;
use App\Unit;
use App\User;
use App\Util\Constant;
use Illuminate\Http\Request;
use Session;
use Validator;
use Response;

use PDF;

class PageController extends FrontEndController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $categories = Category::where('deleted',0)->limit(3)->orderBy('id','asc')->get();
        $news = Product::active()
            ->orderBy('created_at','desc')
            ->limit(7)
            ->get();
        $bests = OrderDetail::withCount('product')
            ->orderBy('product_count', 'desc')
            ->limit(7)
            ->get();

        return view('frontend.pages.home',[
            'categories' => $categories,
            'news' => $news,
            'bests' => $bests
        ]);
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function sendContact(Request $request)
    {
        $contact = new stdClass();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        MailerService::contact($contact);

        return view('frontend.pages.contact')->with('success','Terima kasih telah menghubungi kami');
    }

    public function about(){
        return view('frontend.pages.about');
    }

    public function help(){
        $features = Product::where('label',1)
            ->orderBy('created_at','desc')
            ->limit(4)
            ->get();
        return view('frontend.pages.help',['features'=>$features]);
    }

    public function invoice($id){
        $order = Order::with(['member','items.product','orderMachine'])->find($id);
        //return view('pdf.invoice',['order'=>$order,'title'=>'Kwitansi Pesanan']);

        $pdf = PDF::loadView('pdf.invoice',['order'=>$order,'title'=>'Kwitansi Pesanan']);
        return $pdf->download('order_'.$order->code.'.pdf');
    }

    public function import(){
        $imports = ImportProduct::all();
        $units = [];
        $units_name = [];
        foreach (Unit::all() as $unit){
            $units[] = $unit->id;
            $units_name[] = $unit->name;
        }
        foreach ($imports as $key => $import){
            if($key == 0) continue;
            $data = explode(';',$import);

            $product = new Product();
            $product->name = $data[1];
            $product->category_id = $data[2];
            $product->unit_id = $units[array_search($data[3],$units_name)];
            $product->status = Constant::COMMON_STATUS_ACTIVE;
            $product->online = Constant::COMMON_STATUS_INACTIVE;
            $product->save();

            for ($i = 4;$i<=7;$i++){
                if (!empty($data[$i])) {
                    $detail = explode('-', $data[$i]);
                    if(!empty($detail[1])){
                        $product_variant = new ProductVariant();
                        $product_variant->product_id = $product->id;
                        $product_variant->remark = $detail[0];
                        $product_variant->hpp = $detail[1];
                        $product_variant->price = $detail[2];
                        $product_variant->types = Constant::PRODUCT_TYPE_PRICE_SINGLE;
                        $product_variant->save();

                        if (!empty($detail[3])) {
                            $product_variant = new ProductVariant();
                            $product_variant->product_id = $product->id;
                            $product_variant->remark = $detail[0];
                            $product_variant->hpp = $detail[1];
                            $product_variant->price = $detail[3];
                            $product_variant->types = Constant::PRODUCT_TYPE_PRICE_FIFTY;
                            $product_variant->save();
                        }
                    }
                }
            }
        }
        return response()->json($imports);
    }
}



