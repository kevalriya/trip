<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Model\City;
use App\Model\State;
use App\Model\Country;
use App\Model\LGA;
use App\Model\Salutation;
use Illuminate\Support\Facades\Hash;
use App\Tab;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $data=Tab::where('id',13)->get();
        return view('admin.user', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
      $Countries=Country::where('COUNTRY_ID',73)->orderBy('COUNTRY_NAME', 'ASC')->first();
       
        $Salutations=Salutation::all();
        $data=Tab::where('id',15)->get();

        return view('admin.addUser',compact('Countries','Salutations'), ['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
  

        $this->validate($request,[
            'salutation' => 'required',
            'firstName' => 'required|string|max:255',
            'surnameName' => 'required|string|max:255',
            'email' => 'required|string|unique:users,EMAIL_ADDRESS',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'gender' => 'required',
            'user_type' => 'required',
        ]);




         if ($request->hasFile('image')) {

            $this->validate($request,[
            
             'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

          $image = $request->file('image');

    $ImgName = time().'.'.$image->getClientOriginalExtension();

    $destinationPath = public_path('/images/users/');

    $image->move($destinationPath, $ImgName);
    }
    else{
        $ImgName='';
    }
        $password = Hash::make($request->password);

        $data=[
     'SALUTATION_ID' =>   $request->salutation,  
   'FIRSTNAME' => $request->firstName,  
   'MIDDLENAME' => $request->middleName , 
   'SURNAME'=> $request->surnameName,  
   
    'PHONE_NUMBER1' => $request->phone , 
    'PHONE_NUMBER2' => $request->phone1, 
    'EMAIL_ADDRESS' => $request->email, 
    'GENDER_FLAG' => $request->gender , 
    'COUNTRY_ID' => $request->country,  
    'STATE_CODE' => $request->state,  
    'LGA_HASC' => $request->lga , 
    'CITY' => $request->city , 
    'USER_TYPE_CODE' => $request->user_type , 
    'password' => $password , 
    'DATE_OF_BIRTH' => $request->date_of_birth , 
    'ADDRESS_LINE_1' => $request->address , 
    'ADDRESS_LINE_2' => $request->address2 , 
    'IMAGE' => $ImgName , 
    'ACTIVE_INDICATOR' => 'Y',
    'EMAIL_VALID_FLAG' => 'VALID',
        ];
        
       $User = User::create($data);
   
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $User=User::where('USER_ID',$id)->first();
     
        $Cities=City::where('STATE_CODE',$User->STATE_CODE)->orderBy('CITY_NAME','ASC')->get();
        $States=State::where('COUNTRY_ID',73)->orderBy('NAME','ASC')->get();
        $Countries=Country::where('COUNTRY_ID',73)->orderBy('COUNTRY_NAME', 'ASC')->first();
        $LGAS=LGA::where('STATE_CODE',$User->STATE_CODE)->orderBy('LGA_NAME','ASC')->get();
        $Salutations=Salutation::all();
        
        $data=Tab::where('id',25)->get();
        return view('admin.editUser',compact('Cities','States','Countries','LGAS','Salutations','User'), ['data'=>$data]);
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

         $this->validate($request,[
            'salutation' => 'required',
            'firstName' => 'required|string|max:255',
            'surnameName' => 'required|string|max:255',
            'email' => 'required|string|unique:users,EMAIL_ADDRESS,'.$id.',USER_ID',
            'phone' => 'required|numeric',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'gender' => 'required',
            'user_type' => 'required',
        ]);


         $data=array();
      $data=[
     'SALUTATION_ID' =>   $request->salutation,  
   'FIRSTNAME' => $request->firstName,  
   'MIDDLENAME' => $request->middleName , 
   'SURNAME'=> $request->surnameName,  
   
    'PHONE_NUMBER1' => $request->phone , 
    'PHONE_NUMBER2' => $request->phone1, 
    'EMAIL_ADDRESS' => $request->email, 
    'GENDER_FLAG' => $request->gender , 
    'COUNTRY_ID' => $request->country,  
    'STATE_CODE' => $request->state,  
    'LGA_HASC' => $request->lga , 
    'CITY' => $request->city , 
    'USER_TYPE_CODE' => $request->user_type , 
    'DATE_OF_BIRTH' => $request->date_of_birth , 
    'ADDRESS_LINE_1' => $request->address , 
    'ADDRESS_LINE_2' => $request->address2 , 
    'ACTIVE_INDICATOR' => $request->active,
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
  


      $User =  User::where('USER_ID',$id)->update($data);

        return redirect(route('user.edit',$id))->with('message','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       User::where([
            'USER_ID' => $id
        ])->delete();
        return redirect()->back()->with('message','User is deleted successfully');
    }


     public function userLists(Request $request){
        
        if( empty($request->search['value']) ) {  

  $Users=User::whereNotIn('USER_TYPE_CODE', ['SADMIN', 'BADMIN'])->leftjoin('city', 'city.CITY_CODE', '=', 'users.CITY')->offset($request->start)->select('users.*','city.CITY_NAME')->limit($request->length)->get();
  $cTotal=User::whereNotIn('USER_TYPE_CODE', ['SADMIN', 'BADMIN'])->count();
   }
    else{
    $Users=User::whereNotIn('USER_TYPE_CODE', ['SADMIN', 'BADMIN'])->leftjoin('city', 'city.CITY_CODE', '=', 'users.CITY')->where('FIRSTNAME','like', '%' .$request->search['value']. '%')->select('users.*','city.CITY_NAME')->offset($request->start)->limit($request->length)->get();
  $cTotal=User::whereNotIn('USER_TYPE_CODE', ['SADMIN', 'BADMIN'])->where('FIRSTNAME','like', '%' .$request->search['value']. '%')->count();
    }



      $data=array();
         foreach($Users as $row)
         {
            if($row->ACTIVE_INDICATOR == 'Y'){
                $status='<span class="label label-success">Active</span>';
            }
            else{
                $status='<span class="label label-danger">Inactive</span>';
            }
            $Name=$row->FIRSTNAME .' '.$row->MIDDLENAME.' '.$row->SURNAME;
             $sub_array = array();
            $frm=' <form id="delete-form-'.$row->USER_ID.'" method="post" action="'.route("user.destroy",$row->USER_ID).'" style="display: none">'.csrf_field(). method_field("DELETE").'</form>';
            $onclick    = "if(confirm('Are you sure, You Want to delete this?')){event.preventDefault();document.getElementById('delete-form-".$row->USER_ID."').submit(); }else{event.preventDefault();}";
             $sub_array[] = $Name;
             $sub_array[] = $row->PHONE_NUMBER1;
             $sub_array[] = $row->EMAIL_ADDRESS;
             $sub_array[] = $row->CITY_NAME;
             $sub_array[] = $row->USER_TYPE_CODE;
             $sub_array[] = $status;
           

            $sub_array[] = '<a href="'.route("user.edit",$row->USER_ID).'" class="btn btn-xs btn-info"> <span class="glyphicon glyphicon-edit"></span></a>&nbsp;'.$frm.' <a href="" class="btn btn-xs btn-danger" onclick="'.$onclick.'" ><span class="glyphicon glyphicon-trash"></span></a>';
             $data[] = $sub_array;
             }
                
             $output = array(
             "draw"    => intval($request->draw),
             "recordsTotal"  => count($Users),
             "recordsFiltered" =>  $cTotal,
             "data"    => $data,
            
            );

             return json_encode($output);
         
    }

}
