<?php

namespace App\Http\Controllers\FrontEnd;

use App\Reservation;
use App\Service\NotificationService;
use App\Util\Constant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use Response;
use Input;
use Excel;

class ReservationController extends FrontEndController
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

    public function reservationDetail($id)
    {
        $data['sidebar'] = 'reservation';
        $data['model'] = !empty($id) ? Reservation::find($id) : Reservation::class;
        return view('frontend.pages.reservation',$data);
    }

    public function reservationSave(Request $request)
    {
        $validate_rule = array();
        foreach (Reservation::FORM_VALIDATION as $key => $value) {
            $validate_rule[$key] = $value;
        }

        $validation = Validator::make($request->all(),$validate_rule);

        if($validation->fails()){
            $data['status'] = false;
            $data['message'] = 'Periksa Data Kembali!';
            $data['error'] = $validation->errors();

            return response()->json($data);
        }

        $fromTime = $request->reservationTimeFrom;
        $fromTime = explode(':',$fromTime)[0] < 10 ? '0'.$fromTime : $fromTime;
        $request->reservationTimeFrom = $fromTime;
        $toTime = $request->reservationTimeTo;
        $toTime = explode(':',$toTime)[0] < 10 ? '0'.$toTime : $toTime;
        $request->reservationTimeTo = $toTime;

        $check = Reservation::where('room',$request->room)
            ->where('reservationDate',$request->reservationDate)
            ->where(function($query) use($fromTime,$toTime){
                $query->where('reservationTimeFrom','>=',$fromTime);
                $query->orWhere('reservationTimeTo','>=',$fromTime);
            })
            ->where('reservationTimeTo','<=',$toTime);

        if(!empty($request->id)) $check->where('id','!=',$request->id);

        if($check->count() > 0) {
            $data['status'] = false;
            $data['message'] = 'Sudah ada reservasi di ruangan, tanggal dan waktu tersebut!';
            return response()->json($data);
        }

        $data = Reservation::find($request->id);

        if(empty($data->id)){
            $data = new Reservation();
            $data->status = Constant::RESERVATION_STATUS_NEW;
        }
        $data->userId = \Auth::user()->id;

        $data->fill((array) $request->all());
        $data->reservationTimeFrom = $fromTime;
        $data->reservationTimeTo = $toTime;

        if($data->save()){
            NotificationService::sendNotification(0,
                'Reservasi : '.$data->userId.'/'.$data->id,
                'Pengajuan baru oleh member '.$data->user->name.' untuk reservasi',
                Constant::NOTIFICATION_TYPE_RESERVATION);
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data gagal simpan, coba lagi'));
        }

    }

    public function reservationDelete($id){
        $delete = Reservation::find($id);
        $delete->deleted = 1;
        $delete->save();
    }
}
