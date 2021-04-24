<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Operator;
use App\Model\Route;
use App\Model\Routepoint;
use App\Model\City;
use App\Model\State;
use App\Model\Country;
use App\Model\LGA;
use App\Model\Salutation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Tab;
use Validator;
class RouteController extends Controller
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
 
        $States=State::where('COUNTRY_ID',73)->orderBy('NAME','ASC')->get();
        $Operators=Operator::where('ACTIVE_INDICATOR','Y')->orderBy('OPERATOR_LEGAL_NAME', 'ASC')->get();

        $data=Tab::where('id',5)->get();
       
        return view('admin.route',compact('States','Operators'), ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
    }

   public function addRoutePoint(Request $request)
    {
      
        $cityArr=$request->city;
        $routeId= $request->routeId;
     
       
       
        if(count($cityArr) > 0 ){
            $data=array();
            foreach ($cityArr as $key => $City) {
               $type=$request->type[$key];
               $addInfo=$request->addInfo[$key];
                
               $sequence=$request->sequence[$key];
               $CityName=$request->cityName[$key];
               $oldId=$request->oldId[$key];
               $state=$request->state[$key];
               $arr=$request->arr[$key];
               $dep=$request->dep[$key];
               

               if(empty($City)){

                $MCity=$this->getCityId($CityName,$state);
               }
               else{
                $MCity=$City;
               }
               

              
               if(!empty($MCity) || !empty($type) ){
               $data=array(
                'ROUTE_ID' => $routeId,
                'CITY_CODE' => $MCity,
                'ROUTE_STOPPOINT_TYPE' => $type,
                'ROUTE_STOPPOINT_SEQNO' => $sequence,
                'ADDITIONAL_INFO' => $addInfo,
                'ARRIVAL_TIME'=> $arr,
                'DEPARTURE_TIME'=> $dep,
               );
                if(isset($oldId) && $oldId > 0){
                  Routepoint::where('ROUTE_ID',$routeId)->where(
                    'ROUTE_STOPPOINT_ID',$oldId)->update($data);

                }
                else{
                    Routepoint::create($data);
                }
              }

            }
            
        }

        return  $output = [
                'success' => 1,
            ];;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCityId($cityName,$state)
    {
      $City= City::where('CITY_NAME',$cityName)->select('CITY_CODE')->first();

      if(isset($City->CITY_CODE)){
        return $City->CITY_CODE;
      }
      else{
        $GETC=$this->getLatLong($cityName,$state);
   
        $state=  $GETC['country'].'-'. $GETC['state'];
         $Data=[
            'CITY_CODE' =>  $GETC['place_id'],
            'CITY_NAME' => $cityName,
            'STATE_CODE' =>$state ,
            'COUNTRY_ID' => '73',
            'LONGITUDE' => $GETC['long'],
            'LATITUDE' => $GETC['lat'],
        ];


       $addCity= City::create($Data);
       return $GETC['place_id'];
      }


    }


    private function getLatLong($address,$state)
    {
     $add=$address;    
     $url = "https://maps.google.com/maps/api/geocode/json?sensor=false&key=AIzaSyCErrMt0mj6St2316G_GpD4dptGv0w7-II&address=".urlencode($add);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
    $responseJson = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($responseJson);
   $place_id= substr($address,0,3).mt_rand(1000, 9999);
        $country='NG';
    $state1=(empty($state)) ? 'ST' : $state;
    if ($response->status == 'OK') {
         $latitude = $response->results[0]->geometry->location->lat;
    
        $longitude = $response->results[0]->geometry->location->lng;
        
         
         for ($i=0; $i < count($response->results[0]->address_components); $i++) { 
             if ($response->results[0]->address_components[$i]->types[0] == "country") {
                $country=$response->results[0]->address_components[$i]->short_name;
             }
          if ($response->results[0]->address_components[$i]->types[0] == "administrative_area_level_1") {
        $stateg=$response->results[0]->address_components[$i]->short_name;
             }
         }
        $state1=(empty($stateg)) ? $state : $stateg;
        return array('place_id'=>$place_id,'country'=>$country,'state'=>$state1,'lat'=>$latitude,'long'=>$longitude);

    } else {
       return array('place_id'=>$place_id,'country'=>'NG','state'=>$state1,'lat'=>0.000000,'long'=>0.000000);
    }    

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    public function routePoint($id)
    {
        $Route=Route::where('ROUTE_ID',$id)->first();
        $States=State::where('COUNTRY_ID',73)->orderBy('NAME','ASC')->get();
        $Cities=City::all();
        $RoutePoint=Routepoint::join('city', 'city.CITY_CODE', '=', 'route_stoppoint.CITY_CODE')->where('ROUTE_ID',$id)->select('route_stoppoint.*','city.CITY_NAME','city.STATE_CODE')->orderBy('ROUTE_STOPPOINT_SEQNO','ASC')->get();
         $data=Tab::where('id',10)->get();
       return view('admin.routePoint',compact('Route','RoutePoint','States','Cities'), ['data'=>$data]);
    }

    public function routeDetail($id)
    {
        $Route=Route::where('ROUTE_ID',$id)->first();

        $States=State::where('COUNTRY_ID',73)->orderBy('NAME','ASC')->get();
        $OCity=City::whereRaw("STATE_CODE = (SELECT `STATE_CODE` FROM `city` WHERE CITY_CODE='$Route->ORIGIN_CITY') ")->get();  
        $DCity=City::whereRaw("STATE_CODE = (SELECT `STATE_CODE` FROM `city` WHERE CITY_CODE='$Route->DEST_CITY') ")->get();   
       
         $Operators=Operator::where('ACTIVE_INDICATOR','Y')->orderBy('OPERATOR_LEGAL_NAME', 'ASC')->get();

       return view('admin.routedata',compact('Route','States','OCity','DCity','Operators'));
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     Route::where('ROUTE_ID',$id)->delete();
         return redirect()->back()->with('message','Route is deleted successfully');
    }

   public function deletePoint(Request $request)
    {
        if(!empty($request->id)){
          RoutePoint::where('ROUTE_STOPPOINT_ID',$request->id)->delete();

        }
         return 'success';
    }


     public function RouteLists(Request $request){
     

        if( empty($request->search['value']) ) {  

  $Routes=Route::with(['operator','OriginCITY','DestCITY'])->offset($request->start)->limit($request->length)->get();
  $cTotal=Route::count();
   }
    else{
    $Routes=Route::with(['operator','OriginCITY','DestCITY'])->where('ROUTE_NAME',$request->search['value'])->offset($request->start)->limit($request->length)->get();
  $cTotal=Route::where('ROUTE_NAME',$request->search['value'])->count();
    }

      $data=array();
         foreach($Routes as $row)
         {
           
             $sub_array = array();
              $frm=' <form id="delete-form-'.$row->ROUTE_ID.'" method="post" action="'.route("route.destroy",$row->ROUTE_ID).'" style="display: none">'.csrf_field(). method_field("DELETE").'</form>';
            $onclick    = "if(confirm('Are you sure, You Want to delete this?')){event.preventDefault();document.getElementById('delete-form-".$row->ROUTE_ID."').submit(); }else{event.preventDefault();}";

             $sub_array[] = $row->ROUTE_NAME;
             $sub_array[] = $row->OriginCITY->CITY_NAME;
             $sub_array[] = $row->DestCITY->CITY_NAME;
             $sub_array[] = $row->operator->OPERATOR_LEGAL_NAME;
             $sub_array[] = $row->TOTAL_DISTANCE;
             $sub_array[] = $row->ESTD_TRAVEL_TIME;
             $sub_array[] = '<button class="btn btn-xs btn-info update-route-name" data-id="'.$row->ROUTE_ID.'"> <span class="glyphicon glyphicon-edit"></span></button> <a href="'.route("routepoint",$row->ROUTE_ID).'" class="btn btn-xs btn-warning"> <span class="glyphicon glyphicon-th-large"></span></a>&nbsp;'.$frm.' <a href="" class="btn btn-xs btn-danger" onclick="'.$onclick.'" ><span class="glyphicon glyphicon-trash"></span></a>';
            
             $data[] = $sub_array;
             }
                
             $output = array(
             "draw"    => intval($request->draw),
             "recordsTotal"  => count($Routes),
             "recordsFiltered" =>  $cTotal,
             "data"    => $data,
            
            );

             return json_encode($output);
         
    }


    public  function Jsonfoo($seconds) {
          $t = round($seconds);
          return sprintf('%02dh %02dm', ($t/3600),($t/60%60));
        }


}
