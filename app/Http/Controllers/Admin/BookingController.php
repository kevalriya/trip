<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Booking;
use Illuminate\Http\Request;
use DataTables;
class BookingController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('admin.booking');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $Booking=Booking::with(['user','bus','trip','bookingDetails'])->find($id); 
       return view('admin.viewBooking',compact('Booking'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

     $this->validate($request,[
            'status' => 'required',
          
        ]);

 
     $data=[
     'status' => $request->status, 
     ];

    $Booking = Booking::where('BOOKING_ID',$id)->update($data);
        
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

    $Booking = Booking::whereIn('BOOKING_ID',$request->booking)->update($data);
        
          return $this->outputResponse(1, [], [
                'status' => 1,
                'message'=>'Success'
            ]);
    }


       public function Lists(Request $request){
        

        if ($request->ajax()) {

            $data=Booking::with(['user','bus','trip'])->get();

            return DataTables::of($data)
                ->addColumn('check', function($row){

                   return '<input type="checkbox" name="bookingstatus" class="booking_chk" value="'.$row->BOOKING_ID.'">';

                    })
                  ->addColumn('booking',function ($data){
                     return '<a href="'.route("booking.show",$data->BOOKING_ID).'">'.$data->BOOKING_ID.'</a>';
 
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

                    $btn= '<a href="'.route("booking.show",$row->BOOKING_ID).'"> <span class="glyphicon glyphicon glyphicon glyphicon-th-list"></span></a>';
                            return $btn;
                    })
                    ->rawColumns(['booking','action','check'])
                    ->make(true);
        }
         
    }

   
}
