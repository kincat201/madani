<?php

namespace App\Http\Controllers\BackEnd;

use App\Category;
use App\Member;
use App\Order;
use App\OrderMachine;
use App\Product;
use App\Service\OrderService;
use App\Util\Constant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class OrderController extends BackEndController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sidebar'] = 'order';
        $data['model'] = Order::class;
        return view('backend.order.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = array();

        foreach (Order::FORM_VALIDATION as $key => $value){
            $validate_rule[$key] = $value;
        }

        $validation = Validator::make($request->all(),$validate_rule);

        $error_item = empty($request->items) || count(json_decode($request->items)) <= 0 ? true : false;

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = $error_item ? 'Minimal masukan satu item' : 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $member = Member::where('phone',$request->phone)->first();
        if(empty($member->id)){
            $member = new Member();
            $member->phone = $request->phone;
        }

        $member->name = $request->name;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->save();

        $data = Order::find($request->id);

        if(empty($data->id)){
            $data = new Order();
            $data->code = OrderService::GenerateNumber();
            $data->payment_date = Carbon::now();
        }

        $data->member_id = $member->id;

        $data->fill((array)$request->all());

        $reformating = ['design_fee','finishing_fee','down_payment','total_payment','grand_total'];
        foreach ($reformating as $reform){
            $data->$reform = str_replace('.','',$request->$reform);
        }

        $status_before = $data->status;

        if($data->save()){
            $data->items()->delete();
            foreach(json_decode($request->items) as $item){
                $data->items()->insert([
                    'order_id'=>$data->id,
                    'product_id' => $item->product_id,
                    'remark' => $item->remark,
                    'product_type' => $item->product_type,
                    'qty' => str_replace('.','', $item->qty),
                    'price' => str_replace('.','', $item->price),
                    'hpp' => str_replace('.','', $item->hpp),
                    'total_price' => str_replace('.','', $item->total_price),
                    'total_hpp' => str_replace('.','', $item->total_hpp),
                ]);
            }
            if(\Auth::user()->role == Constant::USER_ROLE_DESIGNER){
                OrderService::updateStatus($data,$status_before,Constant::ORDER_STATUS_NEW,$request);
            }elseif(\Auth::user()->role == Constant::USER_ROLE_CASHIER){
                OrderService::updateStatus($data,$status_before,Constant::ORDER_STATUS_PAYMENT_COMPLETE, $request);
            }elseif(\Auth::user()->role == Constant::USER_ROLE_ADMIN){
                OrderService::updateStatus($data,Constant::ORDER_STATUS_NEW,Constant::ORDER_STATUS_PAYMENT_COMPLETE, $request);
            }
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data gagal simpan, coba lagi'));
        }

    }

    public function getData($id){
        $data['sidebar'] = 'order_new';
        $data['model'] = !empty($id) ? Order::with(['member','items.product'])->where('id',$id)->first() : Order::class;
        $data['categories'] = Category::with(['products.unit','products.variants'])
            ->whereHas('products', function ($product){
                $product->orderBy('name','asc');
                $product->where('status', Constant::COMMON_STATUS_ACTIVE);
            })
            ->orderBy('name','asc')
            ->get();
        return view('backend.order.detail',$data);
    }

    public function indexData(Request $request){
        $datas = Order::select('orders.id','code','deadline','status','payment_status',
            'orders.created_at','members.name','members.phone')
            ->join('members','members.id', '=','orders.member_id','left')
            ->orderBy('code','desc');

        $filter = [
            'code' => 'like',
            'members.name' => 'like',
            'members.phone' => 'like',
            'status' => '=',
            'payment_status' => '=',
            'deadline' => '=',
        ];

        foreach ($filter as $key => $operator){
            $relationFilter = explode('.',$key);
            $currentKey = $key;
            if(count($relationFilter)>1){
                $currentKey = $relationFilter[1];
            } else{
                $key = 'orders.'.$key;
            }
            if ($request->has($currentKey) && !empty($request->$currentKey) ) {
                if($operator == 'like'){
                    $datas->where($key,$operator,'%'.$request->$currentKey.'%');
                } else {
                    $datas->where($key,$operator,$request->$currentKey);
                }
            }
        }

        return DataTables::of($datas)
            ->editColumn('status', function($data){
                return '<label class="label label-'.Constant::ORDER_STATUS_LABEL_LIST[$data->status].'">'.Constant::ORDER_STATUS_LIST[$data->status].'</label>';
            })
            ->editColumn('payment_status', function($data){
                return '<label class="label label-'.Constant::STATUS_PAYMENT_LABEL_LIST[$data->payment_status].'">'.Constant::STATUS_PAYMENT_LIST[$data->payment_status].'</label>';
            })
            ->addColumn('aksi',function($data) {
                $action = '<a href="'.route('admin.order.get',$data->id).'" class="btn btn-info btn-xs">Detail</a>';
                if($data->status == Constant::ORDER_STATUS_NEW){
                    $action .= '<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Hapus</a>';
                }
                if(\Auth::user()->role == Constant::USER_ROLE_ENGINEER || \Auth::user()->role == Constant::USER_ROLE_ADMIN){
                    if($data->status == Constant::ORDER_STATUS_PAYMENT_COMPLETE){
                        $action .= '<a onclick="processData('.$data->id.')"class="btn btn-success btn-xs">Proses</a>';
                    }
                    if($data->status == Constant::ORDER_STATUS_PROGRESS){
                        $action .= '<a onclick="completeData('.$data->id.')"class="btn btn-primary btn-xs">Selesai</a>';
                    };
                }
                if(\Auth::user()->role == Constant::USER_ROLE_CASHIER || \Auth::user()->role == Constant::USER_ROLE_ADMIN) {
                    if ($data->payment_status != Constant::STATUS_PAYMENT_PAID && $data->status != Constant::ORDER_STATUS_NEW) {
                        $action .= '<a onclick="paidData(' . $data->id . ')"class="btn btn-default btn-xs">Lunas</a>';
                    }
                }
                if($data->status != Constant::ORDER_STATUS_NEW){
                    $action .= '<a onclick="cancelData('.$data->id.')"class="btn btn-danger btn-xs">Batal</a>';
                }
                return $action;
            })
            ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $delete = Order::find($id);
        $delete->deleted = 1;
        $delete->save();
    }

    public function export()
    {
        return Excel::create( 'export_order_'.time() , function($excel) {

            // Set the title
            $excel->setTitle('Export Data Order');

            // Call them separately
            $excel->setDescription('Data order');

            $datas = Order::all();

            $excel->sheet('order', function($sheet) use ($datas) {

                // Sheet manipulation
                $sheet->loadView('backend.part.export',['datas'=>$datas,'model'=>Order::class]);

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Times New Roman',
                        'size'      =>  12,
                    )
                ));
            });

        })
            // ;
            ->download('xls');
    }

    public function setPayment(Request $request)
    {
        $order = Order::find($request->id);
        $order->payment_status = Constant::STATUS_PAYMENT_PAID;
        $order->payment_date = Carbon::now();
        $order->save();
    }

    public function setStatus(Request $request)
    {
        if($request->status == Constant::ORDER_STATUS_PROGRESS){
            if(empty($request->machine_id)) return Response::json(array('status'=>false,'message'=>'Mesin tidak boleh kosong!'));
        }

        $order = Order::where('id',$request->id)->with(['items.product','orderMachine'])->first();
        if(empty($order->id)){
            return Response::json(array('status'=>false,'message'=>'Order tidak ditemukan!'));
        }
        OrderService::updateStatus($order,$order->status,$request->status,$request);

        return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
    }

    public function getMachine($id){
        return Response::json(Order::with('orderMachine')->where('id',$id)->first());
    }
}
