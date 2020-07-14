<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Config;
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

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;

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
            ->groupBy('product_id')
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
        $order = Order::with(['member','cashier','creator','items.product','orderMachine'])->find($id);
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

    public function testPrint(){
        try {
            $connector = new WindowsPrintConnector("posprinter");
            $printer = new Printer($connector);

            //https://www.youtube.com/watch?v=9GRVEdWuxmA
            //https://drive.google.com/file/d/1Sw-Aus-qN7pMLaEFK_H3JOCHamvjVju2/view?usp=sharing

            $config = Config::find(1);

            /* Name of shop */
            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> setTextSize(1,2);
            $printer -> text($config->title);
            $printer -> setTextSize(1,1);
            $printer -> feed();
            $printer -> text($config->address);
            $printer -> feed(2);

            $printer -> setJustification(Printer::JUSTIFY_LEFT);

            /* Title of receipt */
            $printer -> setEmphasis(true);
            $printer -> text("Pelanggan : ". 'Kincat (028123)');
            $printer -> feed();
            $printer -> text("Kode Antrian : ". 'ORD-'.time());
            $printer -> setEmphasis(false);
            $printer -> feed(2);

            /* Information for the receipt */
            $items = [
                [
                    'name'=>'barang 1',
                    'price'=>20000,
                    'qty'=>1,
                    'total'=> 20000
                ],
                [
                    'name'=>'barang 2',
                    'price'=>10000,
                    'qty'=>3,
                    'total'=> 30000
                ],
            ];

            $subTotal = 50000;
            $designFee = 10000;
            $total = 60000;
            $payment = 50000;
            if($payment - $total >= 0){
                $result = 'Kembali : Rp. '.number_format($payment-$total);
            }else{
                $result = 'Sisa : Rp. '.number_format($total-$payment);
            }

            /* Items */
            foreach ($items as $item) {
                $printer -> text($item['name']);
                $printer -> feed();
                $printer -> text('Rp '.number_format($item['price']).' x '. number_format($item['qty']).' = Rp. '.number_format($item['total']));
                $printer -> feed();
            }

            $printer -> feed();
            $printer -> setEmphasis(true);
            $printer -> text('Sub Total : Rp. '. number_format($subTotal));
            $printer -> feed();
            $printer -> text('Harga Desain : Rp. '. number_format($designFee));
            $printer -> setEmphasis(false);
            $printer -> feed();

            /* Tax and total */
            $printer -> setEmphasis(true);
            $printer -> text('Total : Rp. '. number_format($total));
            $printer -> feed();
            $printer -> text('Pembayaran : Rp. '. number_format($payment));
            $printer -> feed();
            $printer -> text($result);
            $printer -> setEmphasis(false);

            /* Footer */
            $printer -> feed(2);
            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> text("Terima kasih telah bertransaksi di ". $config->title.".");
            $printer -> feed();
            $printer -> text(" Informasi lebih lengkap bisa menghubungi ". $config->phone);
            $printer -> feed(2);
            $printer -> text(date('d F Y, H:i:s A') . "\n");
            $printer -> feed(2);

            $printer -> cut();
            $printer -> pulse();

            $printer -> close();

        } catch(Exception $e) {
            echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
        }
    }
}



