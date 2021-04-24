<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Operator;
use App\Model\City;
use App\Model\State;
use App\Model\Country;
use App\Model\LGA;
use App\Model\Salutation;
use Illuminate\Support\Facades\Hash;
use App\Tab;
use Illuminate\Http\Request;

class OperatorController extends Controller
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
        $data=Tab::where('id',12)->get();
        return view('admin.operator', ['data'=>$data]);
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
        $data=Tab::where('id',14)->get();
        return view('admin.addOperator',compact('Countries','Salutations'), ['data'=>$data]);
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
            'legalName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'email' => 'required|string|unique:operator,MAIN_CONTACT_EMAIL',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);


         if ($request->hasFile('image')) {

            $this->validate($request,[
            
             'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

          $image = $request->file('image');

    $ImgName = time().'.'.$image->getClientOriginalExtension();

    $destinationPath = public_path('/images/operator/');

    $image->move($destinationPath, $ImgName);
    }
    else{
        $ImgName='';
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
    'CREATE_BY' => 'SADMIN',
    'FLEET_PHOTO' => $ImgName ,
    'MAIN_CONTACT_ADDRESS' => $request->address ,
        ];
        
       $Operator = Operator::create($data);
   
        return redirect(route('operator.index'));
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
        $Operator=Operator::where('OPERATOR_CODE',$id)->first();
     
        $Cities=City::where('STATE_CODE',$Operator->MAIN_CONTACT_STATE)->orderBy('CITY_NAME','ASC')->get();
        $States=State::where('COUNTRY_ID',73)->orderBy('NAME','ASC')->get();
         $Countries=Country::where('COUNTRY_ID',73)->orderBy('COUNTRY_NAME', 'ASC')->first();
        $LGAS=LGA::where('STATE_CODE',$Operator->MAIN_CONTACT_STATE)->orderBy('LGA_NAME','ASC')->get();
        $Salutations=Salutation::all();
        $data=Tab::where('id',24)->get();

        return view('admin.editOperator',compact('Cities','States','Countries','LGAS','Salutations','Operator'), ['data'=>$data]);
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
            'firstName' => 'required|string|max:255',
             'email' => 'required|string|unique:operator,MAIN_CONTACT_EMAIL,'.$id.',OPERATOR_CODE',
            'phone' => 'required|numeric',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

         $data=array();
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
    'FLEET_SIZE' => $request->fleetSize,
    'ACTIVE_INDICATOR' =>  $request->active,
    'PREFERRED_ROUTES' => $request->preferredRoute ,
    'MOD_BY' => 'SADMIN',
    'MAIN_CONTACT_ADDRESS' => $request->address ,
        ];

         if ($request->hasFile('image')) {

            $this->validate($request,[
            
             'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

          $image = $request->file('image');

    $ImgName = time().'.'.$image->getClientOriginalExtension();

    $destinationPath = public_path('/images/operator/');

    $image->move($destinationPath, $ImgName);
    $data['FLEET_PHOTO']=$ImgName;
    }
  
    

      $Operator =  Operator::where([
            'OPERATOR_CODE' => $id
        ])->update($data);
        
        return redirect(route('operator.edit',$id))->with('message','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Operator::where([
            'OPERATOR_CODE' => $id
        ])->delete();
        return redirect()->back()->with('message','Operator is deleted successfully');
    }


     public function OperatorLists(Request $request){
        
        if( empty($request->search['value']) ) {  

  $Operators=Operator::offset($request->start)->leftjoin('city', 'city.CITY_CODE', '=', 'operator.MAIN_CONTACT_CITY')->select('operator.*','city.CITY_NAME')->limit($request->length)->get();
  $cTotal=Operator::count();
   }
    else{
    $Operators=Operator::where('OPERATOR_LEGAL_NAME','like', '%' .$request->search['value']. '%')->leftjoin('city', 'city.CITY_CODE', '=', 'operator.MAIN_CONTACT_CITY')->offset($request->start)->limit($request->length)->select('operator.*','city.CITY_NAME')->get();
  $cTotal=Operator::where('OPERATOR_LEGAL_NAME','like', '%' .$request->search['value']. '%')->count();
    }

      $data=array();
         foreach($Operators as $row)
         {
            if($row->ACTIVE_INDICATOR == 'Y'){
                $status='<span class="label label-success">Active</span>';
            }
            else{
                $status='<span class="label label-danger">Inactive</span>';
            }
           
           $Name=$row->MAIN_CONTACT_FIRSTNAME .' '.$row->MAIN_CONTACT_LASTNAME;
             $sub_array = array();
            $frm=' <form id="delete-form-'.$row->OPERATOR_CODE.'" method="post" action="'.route("operator.destroy",$row->OPERATOR_CODE).'" style="display: none">'.csrf_field(). method_field("DELETE").'</form>';
            $onclick	= "if(confirm('Are you sure, You Want to delete this?')){event.preventDefault();document.getElementById('delete-form-".$row->OPERATOR_CODE."').submit(); }else{event.preventDefault();}";
             $sub_array[] = $row->OPERATOR_LEGAL_NAME;
              $sub_array[] = $row->CITY_NAME;
             $sub_array[] = $Name;

             $sub_array[] = $row->MAIN_CONTACT_PHONE1;
             $sub_array[] = $row->MAIN_CONTACT_EMAIL;
            
             $sub_array[] = $row->FLEET_SIZE;
             $sub_array[] = $status;
             $sub_array[] = '<a href="'.route("operator.edit",$row->OPERATOR_CODE).'" class="btn btn-xs btn-info"> <span class="glyphicon glyphicon-edit"></span></a>&nbsp;'.$frm.' <a href="" class="btn btn-xs btn-danger" onclick="'.$onclick.'" ><span class="glyphicon glyphicon-trash"></span></a>';
            
             $data[] = $sub_array;
             }
                
             $output = array(
             "draw"    => intval($request->draw),
             "recordsTotal"  => count($Operators),
             "recordsFiltered" =>  $cTotal,
             "data"    => $data,
            
            );

             return json_encode($output);
         
    }

}
