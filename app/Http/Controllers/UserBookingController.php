<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Booking;
use Illuminate\Http\Request;
use Auth;
use DataTables;
class UserBookingController extends Controller
{ 
   
  

   public function index()
    {
        
        return view('front.user-profile-booking-history');
    }

    public function show($id)
    {
       $Booking=Booking::with(['user','bus','trip','bookingDetails'])->where('USER_ID',Auth::user()->USER_ID)->find($id); 
       if(!$Booking){
        die('No Booking Found');
       }
      
       return view('front.viewBooking',compact('Booking'));

    }


    public function update(Request $request, $id)
    {

     $this->validate($request,[
            'status' => 'required',
          
        ]);

 
     $data=[
     'status' => $request->status, 
     ];

    $Booking = Booking::where('BOOKING_ID',$id)->where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->update($data);
        
          return $this->outputResponse(1, [], [
                'status' => 1,
                'message'=>'Success'
            ]);
    } 

    public function updateMultiBooking(Request $request)
    {

     $this->validate($request,[
            'status' => 'required',
            'booking' => 'required|array',
        ]);

 
     $data=[
     'status' => $request->status, 
     ];

    $Booking = Booking::whereIn('BOOKING_ID',$request->booking)->where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->update($data);
        
          return $this->outputResponse(1, [], [
                'status' => 1,
                'message'=>'Success'
            ]);
    }


       public function Lists(Request $request){
        

        if ($request->ajax()) {

            $data=Booking::with(['bus','trip'])->where('USER_ID',Auth::user()->USER_ID)->get();

            return DataTables::of($data)
                
                  ->addColumn('booking',function ($data){
                     return '<a href="'.route("showubooking",$data->BOOKING_ID).'">'.$data->BOOKING_ID.'</a>';
 
                 }) ->addColumn('processed_date',function ($data){
                     return $data->PROCESSED_DATE ;
                 })  ->addColumn('fleet',function ($data){
                     return  $data->bus->FLEET_NAME; ;
                 })  ->addColumn('trip',function ($data){
                     return $data->trip->TRIP_NAME ;
                 })  ->addColumn('route',function ($data){
                     return $data->route->ROUTE_NAME ;
                 })  ->addColumn('boarding',function ($data){
                     return $data->BOARDING_POINT ;
                 })  ->addColumn('drop_off',function ($data){
                     return $data->DROPOFF_POINT ;
                 })  ->addColumn('status',function ($data){
                     return $data->STATUS ;
                 })
                 ->addColumn('action', function($row){

                    $btn= '<a href="'.route("showubooking",$row->BOOKING_ID).'"> <span class="glyphicon glyphicon glyphicon glyphicon-th-list"></span></a>';
                            return $btn;
                    })
                    ->rawColumns(['booking','action'])
                    ->make(true);
        }
         
    }

   
}
