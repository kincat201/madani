<?php

namespace App\Http\Controllers\FrontEnd;

use App\ImportProduct;
use App\Member;
use App\Order;
use App\Product;
use App\ProductVariant;
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
        $data['sidebar'] = 'reservation';
        $data['list'] = Member::get();
        return view('frontend.pages.home',$data);
    }

    public function register(){
        $data['sidebar'] = 'pic-register';
        $data['model'] = User::class;
        return view('auth.frontend.register', $data);
    }

    public function saveRegister(Request $request){
        $validate_rule = array();

        $validate_rule['email'] = 'required|email';
        $validate_rule['name'] = 'required';
        $validate_rule['phone'] = 'required';
        $validate_rule['birthDay'] = 'required|date';
        $validate_rule['password'] = 'required|confirmed|min:6';
        $validate_rule['username'] = 'required|unique:users,username';

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $user = new User();
        $user->fill((array) $request->all());
        $user->password = bcrypt($request->password);

        if($user->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data gagal simpan, coba lagi'));
        }
    }

    public function login(){
        return view('auth.frontend.login');
    }

    public function password(){
        return view('auth.frontend.password');
    }

    public function resetPassword(Request $request)
    {
        $validate_rule = array();
        $validate_rule['username'] = 'required';
        $validate_rule['birthDay'] = 'required';
        $validate_rule['password'] = 'required|confirmed';

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $data = User::select('users.id')
            ->where('username',$request->username)
            ->where('birthDay', $request->birthDay)
            ->first();
        if(empty($data->id)){
            $data['status'] = false;
            $data['message'] = 'Data akun tidak ditemukan';

            return response()->json($data);
        }
        $user = User::find($data->id);
        $user->password = bcrypt($request->password);

        if($user->save()){
            \Auth::login($user);
            return response()->json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return response()->json(array('status'=>false,'message'=>'Data gagal simpan, coba lagi'));
        }
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



