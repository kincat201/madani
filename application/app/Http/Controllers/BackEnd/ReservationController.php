<?php

namespace App\Http\Controllers\BackEnd;

use App\Pic;
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

class ReservationController extends BackEndController
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
    public function index(Request $request)
    {
        $data['sidebar'] = 'reservation';
        $data['model'] = Reservation::class;
        return view('backend.reservation.index',$data);
    }

    public function detail($id)
    {
        $data['sidebar'] = 'reservation';
        $data['model'] = !empty($id) ? Reservation::find($id) : Reservation::class;
        return view('backend.reservation.detail',$data);
    }

    public function save(Request $request)
    {
        $validate_rule = array();
        foreach (Reservation::FORM_VALIDATION as $key => $value){
            $validate_rule[$key] = $value;
        }
        $validate_rule['userId'] = 'required';

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
            if(empty($request->status)) $data->status = Constant::RESERVATION_STATUS_NEW;
        }

        $data->fill((array) $request->all());
        $data->reservationTimeFrom = $fromTime;
        $data->reservationTimeTo = $toTime;

        if($data->save()){
            return Response::json(array('status'=>true,'message'=>'Data berhasil disimpan'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data gagal simpan, coba lagi'));
        }

    }

    public function getData($id){
        return Response::json(Reservation::find($id));
    }

    public function indexData(Request $request){
        $datas = Reservation::select('reservation.*','users.email','users.phone')
            ->join('users','users.id','=','reservation.userId','left')
            ->where('reservation.deleted', '0');

        $filter = [
            'title' => 'like',
            'room' => 'like',
            'users.phone' => 'like',
            'users.email' => 'like',
            'pic' => 'like',
            'reservationDate' => 'like',
            'status'=> '='
        ];

        foreach ($filter as $key => $operator){
            $relationFilter = explode('.',$key);
            $currentKey = $key;
            if(count($relationFilter)>1){
                $currentKey = $relationFilter[0];
            } else{
                $key = 'reservation.'.$key;
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
            ->addColumn('periode',function($data) {
                return \Carbon\Carbon::parse($data->reservationTimeFrom)->format('H:i').' - ' . \Carbon\Carbon::parse($data->reservationTimeTo)->format('H:i');
            })
            ->editColumn('room',function($data) {
                return Constant::ROOM_LIST[$data->room];
            })
            ->editColumn('food',function($data) {
                return '<label class="label label-'.Constant::FOOD_LABEL_LIST[$data->food].'">'.Constant::FOOD_LIST[$data->food].'</label>';
            })
            ->editColumn('status',function($data) {
                return '<label class="label label-'.Constant::RESERVATION_STATUS_LABEL_LIST[$data->status].'">'.Constant::RESERVATION_STATUS_LIST[$data->status].'</label>';
            })
            ->addColumn('aksi',function($data) {
                $action =  '<a href="'.route('admin.reservation.detail',['id'=>$data->id]).'" class="btn btn-info btn-xs">Detail</a>'
                    .'<a onclick="deleteData('.$data->id.')"class="btn btn-danger btn-xs">Delete</a>';
                if($data->status == Constant::RESERVATION_STATUS_NEW){
                    $action .=  '<a onclick="approveData('.$data->id.')"class="btn btn-success btn-xs">Setujui</a>'
                        .'<a onclick="rejectData('.$data->id.')"class="btn btn-warning btn-xs">Tolak</a>';
                }
                return $action;
            })
            ->escapeColumns([])->make(true);
    }

    public function delete($id){
        $delete = Reservation::find($id);
        $delete->deleted = 1;
        $delete->save();
    }

    public function download(Request $request){

        return Excel::create( 'data_Reservasi' , function($excel) use ($request) {

            $datas = Reservation::with(['user']);

            $results = [];

            foreach ($datas->get() as $key => $data){
                $data->userId = $data->user->name;
                $data->status = Constant::RESERVATION_STATUS_LIST[$data->status];
                $results[] = $data;
            }

            // Set the title
            $excel->setTitle('Data Reservasi');

            // Call them separately
            $excel->setDescription('Data Reservasi');

            $excel->sheet('Reservasi', function($sheet) use ($results) {

                // Sheet manipulation
                $sheet->loadView('backend.reservation.export-template',['model'=>Reservation::class,'datas'=> $results]);

                $sheet->setStyle(array(
                    'font' => array(
                        'name'      =>  'Times New Roman',
                        'size'      =>  12,
                    )
                ));
            });

        })
        ->download('xls');
    }

    public function approve(Request $request)
    {
        $data = Reservation::find($request->id);

        if(empty($data->id)){
            return Response::json(array('status'=>false,'message'=>'Data Reservasi tidak ditemukan'));
        }
        $data->status = $request->status;
        $data->remark = $request->remark;

        if($data->save()){
            if($request->status == Constant::RESERVATION_STATUS_APPROVED){
                NotificationService::sendNotification($data->userId,
                    'Reservasi dengan kode :  '.$data->id.' ('.Constant::RESERVATION_STATUS_LIST[Constant::RESERVATION_STATUS_APPROVED].')',
                    'Reservasi dengan kode :  '.$data->id.' ('.Constant::RESERVATION_STATUS_LIST[Constant::RESERVATION_STATUS_APPROVED].')'.' pada '.$data->updated_at. ' info lebih lengkap silahkan hubungi admin',
                    Constant::NOTIFICATION_TYPE_RESERVATION
                );
            }else if($request->status == Constant::RESERVATION_STATUS_REJECTED){
                NotificationService::sendNotification($data->userId,
                    'Reservasi dengan kode :  '.$data->id.' ('.Constant::RESERVATION_STATUS_LIST[Constant::RESERVATION_STATUS_REJECTED].')',
                    'Reservasi dengan kode :  '.$data->id.' ('.Constant::RESERVATION_STATUS_LIST[Constant::RESERVATION_STATUS_REJECTED].') karena '.$request->remark.'. pada '.$data->updated_at. ' info lebih lengkap silahkan hubungi admin',
                    Constant::NOTIFICATION_TYPE_RESERVATION
                );
            }
            return Response::json(array('status'=>true,'message'=>'Data berhasil disetujui'));
        }else{
            return Response::json(array('status'=>false,'message'=>'Data gagal disetujui, coba lagi'));
        }

    }
}
