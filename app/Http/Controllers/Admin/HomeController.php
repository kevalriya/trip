<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class HomeController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	    $this->middleware('auth:admin');
	}


    public function index()
    {
    	$totalUser=DB::select("SELECT COUNT(USER_ID) as total,USER_TYPE_CODE FROM `users` WHERE USER_TYPE_CODE IN ('USER','DRIVER')  GROUP BY USER_TYPE_CODE");

    	$totalBooking=DB::select("SELECT COUNT(BOOKING_ID) as total,STATUS FROM `tkt_booking` GROUP BY STATUS");

    	$totalFleet=DB::select("SELECT COUNT(FLEET_ID) as total FROM `fleet_registration` ");

    	$totalOperator=DB::select("SELECT COUNT(OPERATOR_CODE) as total FROM `operator` ");

    	return view('admin/home',compact('totalUser','totalFleet','totalOperator','totalBooking'));
    }
}
