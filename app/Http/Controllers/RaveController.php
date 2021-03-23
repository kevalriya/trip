<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use the Rave Facade
use Rave;
use DB;
class RaveController extends Controller
{

  /**
   * Initialize Rave payment process
   * @return void
   */
  public function initialize(Request $request)
  {

    //This initializes payment and redirects to the payment gateway
    //The initialize method takes the parameter of the redirect URL
    Rave::initialize(route('callback'));
  }

  /**
   * Obtain Rave callback information
   * @return void
   */
  public function callback()
  {
  	
  	$Data=json_decode(request()->resp);
  
  	//status] => success [
  	//@$txRef=$Data->data->transactionobject->txRef;
  	@$txRef=$Data->data->data->txRef;

  	if(!isset($txRef) || empty($txRef)){

  		die('Something went wrong');
  	}

  	$bookingId=$txRef;
    $data = Rave::verifyTransaction($txRef);
   
    if($data->status == 'success'){

  	DB::table('tkt_booking')->where('BOOKING_ID',$bookingId)->update(
    [
   	'STATUS'=> 'PAID',
	'PAYMENT_STATUS'=> 'PAID',
    ]
   );
   
        return redirect(route('successpay'));
    }
    else{
    DB::table('tkt_booking')->where('BOOKING_ID',$bookingId)->delete();
   
     return redirect(route('unsuccesspay'));
     }
   }
}
