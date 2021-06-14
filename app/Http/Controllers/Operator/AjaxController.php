<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Route;
use App\Model\Amenitie;
use App\Model\State;
use App\Model\City;
use App\Model\LGA;
use Validator;
use DB;
use Auth;
class AjaxController extends Controller
{	

	public function __construct()
    {
        $this->middleware('auth:operator');
    }

   public function addRoute(Request $request)
   {
 
       $validator = Validator::make($request->all(), [
          'routeName' => 'required|unique:route,ROUTE_NAME',
          'orcity' => 'required',
          'descity' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

        $distance='';

    if(!empty($request->ostate) && !empty($request->dstate)){
  $from =  $request->from.','.$request->ostate;
  $to = $request->to .','.$request->ostate;
  $from = urlencode($from);
  $to = urlencode($to);
  $apiKey= "AIzaSyCxtH7uIB-sE5pzeSCTIWCIBRK3JiKLYS8";  


  $data = $this->executeCurl("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&key=$apiKey&language=en-EN&sensor=false");

  $data = json_decode($data);
  $distance=0;
  if(isset($data->rows[0]->elements)){
  foreach($data->rows[0]->elements as $road) {
     
      $distance = $road->distance->text;
  }

} 
 }


    $Data=[
    'ROUTE_NAME' => $request->routeName,
    'OPERATOR_CODE' => Auth::guard('operator')->user()->OPERATOR_CODE,
    'ORIGIN_CITY' => $request->orcity,
    'DEST_CITY' => $request->descity,
    'TOTAL_DISTANCE' => $distance,
  ];
  
   $Add= Route::create($Data);
    return $this->create_output(1, [], [
                'status' => 1,
                'message'=>'Route Created'
            ]);
   }

   public function addAmenitie(Request $request)
   {
 

       $validator = Validator::make($request->all(), [
          'amenitieName' => 'required',
         
        ]);

        if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

      

    $Data=[
    'AMENITY_NAME' => $request->amenitieName,
    'DESCRIPTION' => $request->description,
    
  ];
  
   $Add= amenitie::create($Data);
    return $this->create_output(1, [], [
                'status' => 1,
                'message'=>'Amenitie Created'
            ]);
   }

   public function addFleetParent(Request $request)
   {
       $validator = Validator::make($request->all(), [
          'parent_type_name' => 'required',
          
        ]);

        if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

  
   DB::table('fleet_parent_type')->insert([
    ['PARENT_TYPE_NAME' => $request->parent_type_name,'DESCRIPTION' => $request->description],
   
  ]);
    return $this->create_output(1, [], [
                'status' => 1,
                'message'=>'Type Created'
            ]);
   }

   public function editFleetParent(Request $request)
   {
       $validator = Validator::make($request->all(), [
          'parent_type_name' => 'required',
          'parent_id' => 'required',
          
        ]);

        if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

  
   DB::table('fleet_parent_type')->where('PARENT_TYPE_CODE', $request->parent_id)->update([
         'PARENT_TYPE_NAME'=>$request->parent_type_name,  
         'DESCRIPTION'=> $request->description, 
       ]);

    return $this->create_output(1, [], [
                'status' => 1,
                'message'=>'Type Created'
            ]);
   }

   public function editRoute(Request $request)
   {
       $validator = Validator::make($request->all(), [
          'routeName' => 'required|unique:route,ROUTE_NAME,'.$request->routeId.',ROUTE_ID',
          'orcity' => 'required',
          'descity' => 'required',
          'routeId' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

           
          $Data=[
    'ROUTE_NAME' => $request->routeName,
    'OPERATOR_CODE' => Auth::guard('operator')->user()->OPERATOR_CODE,
    'ORIGIN_CITY' => $request->orcity,
    'DEST_CITY' => $request->descity,
    'TOTAL_DISTANCE' => $request->distance,
  ];

    if(!empty($request->ostate) && !empty($request->dstate)){
  $from =  $request->from.','.$request->ostate;
  $to = $request->to .','.$request->ostate;
  $from = urlencode($from);
  $to = urlencode($to);
  $apiKey= "AIzaSyCxtH7uIB-sE5pzeSCTIWCIBRK3JiKLYS8";  


  $data = $this->executeCurl("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&key=$apiKey&language=en-EN&sensor=false");

  $data = json_decode($data);
  $distance='';
  if(isset($data->rows[0]->elements)){
  foreach($data->rows[0]->elements as $road) {
     
      $distance = $road->distance->text;
  }
 }
    $Data['TOTAL_DISTANCE']=$distance;
} 

  
  
    Route::where('ROUTE_ID',$request->routeId)->update($Data);
    return $this->create_output(1, [], [
                'status' => 1,
                'message'=>'Route Created'
            ]);
   }


    public function editAmenitie(Request $request)
   {
 

       $validator = Validator::make($request->all(), [
          'amenitieName' => 'required',
          'amenitieId' => 'required',
         
        ]);

        if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

      

    $Data=[
    'AMENITY_NAME' => $request->amenitieName,
    'DESCRIPTION' => $request->description,
    
  ];
  
   $Add= amenitie::where('AMENITY_ID',$request->amenitieId)->update($Data);
    return $this->create_output(1, [], [
                'status' => 1,
                'message'=>'Amenitie Created'
            ]);
   }


    private function executeCurl($url) {

    $auth = curl_init($url);
    curl_setopt($auth, CURLOPT_POST, false);
    curl_setopt($auth, CURLOPT_HEADER, false);
    curl_setopt($auth, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($auth, CURLOPT_POST, 0);
    $response = curl_exec($auth);
    curl_close($auth);

    return $response;
  }


    private function create_output($is_success = false, $error=[], $data=[]) {
        if( $is_success ) {
            $output = ['success' => 1];
            if(count($data) > 0) {
                $output['data'] = $data;
            }
        } else {
            $output = [
                'success' => 0,
                'errors' => $error
            ];
        }
        return $this->array_filter_recursive($output);
    }

        function array_filter_recursive($array, $callback = null) {
        return $array;
        foreach ($array as $key => & $value) {
            if (is_array($value)) {
                $value = $this->array_filter_recursive($value, $callback);
            }
            else {
                if ( ! is_null($callback)) {
                    if ( ! $callback($value)) {
                        $array[$key] = '';
                    }
                }
                else {
                    if ( ! (bool) $value) {
                        $array[$key] = '';
                    }
                }
            }
        }
        unset($value);
        return $array;
    }


    
    public function getState(Request $request)
    {
      $States=State::where('COUNTRY_ID',$request->id)->orderBy('NAME','ASC')->get();
      $Select= '<select class="form-control" name="state" >';
       $Select.='<option value="">Select State</option>';
           foreach ($States as $State){
           $Select.='<option value="'.$State->STATE_CODE.'">'.$State->NAME.'</option>';  
          }
                    
                  
        $Select.='</select>';
        return $Select;
    }

    public function getLGA(Request $request)
    {
      $LGAS=LGA::where('STATE_CODE',$request->id)->orderBy('LGA_NAME','ASC')->get();
      $Select= '<select class="form-control" name="LGA" >';
       $Select.='<option value="">Select LGA</option>';
           foreach ($LGAS as $LGA){
           $Select.='<option value="'.$LGA->HASC_CODE.'">'.$LGA->LGA_NAME.'</option>';  
          }
                    
                  
        $Select.='</select>';
        return $Select;
    }
    
    public function getCity(Request $request)
    {

      $Cities=City::where('STATE_CODE',$request->id)->orderBy('CITY_NAME','ASC')->get();

      $Select= '<select class="form-control" name="city" >';
       $Select.='<option value="">Select City</option>';
           foreach ($Cities as $City){
           $Select.='<option value="'.$City->CITY_CODE.'">'.$City->CITY_NAME.'</option>';  
          }
                    
                  
        $Select.='</select>';
        return $Select;
    }

    public function getSeat(Request $request)
    {

      $Seats=DB::table('seatmap_library')->where('FLEET_TYPE_CODE', $request->id)->get();
      $Select= '<select class="form-control" name="seat" >';
       $Select.='<option value="">Select Seat</option>';
           foreach ($Seats as $Seat){
           $Select.='<option value="'.$Seat->SEATMAP_LIB_CODE.'">'.$Seat->SEAT_MAP_NAME.'</option>';  
          }
                    
                  
        $Select.='</select>';
        return $Select;
    }
    
    public function getRoute(Request $request)
    {

      $Routes=Route::where('OPERATOR_CODE',$request->op)->get();  
      $Select= '<select class="form-control select2" name="route"  data-placeholder="Select Route" id="route-point" aria-hidden="true">';
       $Select.='<option value="">Select Route</option>';
           foreach ($Routes as $Route){
           $Select.='<option value="'.$Route->ROUTE_ID.'" >'.$Route->ROUTE_NAME.'</option> ';  
          }
                   
        $Select.='</select>';
        return $Select;
    }
    
    public function getCityJson(Request $request)
    {

      $Cities=City::where('COUNTRY_ID',73)->where('CITY_NAME','LIKE','%'.$request->search.'%')->offset(0)->limit(20)->orderBy('CITY_NAME','ASC')->get();
          $array=array();
           foreach ($Cities as $City){

           $array[]=array("value"=>$City->CITY_CODE,"label"=>$City->CITY_NAME);

            }
               
        return $array;

    }

}
