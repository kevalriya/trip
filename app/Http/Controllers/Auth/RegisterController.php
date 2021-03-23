<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Country;
use App\Model\Salutation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Mail\VerifyMail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
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


    public function showRegistrationForm()
    {
        $Salutations=Salutation::all();
        return view('front.register',compact('Countries','Salutations'));
    }

    public function showOperatorRegistrationForm()
    {
        return view('front.operatorRegister');
    }


    public function signupUser(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
          
           'email' => 'required|string|email|unique:users,EMAIL_ADDRESS',
            'first_name' => 'required',
           'password' => 'required|min:6',
            'mobile' => 'required|unique:users,PHONE_NUMBER1', 
            
        ]);


        
        if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

      
        $password = Hash::make($request->password);
        $type=($request->type == 'operator') ? 'OPERATOR' : 'USER';
        $data=[
     'SALUTATION_ID' =>   $request->salutation,  
   'FIRSTNAME' => $request->first_name,  
   'MIDDLENAME' => $request->middle_name , 
   'SURNAME'=> $request->surName,  
   
    'PHONE_NUMBER1' => $request->mobile ,
    'EMAIL_ADDRESS' => $request->email, 
   
    'USER_TYPE_CODE' => $type , 
    'password' => $password , 
    'IMAGE' => '' , 
    'ACTIVE_INDICATOR' => 'N',
    'REMEMBER_TOKEN' => str_random(40), 
    'EMAIL_VALID_FLAG' => 'INVALID',
        ];
        
       $User = User::create($data);
       
        
    Mail::to($User->EMAIL_ADDRESS)->send(new VerifyMail($User));


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
        $verifyUser = User::where('REMEMBER_TOKEN', $token)->first();
        
         
        
        if(isset($verifyUser) ){
           
            if($verifyUser->ACTIVE_INDICATOR != 'Y') {
               $data=['ACTIVE_INDICATOR'=> 'Y','EMAIL_VALID_FLAG'=>'VALID'];
                 $User =  User::where('USER_ID',$verifyUser->USER_ID)->update($data);

               $send= Mail::to($verifyUser->EMAIL_ADDRESS)->send(new WelcomeMail($verifyUser));
               if($send){
               	$s=".";
               }
               else{
               	$s="..";
               }

                $status = "Your account is now verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('message', $status);
    }

  
    protected function create(array $data)
    {
       
        return true;
    }
}
