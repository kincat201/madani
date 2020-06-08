<?php

namespace App\Http\Controllers\BackEnd;
use App\City;
use App\District;
use App\Http\Controllers\Controller;

use App\Config;
use App\Province;
use App\Util\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Validator;
use Response;
use Input;

class SettingController extends BackEndController
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
        $data['sidebar'] = 'general';
        $data['model'] = Config::find(1);
        return view('backend.setting.detail',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = Config::FORM_VALIDATION_DETAIL;
        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $config = Config::find($request->idSetting);
        $logoImage = $config->logo;
        $logoSecondImage = $config->logoSecond;
        $iconImage = $config->icon;
        $contactImage = $config->contactBanner;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            if(!empty($logoImage) && file_exists('storage/'.$logoImage)){
                unlink('storage/'.$logoImage);
            }
            $logoImage = $logo->store('config','public');
        }

        if ($request->hasFile('logoSecond')) {
            $logoSecond = $request->file('logoSecond');
            if(!empty($logoSecondImage) && file_exists('storage/'.$logoSecondImage)){
                unlink('storage/'.$logoSecondImage);
            }
            $logoSecondImage = $logoSecond->store('config','public');
        }

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            if(!empty($iconImage) && file_exists('storage/'.$iconImage)){
                unlink('storage/'.$iconImage);
            }
            $iconImage = $icon->store('config','public');
        }

        $config->fill((array)$request->all());
        $config->logo = $logoImage;
        $config->logoSecond = $logoSecondImage;
        $config->icon = $iconImage;

        if($config->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data Gagal simpan, coba lagi'));
        }
    }
}
