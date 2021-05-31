<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\User;
use App\Model\Country;
use App\Model\Salutation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

     

      public function showLoginForm()
    {
        $Salutations=Salutation::all();
        return view('front.login',compact('Salutations'));
    }


     public function login(Request $request)
    {

        $this->validateLogin($request);


         $admin = User::where([['EMAIL_ADDRESS',$request->EMAIL_ADDRESS],['USER_TYPE_CODE','USER']])->first();

     
        if (count((array)$admin) > 0) {

             $password = Hash::make($request->password);
    
   
    if (!Hash::check($request->password,$admin->password)) {
 
         return
            response([
               'status'=> 'error' ,
                'message' => 'Incorrect email or password'
            ], 200);
      }

            if ($admin->ACTIVE_INDICATOR == 'N') {

                   return
            response([
               'status'=> 'error' ,
                'message' => 'You are not an active person'
            ], 200);
            }
            else if($admin->EMAIL_VALID_FLAG == 'INVALID'){
            
               return
            response([
               'status'=> 'error' ,
                'message' => 'Please verify email'
            ], 200);
            }

        else if ($this->attemptLogin($request)) {

             $request->session()->regenerate();
            // return response(['status' => 'success'], 200);

           return $this->sendLoginResponse($request);
        }
    }

        return
            response([
               'status'=> 'error' ,
                'message' => 'Incorrect email or password'
            ], 200);
    }

    protected function credentials(Request $request)
    {
       
           
                return ['EMAIL_ADDRESS'=>$request->EMAIL_ADDRESS,'password'=>$request->password,'USER_TYPE_CODE'=> 'USER'];

             $credentials = $request->only($this->username(), 'password');
        $authSuccess = Auth::attempt($credentials, $request->has('remember'));
        if($authSuccess) {
            $request->session()->regenerate();
            return response(['success' => true], Response::HTTP_OK);
        }

           return
            response([
                'success' => false,
                'message' => 'Auth failed (or some other message)'
            ], Response::HTTP_FORBIDDEN);
    }

 
}
