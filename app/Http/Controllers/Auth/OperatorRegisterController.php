<?php

namespace App\Http\Controllers\Auth;

use App\Model\Operator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Mail;
use App\Model\Country;
use App\Model\Salutation;
class OperatorRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'FIRSTNAME' => ['required', 'string', 'max:255'],
            'EMAIL_ADDRESS' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }


    public function showOperatorRegistrationForm()
    { 
        
        $Salutations=Salutation::all();
        return view('front.operatorRegister',compact('Salutations'));
    }


    public function signupUser(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'legalName' => 'required|string|max:100',
            'firstName' => 'required|string|max:100',
            'email' => 'required|string|email|unique:operator,MAIN_CONTACT_EMAIL',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);


        
        if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

      
        $password = Hash::make($request->password);

        $data=[
     'MAIN_CONTACT_TITLE' => $request->salutation ,
     'OPERATOR_LEGAL_NAME' => $request->legalName ,
    'OPERATOR_SHORT_NAME' => $request->shortName ,
    'OPERATOR_WEBSITE' => $request->website ,
    'MAIN_CONTACT_FIRSTNAME' => $request->firstName ,
    'MAIN_CONTACT_LASTNAME' => $request->lastName ,
    'MAIN_CONTACT_PHONE1' => $request->phone ,
    'MAIN_CONTACT_PHONE2' => $request->phone1 ,
    'MAIN_CONTACT_EMAIL' => $request->email ,
    'OPERATOR_SIGNUP_DATE' => date('Y-m-d') ,
    'MAIN_CONTACT_CITY' => $request->city ,
    'MAIN_CONTACT_LGA' => $request->LGA ,
    'MAIN_CONTACT_STATE' => $request->state ,
    'MAIN_CONTACT_COUNTRY' => $request->country ,
    'password' => $password ,
    'FLEET_SIZE' => $request->fleetSize,
    'PREFERRED_ROUTES' => $request->preferredRoute ,
    'MAIN_CONTACT_ADDRESS' => $request->address ,
    'REMEMBER_TOKEN' => str_random(40), 
    'ACTIVE_INDICATOR' => 'N' ,
        ];
        
       
       $Operator = Operator::create($data);
        
       
        
    Mail::to($Operator->MAIN_CONTACT_EMAIL)->send(new VerifyMail($Operator));


    return $this->create_output(1, [], [
                'status' => 'success',
                'message'=>'Success'
            ]);
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

       public function verifyUser($token)
    {
        $verifyUser = Operator::where('REMEMBER_TOKEN', $token)->first();
        if(isset($verifyUser) ){
           
            if($verifyUser->ACTIVE_INDICATOR != 'Y') {
               $data=['ACTIVE_INDICATOR'=> 'Y'];
                 $User =  User::where('OPERATOR_CODE',$verifyUser->OPERATOR_CODE)->update($data);
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/operator-login')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/operator-login')->with('message', $status);
    }

  
    protected function create(array $data)
    {
       
        return true;
    }
}
