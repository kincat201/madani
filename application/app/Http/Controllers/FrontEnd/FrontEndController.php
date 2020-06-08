<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;

use View;
use App\Config;
use Session;

class FrontEndController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $CONF = Config::find(1);
        View::share('CONF',$CONF);
    }
}
