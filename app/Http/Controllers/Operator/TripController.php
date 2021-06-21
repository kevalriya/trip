<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Operator;
use App\Model\Fleet;
use App\Model\Route;
use App\Model\Trip;
use App\Model\Fare;
use App\Model\Routepoint;
use App\Model\Triptime;
use App\Model\State;
use App\Model\City;
use App\Tab;
use DB;
use Auth;
use DataTables;
class TripController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Tab::where('id',8)->get();
        return view('operator.trip', ['data'=>$data]);
    }

   public function tripScheduler()
    {
        
        return view('operator.tripschedule');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Fleets=Fleet::where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->get();
        $Routes=Route::where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->get();  
        $Drivers=User::where('ACTIVE_INDICATOR','Y')->where('USER_TYPE_CODE','DRIVER')->where('ACTIVE_INDICATOR','Y')->orderBy('FIRSTNAME', 'ASC')->get();
        $data=Tab::where('id',9)->get();
        return view('operator.addTrip',compact('Fleets','Routes','Drivers'), ['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {


        $this->validate($request,[
            'trip_name' => 'required|string|max:255|unique:trip,TRIP_NAME',
            'fleet' => 'required',
            'route' => 'required',
            'driver' => 'required',
            'seat' => 'required',
            'fare' => 'required',
           
        ]);

        if(isset($request->recurring)){
           $recurring= implode(",",$request->recurring);
        }
        else{
             $recurring= "";
        }


        $Data=[
            'TRIP_NAME' =>  $request->trip_name,
            'ROUTE_ID' => $request->route,
            'OPERATOR_CODE' => Auth::guard('operator')->user()->OPERATOR_CODE,
            'FLEET_REG_ID' =>$request->fleet ,
            'DRIVER_ID' => $request->driver,
            'fromDate' => $request->from_date,
            'toDate' => $request->to_date,
            'SEATMAP_LIB_CODE' => $request->seat,
            'max_seat' => $request->max_seat,
            'FARE' => $request->fare,
            'recurring' => $recurring,
           

        ];
   
       $Trip= Trip::create($Data);
     

      
      return redirect(route('opeditTripTime',$Trip->TRIP_ID));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
       $Fleets=Fleet::where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->get();
       $Trip=Trip::where('TRIP_ID',$id)->where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->first();
       if(!$Trip){
        abort(403, 'Unauthorized action.');

       }
      $Routes=Route::where('OPERATOR_CODE',$Trip->OPERATOR_CODE)->with(['operator'])->get();
      $RoutePoint=Routepoint::join('city', 'city.CITY_CODE', '=', 'route_stoppoint.CITY_CODE')->where('ROUTE_ID',$Trip->ROUTE_ID)->orderBy('ROUTE_STOPPOINT_SEQNO', 'ASC')->select(['route_stoppoint.*','city.CITY_NAME'])->get()->toArray();

        $Seat=DB::table('seatmap_library')->where('SEATMAP_LIB_CODE', $Trip->SEATMAP_LIB_CODE)->first();
        $Drivers=User::where('ACTIVE_INDICATOR','Y')->where('USER_TYPE_CODE','DRIVER')->where('ACTIVE_INDICATOR','Y')->orderBy('FIRSTNAME', 'ASC')->get();
        $FarePrices=Fare::where('TRIP_ID',$Trip->TRIP_ID)
            ->where('ROUTE_ID',$Trip->ROUTE_ID)
            ->get(); 
        $Fares=array();
        foreach ($FarePrices as $Price) {
                $Fares[$Price->STOPPOINTSTART][$Price->STOPPOINTEND]=array('FAREADULT'=>$Price->FAREADULT,'FARECHILD'=>$Price->FARECHILD,'FARESPECIAL'=>$Price->FARESPECIAL );
            }  
            $data=Tab::where('id',30)->get();
        return view('operator.editTrip',compact('Routes','Fleets','Trip','RoutePoint','Fares','Seat','Drivers'), ['data'=>$data]);
    }

    public function editTripFare($id)
    {
      
       $Trip=Trip::where('TRIP_ID',$id)->where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->first();
      $RoutePoint=Routepoint::join('city', 'city.CITY_CODE', '=', 'route_stoppoint.CITY_CODE')->where('ROUTE_ID',$Trip->ROUTE_ID)->orderBy('ROUTE_STOPPOINT_SEQNO', 'ASC')->select(['route_stoppoint.*','city.CITY_NAME'])->get()->toArray();

        $FarePrices=Fare::where('TRIP_ID',$Trip->TRIP_ID)
            ->where('ROUTE_ID',$Trip->ROUTE_ID)
            ->get(); 
        $Fares=array();
        foreach ($FarePrices as $Price) {
                $Fares[$Price->STOPPOINTSTART][$Price->STOPPOINTEND]=array('FAREADULT'=>$Price->FAREADULT,'FARECHILD'=>$Price->FARECHILD,'FARESPECIAL'=>$Price->FARESPECIAL );
            }  
            $data=Tab::where('id',33)->get();
        return view('operator.tripFare',compact('Trip','RoutePoint','Fares'), ['data'=>$data]);
    }

    public function editTripTime($id)
    {

      $Trip=Trip::where('TRIP_ID',$id)->where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->first();
     
      $Route=Route::where('ROUTE_ID',$Trip->ROUTE_ID)->first();

        $States=State::orderBy('NAME','ASC')->get();
         $Cities=City::all();
      $RoutePoint=Routepoint::join('city', 'city.CITY_CODE', '=', 'route_stoppoint.CITY_CODE')->where('ROUTE_ID',$Trip->ROUTE_ID)->orderBy('ROUTE_STOPPOINT_SEQNO', 'ASC')->select(['route_stoppoint.*','city.CITY_NAME'])->get()->toArray();

        $Triptimes=Triptime::where('TRIP_ID',$Trip->TRIP_ID)
            ->where('ROUTE_ID',$Trip->ROUTE_ID)
            ->get(); 
        $Times=array();
        foreach ($Triptimes as $Triptime) {
                $Times[$Triptime->CITY_CODE]=array('ARRIVAL_TIME'=>$Triptime->ARRIVAL_TIME,'DEPARTURE_TIME'=>$Triptime->DEPARTURE_TIME);
            }  
            $data=Tab::where('id',32)->get();
       return view('operator.tripTime',compact('Route','Trip','RoutePoint','Times','States','Cities'), ['data'=>$data]);
    }

    public function editTripschedule($id)
    {
      
    $Trip=Trip::where('TRIP_ID',$id)->first();
   $data=Tab::where('id',31)->get();
       return view('operator.tripSchedule',compact('Trip'), ['data'=>$data]);
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
            'trip_name' => 'required|string|max:255|unique:trip,TRIP_NAME,'.$id.',TRIP_ID',
            'fleet' => 'required',
            'route' => 'required',
            'driver' => 'required',
            'seat' => 'required',
            'fare' => 'required',
           
        ]);

         
        $Data=[
            'TRIP_NAME' =>  $request->trip_name,
            'OPERATOR_CODE' => Auth::guard('operator')->user()->OPERATOR_CODE,   
            'ROUTE_ID' => $request->route,
            'FLEET_REG_ID' =>$request->fleet ,
            'DRIVER_ID' => $request->driver,
            'SEATMAP_LIB_CODE' => $request->seat,
            'max_seat' => $request->max_seat,
            'FARE' => $request->fare,
           
        ];

        Trip::where('TRIP_ID',$id)->update($Data);


      return redirect(route('operator.trip.edit',$id))->with('success', ['Update Success']);

      
    }

    public function updateTripschedule(Request $request, $id)
    {
      
    if(isset($request->recurring)){
           $recurring= implode(",",$request->recurring);
        }
        else{
             $recurring= "";
        }
        $status= ($request->status == '1') ? 1 : 0;
        $dep_time= $request->hour.':'.$request->min.':00'.$request->ampm;
        $dep_time= date('Y-m-d').' '.$dep_time;
        $dep_time= date('H:i',strtotime($dep_time));
        $Data=[
           
            'fromDate' => $request->from_date,
            'toDate' => $request->to_date,
            'STATUS' =>  $status,
            'Frequency' => $request->frq,
            'recurring' => $recurring,
            'ACTUAL_DEP_TIME' => $dep_time, 
           
        ];
      
        Trip::where('TRIP_ID',$id)->update($Data);
       
      return redirect(route('opeditTripschedule',$id))->with('success', ['Update Success']);

      
    }

    public function updateTripFare(Request $request, $id)
    {
          $this->validate($request,[
            'route' => 'required',
            
        ]);

      
       Fare::where('TRIP_ID',$id)
            ->where('ROUTE_ID',$request->oldRoute)
            ->delete(); 
        foreach ($request->adult as $key => $value) {

        $fromEnd=explode('_', $key);
        $from=$fromEnd[0];
        $end=$fromEnd[1];
         $adultPrice= $request->adult[$key];
         $childPrice=$request->child[$key];
         $specialPrice=$request->special[$key];
         $data=[
            'TRIP_ID'=> $id,
            'ROUTE_ID'=> $request->route,
            'STOPPOINTSTART'=> $from,
            'STOPPOINTEND' => $end,
            'FAREADULT' => $adultPrice,
            'FARECHILD' => $childPrice,
            'FARESPECIAL' => $specialPrice,
         ];

         Fare::create($data);
       }

      return redirect(route('opeditTripFare',$id))->with('success', ['Update Success']);

      
    }

    public function updateTripTime(Request $request, $id)
    {
          $this->validate($request,[
            'route' => 'required',
            'TRIP_ID' => 'required|exists:trip,TRIP_ID,OPERATOR_CODE,'.Auth::guard('operator')->user()->OPERATOR_CODE,
            
        ]);

       $cityArr=$request->city;
        $routeId= $request->route;

       Triptime::where('TRIP_ID',$id)
            ->where('ROUTE_ID',$routeId)
            ->delete(); 
        
          if(count($cityArr) > 0 ){
            $data=array();
            foreach ($cityArr as $key => $City) {
               $arr=$request->arr[$key];
               $dep=$request->dep[$key];
            
              
               if(!empty($City) ){
               $data=array(
                'TRIP_ID' => $id,
                'ROUTE_ID' => $routeId,
                'CITY_CODE' => $City,
                'ARRIVAL_TIME' => $arr,
                'DEPARTURE_TIME' => $dep,
               );
              
                 Triptime::create($data);
              }

            }

      return redirect(route('opeditTripTime',$id))->with('success', ['Update Success']);

      
    }
  }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }



       public function tripLists(Request $request){
        

        if ($request->ajax()) {
           
            $data=Trip::where('trip.OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->leftjoin('route', 'route.ROUTE_ID', '=', 'trip.ROUTE_ID')
            ->leftjoin('fleet_registration', 'fleet_registration.FLEET_ID', '=', 'trip.FLEET_REG_ID')
           ->select(['trip.*','fleet_registration.FLEET_NAME','route.ROUTE_NAME'])->get();

            
            return DataTables::of($data)
                  ->addColumn('trip_id',function ($data){
                     return $data->TRIP_ID ;
                 })  ->addColumn('route_name',function ($data){
                     return  $data->ROUTE_NAME; ;
                 })  ->addColumn('fare',function ($data){
                     return $data->FARE ;
                 })  ->addColumn('reg_id',function ($data){
                     return $data->FLEET_REG_ID ;
                 })  ->addColumn('dep_time',function ($data){
                     return (isset( $data->ACTUAL_DEP_TIME)) ? date('H:i',strtotime($data->ACTUAL_DEP_TIME)) : '' ;
                 })  ->addColumn('max_seat',function ($data){
                     return $data->max_seat ;
                 })  ->addColumn('status',function ($data){
                     if($data->STATUS == '1'){
                $status='<span class="label label-success">Active</span>';
                    }
                    else{
                        $status='<span class="label label-danger">Inactive</span>';
                    }
                     return $status ;
                 })
                 ->addColumn('action', function($row){

                     $frm=' <form id="delete-form-'.$row->TRIP_ID.'" method="post" action="'.route("operator.trip.destroy",$row->TRIP_ID).'" style="display: none">'.csrf_field(). method_field("DELETE").'</form>';
            $onclick    = "if(confirm('Are you sure, You Want to delete this?')){event.preventDefault();document.getElementById('delete-form-".$row->TRIP_ID."').submit(); }else{event.preventDefault();}";
                    $btn= '<a href="'.route("operator.trip.edit",$row->TRIP_ID).'"> <span class="glyphicon glyphicon-edit"></span></a>&nbsp; <a href="'.route('opeditTripTime',$row->TRIP_ID).'" class="btn btn-xs btn-warning"> <span class="glyphicon glyphicon-th-large"></span></a>&nbsp;'.$frm.' <a href="" class="btn btn-xs btn-danger" onclick="'.$onclick.'" ><span class="glyphicon glyphicon-trash"></span></a>';
        
                            return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }
         
    }

     public function scheduleLists(Request $request){
        
    
        $Sql="SELECT (SELECT DEPARTURE_TIME FROM trip_timing as tmd WHERE tmd.TRIP_ID=`TRIP_ID` AND tmd.ROUTE_ID=`ROUTE_ID` ORDER BY tmd.id ASC LIMIT 1 ) AS departure,(SELECT ARRIVAL_TIME FROM trip_timing as tm WHERE tm.TRIP_ID=`TRIP_ID` AND tm.ROUTE_ID=`ROUTE_ID` ORDER BY tm.id DESC LIMIT 1 ) AS arrival,route.ROUTE_NAME FROM `trip_timing` LEFT JOIN route ON route.ROUTE_ID=trip_timing.ROUTE_ID ";
        if($request->has('date')){
            $TripIds=$this->getTripIdByDate($request->date);
            $tripIdarr = implode("','", $TripIds);

            $Sql.=" WHERE trip_timing.TRIP_ID  IN ('" .$tripIdarr."') ";
        }

  
       $mainsql=$Sql;

       $Sql.="  GROUP by trip_timing.TRIP_ID,trip_timing.ROUTE_ID  LIMIT ".$request->start .", ".$request->length;
         $Trips=DB::select($Sql);

      $data=array();
         foreach($Trips as $row)
         {
           
             $sub_array = array();
            
             $sub_array[] = $row->ROUTE_NAME;
             $sub_array[] = $row->departure;
             $sub_array[] = $row->arrival;
           
           
             $data[] = $sub_array;
             }
                
             $output = array(
             "draw"    => intval($request->draw),
             "recordsTotal"  => count($Trips),
             "recordsFiltered" => count(DB::select($mainsql)),
             "data"    => $data,
            
            );

             return json_encode($output);
         
    }


    private function getTripIdByDate($date)
    {   
        $day_of_week = strtolower(date('l', strtotime($date)));
        $sql="SELECT * FROM `trip` WHERE (fromDate <= '$date' AND '$date' <= toDate) AND concat(',',recurring,',') LIKE concat(',%$day_of_week%,')";
         $Trips=DB::select($sql);
         $Ids=array();
         foreach ($Trips as  $Trip) {
             $Ids[]= $Trip->TRIP_ID;
         }
         return $Ids;
    }
}
