<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\User;
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
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showLoginForm()
    {
        return view('admin.login');
    }


    public function login(Request $request)
    {

        $this->validateLogin($request);

     
        if ($this->attemptLogin($request)) {


            return $this->sendLoginResponse($request);
        }


        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
        $admin = User::where('EMAIL_ADDRESS',$request->EMAIL_ADDRESS)->first();
        
   		
        if (count((array)$admin) > 0) {

          
            if ($admin->ACTIVE_INDICATOR == 'N') {

                return ['EMAIL_ADDRESS'=>'inactive','password'=>'You are not an active person, please contact Admin'];
            }else{
                return ['EMAIL_ADDRESS'=>$request->EMAIL_ADDRESS,'password'=>$request->password,'USER_TYPE_CODE'=>'SADMIN'];

            }
            }

          
        return $request->only($this->username(), 'password');
    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->guest(route( 'admin.login' ));
    }


    protected function guard()
    {

        return Auth::guard('admin');
    }
}
