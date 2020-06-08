<?php

namespace App\Http\Controllers\BackEnd;

use App\Division;
use App\Util\Constant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class DivisionController extends BackEndController
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
        $data['sidebar'] = 'division';
        $data['model'] = Division::class;
        return view('backend.division.index',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = array();
        foreach (Division::FORM_VALIDATION as $key => $value){
            $validate_rule[$key] = $value;
        }

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $data = division::find($request->id);

        if(empty($data->id)){
            $data = new Division();
        }

        $data->fill((array)$request->all());

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data gagal simpan, coba lagi'));
        }

    }

    public function getData($id){
        return Response::json(Division::find($id));
    }

    public function indexData(Request $request){
        $datas = Division::query();

        $filter = [
            'name' => 'like',
            'status' => '='
        ];

        foreach ($filter as $key => $operator){
            if ($request->has($key) && !empty($request->$key) ) {
                if($operator == 'like'){
                    $datas->where($key,$operator,'%'.$request->$key.'%');
                } else {
                    $datas->where($key,$operator,$request->$key);
                }
            }
        }

        return DataTables::of($datas)
            ->editColumn('status',function($data) {
                return Constant::COMMON_STATUS_LIST[$data->status];
            })
            ->addColumn('aksi',function($data) {
                return '<a onclick="editData('.$data->id.')" class="btn btn-info btn-xs">Edit</a>'.' 
                    '.'<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
            })
            ->escapeColumns([])->make(true);
    }

    public function delete($id)
    {
        $delete = Division::find($id);
        $delete->deleted = 1;
        $delete->save();
    }
}
