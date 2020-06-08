<?php

namespace App\Http\Controllers\BackEnd;
use App\Company;
use App\Http\Controllers\Controller;
use App\Kopnit;
use App\Pic;
use App\Reservation;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use View;
use App\Config;
use App\Util\Constant;

class BackEndController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $constant = Constant::class;

    public function __construct()
    {
        $CONF = Config::find(1);
        View::share('CONF',$CONF);
        $notification = \App\Helpers\SelectHelper::getNotification();
        View::share('notification',$notification);
    }

    public function login(){
        return view('auth.backend.login');
    }

    public function dashboard(Request $request)
    {
        $data['sidebar'] = 'dashboard';
        $data['user'] = User::count();
        $data['reservation'] = Reservation::count();

        //set Asset Chart
        $periode = [];
        $currentDate = Carbon::now();
        $periode[] = [
            'periode' => $currentDate->format('M-Y'),
            'firstDay' => strtotime($currentDate->startOfMonth()),
            'lastDay' => strtotime($currentDate->endOfMonth()),
            'value' => 0,
        ];

        for($i=1;$i<=12;$i++){
            $currentDate = Carbon::now()->subMonths($i);
            $periode[] = [
                'periode' => $currentDate->format('M-Y'),
                'firstDay' => strtotime($currentDate->startOfMonth()),
                'lastDay' => strtotime($currentDate->endOfMonth()),
                'value' => 0,
            ];
        }

        foreach (Reservation::get() as $pic){
            $picDate = strtotime($pic->created_at);

            foreach($periode as $key => $prd){
                if(($picDate >= $prd['firstDay'])&&($picDate <= $prd['lastDay'])){
                    $periode[$key]['value']++;
                }
            }
        }

        $data['chart'] = array_reverse($periode,true);

        return view('backend.pages.dashboard',$data);
    }
}
