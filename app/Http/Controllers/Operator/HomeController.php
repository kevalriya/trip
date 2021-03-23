<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
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
	    $this->middleware('auth:operator');
	}


     public function index()
    {
    	$operatorId=Auth::guard('operator')->user()->OPERATOR_CODE;
    
    	$totalBooking=DB::select("SELECT COUNT(BOOKING_ID) as total,STATUS FROM `tkt_booking`  WHERE OPERATOR_CODE='$operatorId' GROUP BY STATUS");

    	$totalFleet=DB::select("SELECT COUNT(FLEET_ID) as total FROM `fleet_registration` WHERE OPERATOR_CODE='$operatorId' ");


    	return view('operator/home',compact('totalFleet','totalBooking'));
    }
}
