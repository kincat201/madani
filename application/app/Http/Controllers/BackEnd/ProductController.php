<?php

namespace App\Http\Controllers\BackEnd;

use App\Helpers\FileHelper;
use App\Product;
use App\ProductStock;
use App\Service\ProductStockService;
use App\Util\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class ProductController extends BackEndController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sidebar'] = 'product';
        $data['model'] = Product::class;
        return view('backend.product.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = array();

        foreach (Product::FORM_VALIDATION as $key => $value){
            $validate_rule[$key] = $value;
        }

        $validation = Validator::make($request->all(),$validate_rule);

        $error_price = empty($request->prices) || count(json_decode($request->prices)) <= 0 ? true : false;

        if($validation->fails() || $error_price){
            $data['status'] = false;
            $data['message'] = $error_price ? 'Minimal masukan satu harga' : 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $data = Product::find($request->id);

        if(empty($data->id)){
            $data = new Product();
            $qty = 0;
            $data->image = 'products/default.png';
        }else{
            $qty = $data->qty;
        }

        $request->qty = str_replace('.','', $request->qty);

        $data->fill((array)$request->all());
        $data->qty = $request->qty;

        $productImage = $data->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if(!empty($productImage) && file_exists('storage/'.$productImage)){
                unlink('storage/'.$productImage);
            }
            $productImage = $image->store('products','public');
        }

        $data->image = $productImage;

        if($data->save()){
            $data->variants()->delete();
            foreach(json_decode($request->prices) as $data_price){
                $data->variants()->insert([
                    'product_id'=>$data->id,
                    'types' => $data_price->types,
                    'remark' => $data_price->remark,
                    'price' => str_replace('.','', $data_price->price),
                    'hpp' => str_replace('.','', $data_price->hpp),
                ]);
            }
            ProductStockService::setProductStock($data->id,0, Constant::STOCK_TYPE_PRODUCT, $qty, $request->qty);
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data gagal simpan, coba lagi'));
        }

    }

    public function getData($id){
        $data['sidebar'] = 'product';
        $data['model'] = !empty($id) ? Product::find($id) : Product::class;
        $data['types'] = Constant::PRODUCT_TYPE_PRICE_LIST;
        return view('backend.product.detail',$data);
    }

    public function indexData(Request $request){
        $datas = Product::with(['category','unit'])->orderBy('name','asc');

        $filter = [
            'name' => 'like',
            'description' => 'like',
            'category_id' => '=',
            'unit_id' => '=',
            'online'=> '=',
            'status'=> '='
        ];

        foreach ($filter as $key => $operator){
            $relationFilter = explode('.',$key);
            $currentKey = $key;
            if(count($relationFilter)>1){
                $currentKey = $relationFilter[0];
            } else{
                $key = 'products.'.$key;
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
            ->editColumn('qty',function($data) {
                return number_format($data->qty);
            })
            ->addColumn('category_id',function($data) {
                return $data->category->name;
            })
            ->addColumn('unit_id',function($data) {
                return $data->unit->name;
            })
            ->addColumn('aksi',function($data) {
                return '<a href="'.route('admin.product.get',$data->id).'" class="btn btn-info btn-xs">Edit</a>'.' '.
                    '<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
            })
            ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $delete = Product::find($id);
        $delete->deleted = 1;
        $delete->save();
    }

    public function export()
    {
        return Excel::create( 'export_product_'.time() , function($excel) {

            // Set the title
            $excel->setTitle('Export Data Product');

            // Call them separately
            $excel->setDescription('Data product');

            $datas = Product::with(['unit','category','stocks.orderDetail.order','variants'])->get();

            $excel->sheet('produk', function($sheet) use ($datas) {

                foreach ($datas as $key => $data){
                    $datas[$key]->category_id = $data->category->name;
                    $datas[$key]->unit_id = $data->unit->name;
                }

                // Sheet manipulation
                $sheet->loadView('backend.part.export',['datas'=>$datas,'model'=>Product::class]);

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Times New Roman',
                        'size'      =>  12,
                    )
                ));
            });

            $excel->sheet('stock', function($sheet) use ($datas) {

                $dataStock = [];
                foreach ($datas as $key => $data){
                    foreach ($data->stocks as $stockKey => $stock){
                        $stock->product = $data->name;
                        $stock->order_detail_id = !empty($stock->order_detail_id) ? $stock->orderDetail->order->code : '-';
                        $stock->types = Constant::STOCK_TYPE_LIST[$stock->types];
                        $dataStock[] = $stock;
                    }
                }

                // Sheet manipulation
                $sheet->loadView('backend.product.export.custom-export',['datas'=>$dataStock,'model'=>Product::exportDataStock]);

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Times New Roman',
                        'size'      =>  12,
                    )
                ));
            });

            $excel->sheet('variant', function($sheet) use ($datas) {

                $dataVariant = [];
                foreach ($datas as $key => $data){
                    foreach ($data->variants as $stockVariant => $variant){
                        $variant->product = $data->name;
                        $variant->types = Constant::PRODUCT_TYPE_PRICE_LIST[$variant->types];
                        $dataVariant[] = $variant;
                    }
                }

                // Sheet manipulation
                $sheet->loadView('backend.product.export.custom-export',['datas'=>$dataVariant,'model'=>Product::exportDataVariant]);

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

    public function stockData(Request $request){
        $datas = ProductStock::with(['product','orderDetail.order'])->orderBy('created_at','asc');

        $filter = [
            'types'=> '='
        ];

        foreach ($filter as $key => $operator){
            $relationFilter = explode('.',$key);
            $currentKey = $key;
            if(count($relationFilter)>1){
                $currentKey = $relationFilter[0];
            } else{
                $key = 'product_stocks.'.$key;
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
            ->editColumn('qty_before',function($data) {
                return number_format($data->qty_before);
            })
            ->editColumn('qty_after',function($data) {
                return number_format($data->qty_after);
            })
            ->editColumn('types',function($data) {
                return Constant::STOCK_TYPE_LIST[$data->types];
            })
            ->addColumn('code',function($data) {
                return !empty($data->orderDetail) ? $data->orderDetail->order->code : '-';
            })
            ->escapeColumns([])->make(true);
    }
}
