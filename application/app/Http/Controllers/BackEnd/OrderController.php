<?php

namespace App\Http\Controllers\BackEnd;

use App\Category;
use App\Order;
use App\Product;
use App\Util\Constant;
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

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $data = Order::find($request->id);

        if(empty($data->id)){
            $data = new Order();
        }

        $data->fill((array)$request->all());

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data gagal simpan, coba lagi'));
        }

    }

    public function getData($id){
        $data['sidebar'] = 'order_new';
        $data['model'] = !empty($id) ? Order::find($id) : Order::class;
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
        $datas = Order::orderBy('name','asc')->get();

        return DataTables::of($datas)
            ->addColumn('aksi',function($data) {
                return '<a onclick="editData('.$data->id.')" class="btn btn-info btn-xs">Edit</a>'.' '.
                    '<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
            })
            ->filter(function ($instance) use ($request) {
                if ($request->has('name') && !empty($request->name)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains(strtoupper($row['name']), strtoupper($request->get('name'))) ? true : false;
                    });
                }

                if ($request->has('description') && !empty($request->description) ) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['description'], $request->get('description')) ? true : false;
                    });
                }
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
}
