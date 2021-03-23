<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use DB;
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

      public function showResetForm(Request $request, $token = null)
    {
        $tokenData = DB::table('password_resets')
            ->where(['EMAIL_ADDRESS'=>$request->email,'type'=>$request->type,'token'=>$token])->count();
        if($tokenData <= 0){
        return redirect('/reset-password');

        }

        return view('front.setResetPass')->with(
            ['token' => $token, 'email' => $request->email,'type'=> $request->type]
        );
    }

     public function resetPassword(Request $request, PasswordBroker $passwords)
    {

            switch ($response)
            {
                case PasswordBroker::RESET_LINK_SENT:
                   return[
                       'error'=>'false',
                       'msg'=>'A password link has been sent to your email address'
                   ];

                case PasswordBroker::INVALID_USER:
                   return[
                       'error'=>'true',
                       'msg'=>"We can't find a user with that email address"
                   ];
            }
        
        return false;
    }

    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
