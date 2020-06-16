<?php

namespace App\Http\Controllers\BackEnd;

use App\Helpers\FileHelper;
use App\Product;
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

        $error_price = empty($request->prices) || count($request->prices ) <= 0 ? true : false;

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
        }else{
            $qty = $data->qty;
        }

        $data->fill((array)$request->all());
        $data->prices = $request->prices;

        $iconImage = $data->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if(!empty($iconImage) && file_exists('storage/'.$iconImage)){
                unlink('storage/'.$iconImage);
            }
            $iconImage = $image->store('product','public');
        }

        $data->image = $iconImage;

        if($data->save()){
            ProductStockService::setProductStock($data->id,0, 'PRODUCT', $qty, $request->qty);
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
        return Excel::create( 'export_unit_'.time() , function($excel) {

            // Set the title
            $excel->setTitle('Export Data Product');

            // Call them separately
            $excel->setDescription('Data unit');

            $datas = Product::all();

            $excel->sheet('unit', function($sheet) use ($datas) {

                // Sheet manipulation
                $sheet->loadView('backend.part.export',['datas'=>$datas,'model'=>Product::class]);

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
