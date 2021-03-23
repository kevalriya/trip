<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ResetMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;
use Validator;
class ResetMyPassController extends Controller
{
     
    public function resetPass(Request $request)
    {
        if($request->action == 'user_reset'){
           $rule= ['email' => 'required|string|email|exists:users,EMAIL_ADDRESS'];
        }
        else{
           $rule= ['email' => 'required|string|email|exists:operator,MAIN_CONTACT_EMAIL'];
        }
        $validator = Validator::make($request->all(), $rule,['email.exists'=>'User not found']);


        if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }
        $Type=($request->action == 'user_reset') ? 1 : 2;       
        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where(['EMAIL_ADDRESS'=>$request->email,'type'=>$Type])->delete();

         $token=str_random(60);   
         DB::table('password_resets')->Insert([
            'EMAIL_ADDRESS' => $request->email,
            'token' => $token,
            'type' => $Type,
            'created_at' => \Carbon\Carbon::now()
        ]);

         $name=$request->email;
        $sendMail=$this->sendResetEmail($request->email, $token,$name,$Type);
        if ($sendMail) {

            return $this->create_output(1, [], [
                'status' => 'success',
                'message'=>'A reset link has been sent to your email address.'
            ]);

        } else {

             return $this->create_output(0, [
                'Fail to reset password'
            ]);

          }
    }

    public function updatePass(Request $request)
    {
        $rule=[
            'token'=> 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'email' =>'required',
        ];
        $msg=[
            'token.required'=>'Invalid Token',
            'email.required'=>'Invalid Token',
        ];
        $validator = Validator::make($request->all(), $rule,$msg);


        if ($validator->fails()) {
            return $this->create_output(0, $validator->errors()->all());
        }

        $Type=($request->type == '1') ? 1 : 2;       
        //Get the token just created above
        $tokenData = DB::table('password_resets')
            ->where(['EMAIL_ADDRESS'=>$request->email,'type'=>$Type,'token'=>$request->token])->count();
        if($tokenData <= 0){
             return $this->create_output(0, [
                'Invalid Request'
            ]);

        }   

        $password = Hash::make($request->password);
        $data=['password'=>$password];
        if($Type == 1){
            
         $data['EMAIL_VALID_FLAG']='VALID';
             $updatePass = DB::table('users')
            ->where(['EMAIL_ADDRESS'=>$request->email])->update($data);

        }
        else{
             $data['ACTIVE_INDICATOR']='Y';
            $updatePass = DB::table('operator')
            ->where(['MAIN_CONTACT_EMAIL'=>$request->email])->update($data);

        }

        DB::table('password_resets')->where(['EMAIL_ADDRESS'=>$request->email,'type'=>$Type])->delete();
        if ($updatePass) {

            return $this->create_output(1, [], [
                'status' => 'success',
                'message'=>'Password update success'
            ]);

        } else {
            return $this->create_output(0, [
                'Fail to update password'
            ]);

          }
    }
    
    private function sendResetEmail($email, $token,$name,$type)
    {
    $link =  'http://tripon.ng/password/reset/'. $token.'?email='.urlencode($email).'&type='.$type;
    try {
    $Token=array('link'=>$link,'name'=>$name);   
    
    Mail::to($email)->send(new ResetMail($Token));
        return true;
    } catch (\Exception $e) {
        //print_r($e->getMessage());
        return false;
    }
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

}
