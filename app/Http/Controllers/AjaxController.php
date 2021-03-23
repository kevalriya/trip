<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Model\Route;
use App\Model\Amenitie;
use App\Model\State;
use App\Model\City;
use App\Model\LGA;
use App\Model\Booking;
use App\Model\Bookingdetail;
use App\User;
use Validator;
use DB;
use Auth;
use App\Mail\ContactMail;
use App\Mail\BookingUserMail;
use Illuminate\Support\Facades\Mail;


class AjaxController extends Controller
{	



public function sendContactMail(Request $request)
{
 
  $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
           'message' => 'required',
           
        ]);



         if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

   $User=[
    'name'=> $request->name,
    'email'=> $request->email,
    'msg'=> $request->message,
   ];


   Mail::to('info@tripon.ng')->send(new ContactMail($User));
   
    return $this->create_output(1, [], [
                'status' => 1,
                'message'=>'Success'
            ]);

 }
    
    public function getCities(Request $request)
    {
      
      if($request->action == 'getFromCity'){
       $Cities= Route::leftjoin('city', 'city.CITY_CODE', '=', 'route.ORIGIN_CITY')->where('city.CITY_NAME', 'like', '%' .$request->search. '%')
                    ->orWhere('city.CITY_CODE', 'like', '%' .$request->search. '%')
                    ->limit(30)
                    ->select('city.CITY_CODE','city.CITY_NAME')
                     ->groupBy('city.CITY_CODE')
                    ->orderBy('city.CITY_NAME','ASC')->get();
      }
      else{

          $Cities= Route::leftjoin('city', 'city.CITY_CODE', '=', 'route.DEST_CITY')->where('city.CITY_NAME', 'like', '%' .$request->search. '%')
                    ->orWhere('city.CITY_CODE', 'like', '%' .$request->search. '%')
                    ->limit(30)
                    ->select('city.CITY_CODE','city.CITY_NAME')
                     ->groupBy('city.CITY_CODE')
                    ->orderBy('city.CITY_NAME','ASC')->get();

      }
   
          $array=array();           
         foreach ($Cities as $City) {
            $array[]=array("value"=>$City->CITY_CODE,"label"=>$City->CITY_NAME);
         }
        return $array ;

      }


    public function userprofile(Request $request)
    {   
  

      $validator = Validator::make($request->all(),[
            'salutation' => 'required',
            'phone' => 'required|numeric|unique:users,PHONE_NUMBER1,'.Auth::user()->USER_ID.',USER_ID',
           'state' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'gender' => 'required',
        ]);



         if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

      
      
        $data=[
     'SALUTATION_ID' =>   $request->salutation,  
   'MIDDLENAME' => $request->middleName , 
   
    'PHONE_NUMBER1' => $request->phone , 
    'PHONE_NUMBER2' => $request->phone1, 
    'EMAIL_ADDRESS' => $request->email, 
    'GENDER_FLAG' => $request->gender , 
    'COUNTRY_ID' => $request->country,  
    'STATE_CODE' => $request->state,  
    'LGA_HASC' => $request->lga , 
    'CITY' => $request->city ,
    'DATE_OF_BIRTH' => $request->date_of_birth , 
    'ADDRESS_LINE_1' => $request->address , 
    'ADDRESS_LINE_2' => $request->address2 , 
    
        ];
        
            if ($request->hasFile('image')) {

            $this->validate($request,[
            
             'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

          $image = $request->file('image');

    $ImgName = time().'.'.$image->getClientOriginalExtension();

    $destinationPath = public_path('/images/users/');

    $image->move($destinationPath, $ImgName);
    $data['IMAGE']=$ImgName;
    }
  

        $User =  User::where('USER_ID',Auth::user()->USER_ID)->update($data);
   
         return $this->create_output(1, [], [
                'status' => 1,
                'message'=>'Success'
            ]);
    }

  public function updatePassword(Request $request)
    {   

      $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required|min:6|different:old_password',
            'confirm_password' => 'required|same:new_password'
           
        ]);



         if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

      
    $password = Hash::make($request->new_password);
    
   
    if (!Hash::check($request->old_password,Auth::user()->password)) {
 
       return $this->create_output(0, ['Old Password Is incorrect']);
      }

        $data=[
     'password' =>   $password,  
       ];
       
      
        $User =  User::where('USER_ID',Auth::user()->USER_ID)->update($data);
   
         return $this->create_output(1, [], [
                'status' => 1,
                'message'=>'Success'
            ]);
    }

  public function bookingPayment(Request $request)
    {   

      $validator = Validator::make($request->all(),[
            'fname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'trip_id' => 'required',
            'regcheck' => 'required',
            'operator_id' => 'required',
        ]);


         if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

      if(!isset(Auth::guard('web')->user()->USER_ID)){

        if($_POST['regcheck'] == 'F' ){

  return $this->create_output(0, ['Please Check Create Traveler account ']);
  die();
  } 

  \DB::beginTransaction();
    $User=$this->addBookingUser($request);
    if(isset($User['status']) && $User['status'] === true){
     $UserId= $User['user'];
    }
    else{
       \DB::rollback();
      return $User;
      die();
    }
   }
   else{
      $UserId=Auth::user()->USER_ID;
   }

$PayMethod=(isset($request->PayMethod) && $request->PayMethod == 'ONLINE') ? 'ONLINE' : 'CASH';
$Total=$request->ftotalval+$request->ftaxtotalval;
$data = [
'USER_ID'=> $UserId,
'BUS_ID'=> $request->bus_id,
'TRIP_ID'=> $request->trip_id,
'ROUTE_ID'=> $request->route_id,
'BOARDING_POINT'=> $request->startBoard ,
'DROPOFF_POINT'=> $request->endBoard ,
'PROCESSED_DATE'=> $request->startdate,
'PRICE'=> $request->ticket_price,
'TOTAL_SEAT_BOOKED'=> $request->passengertotal,
'SUB_TOTAL'=> $request->ftotalval,
'TAX'=> $request->ftaxtotalval ,
'TOTAL'=> $Total,
'PAYMENT_METHOD'=> $PayMethod,
'STATUS'=> 'PAYMENT PENDING',
'PAYMENT_STATUS'=> 'PENDING',
'OPERATOR_CODE'=> $request->operator_id,
 ];

 try {

   $Booking = Booking::create($data);

   if(isset($request->seatid) && count($request->seatid) > 0){
   foreach ($request->seatid as $key => $value) {
    $Seatno=$request->seatid[$key];
    $name=$request->name[$key];
    $surname=$request->surname[$key];
    $age=$request->age[$key];
    $passenger=$request->passenger[$key];
     $Detail=[
    'BOOKING_ID' => $Booking->BOOKING_ID,
    'PASSENGER_SEATNO' => $Seatno,
    'PASSENGER_FIRSTNAME' => $name,
    'PASSENGER_LASTNAME' => $surname,
    'PASSENGER_AGE' => $age,
    'PASSENGER_GENDER' => $passenger,
    'PROCESSED_DATE' => $request->startdate,
    'TICKETNO_PRICE' => $request->ticket_price,
   ];
   Bookingdetail::create($Detail);
   }

 }
   
          \DB::commit();
         return $this->create_output(1, [], [
                'status' => 1,
                'message'=>'Success',
                'booking'=>$Booking->BOOKING_ID,
            ]);
         } catch (\Exception $e) {
            print_r($e->getMessage());
            // handling exception
            \DB::rollback();
            $this->create_output(0, $e->getMessage());
        }
    }



     private function addBookingUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
          
           'email' => 'required|string|email|unique:users,EMAIL_ADDRESS',
            'fname' => 'required',
            'phone' => 'required|unique:users,PHONE_NUMBER1', 
        ]);


        
        if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());

        }

      $length=10;  
      $pass= substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
      $password = Hash::make($pass);

        $data=[
     'SALUTATION_ID' =>   '850009',  
   'FIRSTNAME' => $request->fname,   
   'SURNAME'=> $request->lname ?? '-',  
   
    'PHONE_NUMBER1' => $request->phone ,
    'EMAIL_ADDRESS' => $request->email, 
   
    'USER_TYPE_CODE' => 'USER' , 
    'password' => $password , 
    'IMAGE' => '' , 
    'REMEMBER_TOKEN' => str_random(40),
    'ACTIVE_INDICATOR' => 'Y',
    'EMAIL_VALID_FLAG' => 'VALID',
        ];
     
      $User = User::create($data);
      $User->stringPassword=$pass;
      Mail::to($User->EMAIL_ADDRESS)->send(new BookingUserMail($User));
    return  array('status' => true ,'user'=>$User->USER_ID);
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


    public function refreshToken(Request $request)
    {
         session()->regenerate();
         return response()->json([
            "token"=>csrf_token()],
          200);

    }
}
