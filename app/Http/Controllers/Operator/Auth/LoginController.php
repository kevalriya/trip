<?php

namespace App\Http\Controllers\Operator\Auth;

use App\Http\Controllers\Controller;
use App\Model\Operator;
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
    protected $redirectTo = 'operator/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showLoginForm()
    {
        return view('operator.login');
    }


    public function login(Request $request)
    {

        $this->validateLogin($request);


        if ($this->attemptLogin($request)) {


            return $this->sendLoginResponse($request);
        }


        return $this->sendFailedLoginResponse($request);
    }



     public function opAjaxLogin(Request $request)
    {
        $this->validateLogin($request);

         $admin = Operator::where('MAIN_CONTACT_EMAIL',$request->MAIN_CONTACT_EMAIL)->first();

     
        if (count((array)$admin) > 0) {

       $password = Hash::make($request->PASSWORD);
        
   
    if (!Hash::check($request->PASSWORD,$admin->PASSWORD)) {

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
            

        else if (Auth::guard('operator')->loginUsingId($admin->OPERATOR_CODE)) {

             $request->session()->regenerate();
            return response(['status' => 'success'], 200);

           // return $this->sendLoginResponse($request);
        }
    }

        return
            response([
               'status'=> 'error' ,
                'message' => 'Incorrect email or password'
            ], 200);
    }

       protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'PASSWORD' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }


    protected function username()
    {
       return 'MAIN_CONTACT_EMAIL';
    }

    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }



    public function __construct()
    {
        $this->middleware('guest:operator')->except('logout');
    }

    public function logout(Request $request)
    {
        Auth::guard('operator')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'operator.login' ));
    }


    protected function guard()
    {

        return Auth::guard('operator');
    }
}
