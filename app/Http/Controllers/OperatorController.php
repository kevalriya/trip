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
       
        return view('admin.operator');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Cities=City::all();
        $States=State::all();
        $Countries=Country::all();
        $LGAS=LGA::all();
        $Salutations=Salutation::all();


        return view('admin.addOperator',compact('Cities','States','Countries','LGAS','Salutations'));
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
            'MAIN_CONTACT_EMAIL' => 'required|string|email|max:255|unique:operator',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',
            'LGA' => 'required',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required',
            'LGA' => 'required',
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
    'MAIN_CONTACT_EMAIL' => $request->MAIN_CONTACT_EMAIL ,
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
        
       $Operator = Operator::create($destinationPath);
   
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
       $Cities=City::all();
        $States=State::all();
        $Countries=Country::all();
        $LGAS=LGA::all();
        $Salutations=Salutation::all();
        $Operator=Operator::where('OPERATOR_CODE',$id)->first();

        return view('admin.editOperator',compact('Cities','States','Countries','LGAS','Salutations','Operator'));
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
            'MAIN_CONTACT_EMAIL' => 'required|string|email|max:255|unique:operator,MAIN_CONTACT_EMAIL,'.$id.',OPERATOR_CODE',
            'phone' => 'required|numeric',
            'LGA' => 'required',
            'state' => 'required',
            'country' => 'required',
            'city' => 'required',
            'LGA' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

         $data=array();
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
  
        $data=[
     'MAIN_CONTACT_TITLE' => $request->salutation ,
     'OPERATOR_LEGAL_NAME' => $request->legalName ,
    'OPERATOR_SHORT_NAME' => $request->shortName ,
    'OPERATOR_WEBSITE' => $request->website ,
    'MAIN_CONTACT_FIRSTNAME' => $request->firstName ,
    'MAIN_CONTACT_LASTNAME' => $request->lastName ,
    'MAIN_CONTACT_PHONE1' => $request->phone ,
    'MAIN_CONTACT_PHONE2' => $request->phone1 ,
    'MAIN_CONTACT_EMAIL' => $request->MAIN_CONTACT_EMAIL ,
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
        admin::where('id',$id)->delete();
        return redirect()->back()->with('message','User is deleted successfully');
    }


     public function OperatorLists(Request $request){
        
        if( empty($request->search['value']) ) {  

  $Operators=Operator::offset($request->start)->limit($request->length)->get();
  $cTotal=Operator::count();
   }
    else{
    $Operators=Operator::where('OPERATOR_LEGAL_NAME',$request->search['value'])->offset($request->start)->limit($request->length)->get();
  $cTotal=Operator::where('OPERATOR_LEGAL_NAME',$request->search['value'])->count();
    }

      $data=array();
         foreach($Operators as $row)
         {
           
             $sub_array = array();
            
             $sub_array[] = $row->OPERATOR_LEGAL_NAME;
             $sub_array[] = $row->MAIN_CONTACT_PHONE1;
             $sub_array[] = $row->MAIN_CONTACT_EMAIL;
             $sub_array[] = '<a href="'.route("operator.edit",$row->OPERATOR_CODE).'"> <span class="glyphicon glyphicon-edit"></span></a>';
            
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
