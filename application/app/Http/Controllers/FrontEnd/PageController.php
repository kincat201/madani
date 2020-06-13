<?php

namespace App\Http\Controllers\FrontEnd;

use App\Member;
use App\User;
use Illuminate\Http\Request;
use Session;
use Validator;
use Response;

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
}



