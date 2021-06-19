<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Amenitie;
use App\Model\Operator;
use App\Model\Trip;
use App\Model\Triptime;
use App\Model\Routepoint;
use App\Model\Booking;
use App\Model\Salutation;
use App\Model\City;
use App\Model\State;
use App\Model\Country;
use App\Model\Seat;
use App\Model\LGA;
use DB;
use Auth;
class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $Amenities=Amenitie::orderBy('AMENITY_NAME', 'ASC')->get();
      $cityArr=array('ABJ','ONT','CAL','BNC');
      $Cities=City::whereIn('CITY_CODE',$cityArr)->get();
      $Operators=Operator::where('ACTIVE_INDICATOR', 'Y')->where('FLEET_PHOTO', '>', 0)->limit(8)->get();
      $cityImg=array();
      foreach ($Cities as $City) {
        $cityImg[$City->CITY_CODE]=$City->CITY_PHOTO;
      }
      
      return view('front.home', ['operators'=>$Operators], compact('Amenities','cityImg'));
    }

   public function seatMap(Request $request)
    {

      $Seat=DB::table('seatmap_library')->where('SEATMAP_LIB_CODE',$request->seat)->first();
      $SeatLibs=Seat::where('SEATMAP_LIB_CODE',$request->seat)->get();
      $Bookings=Booking::leftjoin('tkt_booking_details', 'tkt_booking_details.BOOKING_ID', '=', 'tkt_booking.BOOKING_ID')->where('tkt_booking.TRIP_ID',$request->trip_id)->where('tkt_booking.ROUTE_ID',$request->route_id)->where('tkt_booking.PROCESSED_DATE','>=',$request->startDate)->select(['tkt_booking_details.PASSENGER_SEATNO'])->get();
      $uid=$request->uid; 
       $SeatArr=array();
       foreach ($SeatLibs as $SeatLib) {
            $SeatArr[$SeatLib->SEAT_NAME]= array('type'=>$SeatLib->SEATTYPE,'id'=> $SeatLib->SEAT_ID);
       }
       $BookArr=array();
       foreach ($Bookings as $Book) {
            $BookArr[]=$Book->PASSENGER_SEATNO;
       }

        return view('front.seat',compact('Seat','SeatArr','uid','BookArr'));
    }

   public function busBooking(Request $request)
    { 
     
      if($request->has('trip_id')){
        $operator=$request->operator_id;
        $TRIP=Trip::where('TRIP_ID',$request->trip_id)->first();
        return view('front.bus-booking',compact('TRIP','operator'));

      }
      else{
        return 'No direct allowed';
      }

      
    }
    
   public function routeDetail(Request $request)
    {
  
    $busId=$request->busid;
    $Trip=$request->trip;
    $routeid=$request->routeid;
    $toId=$request->toid;
    $fromtxt=$request->fromtxt;
    $totxt=$request->totxt;

    $Routepoints=Routepoint::join('city', 'city.CITY_CODE', '=', 'route_stoppoint.CITY_CODE')->where('ROUTE_ID', $routeid)->select('route_stoppoint.*','city.CITY_NAME','city.STATE_CODE')->orderBy('ROUTE_STOPPOINT_SEQNO','ASC')->get();


        $Triptimes=Triptime::where('TRIP_ID',$Trip)
            ->where('ROUTE_ID',$routeid)
            ->orderBy('id','ASC')
            ->get(); 
        $Times=array();
        foreach ($Triptimes as $Triptime) {
                $Times[$Triptime->CITY_CODE]=array('ARRIVAL_TIME'=>$Triptime->ARRIVAL_TIME,'DEPARTURE_TIME'=>$Triptime->DEPARTURE_TIME);
            }  
           return view('front.route-detail',compact('busId','routeid','toId','fromtxt','totxt','Routepoints','Times'));
    }

   
    public function faq()
    {
       $Faqs=DB::table('faq')->offset(0)->limit(20)->get();
        return view('front.faq',compact('Faqs'));
    }

    public function changePassword()
    {
      
        return view('front.change-password');
    }
    
    public function profileSetting()
    {
        $User=DB::table('users')->where('USER_ID',Auth::user()->USER_ID)->first();
        $Cities=City::where('STATE_CODE',$User->STATE_CODE)->orderBy('CITY_NAME','ASC')->get();
        $States=State::where('COUNTRY_ID',73)->orderBy('NAME','ASC')->get();
        $Countries=Country::where('COUNTRY_ID',73)->orderBy('COUNTRY_NAME', 'ASC')->first();
        $LGAS=LGA::where('STATE_CODE',$User->STATE_CODE)->orderBy('LGA_NAME','ASC')->get();
        $Salutations=Salutation::all();
        
        return view('front.user-profile-settings',compact('User','Cities','States','Countries','LGAS','Salutations'));
    }

    public function searchResult()
    {   
        $Amenities=Amenitie::orderBy('AMENITY_NAME', 'ASC')->offset(0)->limit(20)->get();
        $busTypes = DB::table('fleet_type')->offset(0)->limit(20)->get();
        $Operators=Operator::where('ACTIVE_INDICATOR','Y')->offset(0)->limit(20)->orderBy('OPERATOR_LEGAL_NAME', 'ASC')->get();

        return view('front.searchResult',compact('Amenities','busTypes','Operators'));
    }

    
   public function searchRes(Request $request)
    {   

 
  $pickup_id=$this->escape_string($request->pickup_id);
  $return_id=$this->escape_string($request->return_id);
  
  $pickup_text=$this->escape_string($request->fromtxt);
  $return_text=$this->escape_string($request->totxt);
  $date=$this->escape_string($request->dpdate);
  $busTypes=(isset($request->busTypes)) ? $request->busTypes : null;
  $classtype=(isset($request->classtype)) ? $request->classtype : null ;
  $isreturn=$this->escape_string($request->isreturn);
  $isback=(isset($request->isback)) ? 'Y' : 'N';
  $operatorId=(isset($request->operator)) ? $request->operator : null ;

  $dptime=(isset($request->dptime)) ? $request->dptime : null ;
  $price=(isset($request->price)) ? $request->price : null ;
  $passengerid=(isset($request->passengerid)) ? $request->passengerid : 0 ;
  $Url= ($isreturn == 'T') ? "return-search" : route('busBooking');
  $day_of_week = strtolower(date('l', strtotime($date)));
     
 

    $sql="(trip.fromDate <= '$date' AND '$date' <= trip.toDate) AND (trip.recurring LIKE '%$day_of_week%') AND (trip.ROUTE_ID IN(SELECT r.ROUTE_ID FROM `route` AS r WHERE (r.ORIGIN_CITY = '$pickup_id' AND r.DEST_CITY = '$return_id' ) ))";

       if(isset($request->amenitie) && count($request->amenitie) > 0 ){

     $amenities=$request->amenitie;
  

  $condition = implode(" OR ", array_map(function($amenitie) {
    $am= '"' .$amenitie. '"';
    return "JSON_CONTAINS(f.amenities,  '[$am]')";
    
}, $amenities));

   $sql.= " AND (trip.FLEET_REG_ID IN (SELECT f.FLEET_ID FROM `fleet_registration` as f WHERE  (".$condition." ) ))";

  }

        if(isset($request->busTypes) && count($request->busTypes) > 0 ){
  $busTypearr = implode("','", $request->busTypes);
  $sql .= " AND (trip.FLEET_REG_ID IN (SELECT fl.FLEET_ID FROM `fleet_registration` as fl WHERE fl.FLEET_TYPE_CODE IN ('".$busTypearr."') )) ";
    
  }  
  

  if(isset($request->operator)){
    
   $operatorIdar = implode("','", $request->operator);
  $sql .= " and trip.OPERATOR_CODE IN ('".$operatorIdar."') ";
  }

   if(isset($request->price)){
  
  $p = explode(";", $price);
  $sql .= " AND trip.FARE BETWEEN '$p[0]' AND '$p[1]' ";
  }

  $BusesRoutes=Trip::leftjoin('operator', 'operator.OPERATOR_CODE', '=', 'trip.OPERATOR_CODE')->whereRaw($sql)->select(['trip.*','operator.OPERATOR_LEGAL_NAME','operator.FLEET_PHOTO'])->offset(0)->limit(30)->get();
   $RouteIds=array(); 
   $TripIds=array(); 
    $Times=array();
   $RoutepointData=array();
    if(count($BusesRoutes) > 0 ){
    foreach ($BusesRoutes as $Route) {
      $RouteIds[]=$Route['ROUTE_ID'];
      $TripIds[]=$Route['TRIP_ID'];

      $Bookings=Booking::leftjoin('tkt_booking_details', 'tkt_booking_details.BOOKING_ID', '=', 'tkt_booking.BOOKING_ID')->where('tkt_booking.TRIP_ID',$Route['TRIP_ID'])->where('tkt_booking.ROUTE_ID',$Route['ROUTE_ID'])->where('tkt_booking.PROCESSED_DATE','>=',$date)->select(['tkt_booking_details.PASSENGER_SEATNO'])->get()->toArray();
      $Route->seat_left = $Route->max_seat - sizeof($Bookings);
    }

  $Routepoints=Routepoint::join('city', 'city.CITY_CODE', '=', 'route_stoppoint.CITY_CODE')->whereIn('ROUTE_ID', $RouteIds)->select('route_stoppoint.*','city.CITY_NAME','city.STATE_CODE')->orderBy('ROUTE_STOPPOINT_SEQNO','ASC')->get()->toArray();

  foreach ($Routepoints as $Point) {
      $RoutepointData[$Point['ROUTE_ID']][]=$Point;
    }


      $Triptimes=Triptime::whereIn('TRIP_ID',$TripIds)
            ->orderBy('id','ASC')
            ->get(); 
       

        foreach ($Triptimes as $Triptime) {
                $Times[$Triptime->TRIP_ID][$Triptime->ROUTE_ID][]=array('ARRIVAL_TIME'=>$Triptime->ARRIVAL_TIME,'DEPARTURE_TIME'=>$Triptime->DEPARTURE_TIME);
            } 

  }

 


   return view('front.searchres',compact('BusesRoutes','RoutepointData','date','isback','pickup_id','return_id','pickup_text','return_text','passengerid','Url','Times'));
 }



  public function bookingLists(Request $request){
        
        if(empty($request->search['value']) ) {  

  $Bookings=Booking::leftjoin('trip', 'trip.TRIP_ID', '=', 'tkt_booking.TRIP_ID')
            ->leftjoin('operator', 'operator.OPERATOR_CODE', '=', 'trip.OPERATOR_CODE')->select(['tkt_booking.*','operator.OPERATOR_LEGAL_NAME'])->where('USER_ID',Auth::user()->USER_ID)->offset($request->start)->limit($request->length)->get();
  $cTotal=Booking::count();
   }
    else{
    $Bookings=Booking::leftjoin('trip', 'trip.TRIP_ID', '=', 'tkt_booking.TRIP_ID')
    
            ->leftjoin('operator', 'operator.OPERATOR_CODE', '=', 'trip.OPERATOR_CODE')->select(['tkt_booking.*','operator.OPERATOR_LEGAL_NAME'])->where('BOARDING_POINT','like', '%' .$request->search['value']. '%')->where('USER_ID',Auth::user()->USER_ID)->offset($request->start)->limit($request->length)->get();;
 
  $cTotal=Booking::where('BOARDING_POINT','like', '%' .$request->search['value']. '%')->count();
    }

      $data=array();
         foreach($Bookings as $row)
         {
          
          
             $sub_array = array();
                
             $sub_array[] = $row->BOOKING_ID;
             $sub_array[] = '-';
             $sub_array[] = $row->OPERATOR_LEGAL_NAME;
             $sub_array[] = $row->CREATE_DT;
             $sub_array[] = $row->SEAT_NUMBERS;
             $sub_array[] = $row->BOARDING_POINT;
             $sub_array[] = $row->DROPOFF_POINT;
             $sub_array[] = $row->PRICE;
             $sub_array[] = $row->PROCESSED_DATE;
             $sub_array[] = $row->PAYMENT_METHOD;
             $sub_array[] = $row->STATUS;
             $sub_array[] = '';
             $data[] = $sub_array;
             }
                
             $output = array(
             "draw"    => intval($request->draw),
             "recordsTotal"  => count($Bookings),
             "recordsFiltered" =>  $cTotal,
             "data"    => $data,
            
            );

             return json_encode($output);
         
    }


 public function escape_string($data) {
  $data = trim(htmlentities(strip_tags($data)));
  return $data;
 }
}
