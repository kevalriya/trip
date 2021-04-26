<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Operator;
use App\Model\Fleet;
use App\Model\Route;
use App\Model\Amenitie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Tab;
use DB;
class FleetController extends Controller
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
       $data=Tab::where('id',7)->get();
        return view('admin.fleets', ['data'=>$data]);
    }
    public function parentType()
    {
        $parentTypes = DB::table('fleet_parent_type')->get();
        $data=Tab::where('id',1)->get();
       return view('admin.fleetparent',compact('parentTypes'), ['data'=>$data]);
    } 

    public function FAQ()
    {
        $FAQS = DB::table('faq')->get();
        $data=Tab::where('id',19)->get();
    
       return view('admin.faq',compact('FAQS'), ['data'=>$data]);
    } 

    public function addFaq()
    {
        $data=Tab::where('id',20)->get();
        return view('admin.addfaq', ['data'=>$data]);
    } 

    public function editFaq(Request $request,$id)
    {
       $Faq=db::table('faq')->where('id',$id)->first();
       $data=Tab::where('id',21)->get();
       return view('admin.editFaq',compact('Faq'), ['data'=>$data]);
    } 

     public function fleetType()
    {
        $Types = DB::table('fleet_type')->leftjoin('operator', 'fleet_type.OPERATOR_CODE', '=', 'operator.OPERATOR_CODE')
                        ->leftjoin('fleet_parent_type', 'fleet_type.PARENT_TYPE_CODE', '=', 'fleet_parent_type.PARENT_TYPE_CODE')
                        ->select(['fleet_type.*',
                                    'fleet_parent_type.PARENT_TYPE_NAME','operator.OPERATOR_LEGAL_NAME'])
                        ->limit(3000)->get();
        $data=Tab::where('id',2)->get();
       return view('admin.fleetType',compact('Types'), ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $Operators=Operator::where('ACTIVE_INDICATOR','Y')->orderBy('OPERATOR_LEGAL_NAME', 'ASC')->get();
        $Routes=Route::all();;
        $Amenities=Amenitie::orderBy('AMENITY_NAME', 'ASC')->get();
        $fleetTypes = DB::table('fleet_type')->get();
       $data=Tab::where('id',23)->get();
        return view('admin.addFleet',compact('Operators','Routes','fleetTypes','Amenities'), ['data'=>$data]);
    }

    public function addFleetType()
    {
         $Operators=Operator::where('ACTIVE_INDICATOR','Y')->orderBy('OPERATOR_LEGAL_NAME', 'ASC')->get();
        $parentTypes = DB::table('fleet_parent_type')->get();
        $seatMaps = DB::table('seatmap_library')->get();

        $data=Tab::where('id',3)->get();
        return view('admin.addFleetType',compact('Operators','parentTypes','seatMaps'), ['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createFleetType(Request $request)
    {   

        $this->validate($request,[
            'parent_type' => 'required',
            'type_name' => 'required|string|max:35',
            'operator' => 'required',
            'seat_count' => 'required',
        ]);


    DB::table('fleet_type')->insert([
    [
    'PARENT_TYPE_CODE' => $request->parent_type,
    'OPERATOR_CODE' => $request->operator,
    'FLEET_TYPE_NAME' => $request->type_name,
    'FLEET_TYPE_DESC' => $request->description,
    'SEAT_COUNT' => $request->seat_count,
    ],
   
  ]);
   
        return redirect(route('fleetType'));
    }

    public function insertfaq(Request $request)
    {   

        $this->validate($request,[
            'question' => 'required',
            'answer' => 'required',
        ]);


    DB::table('faq')->insert([
    [
    'que' => $request->question,
    'ans' => $request->answer,
    ],
   
  ]);
   
        return redirect(route('admin.faq'));
    }

    public function updateFaq(Request $request,$id)
    {   

        $this->validate($request,[
            'question' => 'required',
            'answer' => 'required',
        ]);


    DB::table('faq')->where('id',$id)->update(
    [
    'QUE' => $request->question,
    'ANS' => $request->answer,
    ]
   );
   
        return redirect(route('admin.faq'));
    }

    public function store(Request $request)
    {

     $this->validate($request,[
             'fleet_name' => 'required|unique:fleet_registration,FLEET_NAME',
            'fleet_type' => 'required',
            'operator' => 'required',
            'route' => 'required',   
            'registration' => 'required|unique:fleet_registration,REG_NO',   
            'amenitie' => 'array',   
        ]);

     $ac_available= (empty($request->ac_available)) ? 'N' :$request->ac_available;
    $route_assign= (empty($request->route_assign)) ? 'N' :$request->route_assign;

     if(isset($request->amenitie)){
     $amenitiearr=json_encode($request->amenitie);
      }
      else{
        $amenitiearr='';
      }
    
     $data=[
     'FLEET_NAME' => $request->fleet_name, 
    'FLEET_TYPE_CODE' => $request->fleet_type, 
    'OPERATOR_CODE' => $request->operator, 
    'ROUTE_ID' => $request->route, 
    'MAKE' => $request->make, 
    'MODEL' => $request->Model, 
    'ENGINE_NO' => $request->engine_no, 
    'CHASIS_NO' => $request->chassis_no, 
    'YEAR_OF_MANUFACTURE' => $request->manufacture, 
    'REG_NO' => $request->registration, 
    'COLOUR' => $request->colour, 
    'HOME_TERMINAL' => $request->home_terminal, 
    'AC_AVAILABLE' => $ac_available, 
    'IS_ROUTE_ASSIGNED' => $route_assign, 
     'amenities' => $amenitiearr, 
     ];

    $Fleet = Fleet::create($data);

        return redirect(route('fleet.index'));
    }

    public function updateFleetType(Request $request,$id)
    {

        $this->validate($request,[
            'parent_type' => 'required',
            'type_name' => 'required|string|max:35',
            'operator' => 'required',
            'seat_count' => 'required',
        ]);


    DB::table('fleet_type')->where('FLEET_TYPE_CODE',$id)->update(
    [
    'PARENT_TYPE_CODE' => $request->parent_type,
    'OPERATOR_CODE' => $request->operator,
    'FLEET_TYPE_NAME' => $request->type_name,
    'FLEET_TYPE_DESC' => $request->description,
    'SEAT_COUNT' => $request->seat_count,
    ]
   );
   
        return redirect(route('fleetType'));
    }

    public function editFleetType($id)
    {

        $Operators=Operator::where('ACTIVE_INDICATOR','Y')->orderBy('OPERATOR_LEGAL_NAME', 'ASC')->get();
       $parentTypes = DB::table('fleet_parent_type')->get();
       $seatMaps = DB::table('seatmap_library')->get();
       $fleetType = DB::table('fleet_type')->where('FLEET_TYPE_CODE',$id)->first();

        $data=Tab::where('id',27)->get();
        return view('admin.editFleetType',compact('Operators','parentTypes','seatMaps','fleetType'), ['data'=>$data]);
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
        $Operators=Operator::where('ACTIVE_INDICATOR','Y')->orderBy('OPERATOR_LEGAL_NAME', 'ASC')->get();
        $Routes=Route::all();;
        $fleetTypes = DB::table('fleet_type')->get();
        $Amenities=Amenitie::orderBy('AMENITY_NAME', 'ASC')->get();
        $Fleet = Fleet::where('FLEET_ID',$id)->first();
        $data=Tab::where('id',29)->get();
        return view('admin.editFleet',compact('Operators','Routes','fleetTypes','Fleet','Amenities'), ['data'=>$data]);
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
            'fleet_name' => 'required|unique:fleet_registration,FLEET_NAME,'.$id.',FLEET_ID',
            'fleet_type' => 'required',
            'operator' => 'required',
            'route' => 'required',   
            'registration' => 'required|unique:fleet_registration,REG_NO,'.$id.',FLEET_ID',   
        ]);

     $ac_available= (empty($request->ac_available)) ? 'N' :$request->ac_available;
    $route_assign= (empty($request->route_assign)) ? 'N' :$request->route_assign;

      if(isset($request->amenitie)){
     $amenitiearr=json_encode($request->amenitie);
      }
      else{
        $amenitiearr='';
      }

     $data=[
     'FLEET_NAME' => $request->fleet_name, 
    'FLEET_TYPE_CODE' => $request->fleet_type, 
    'OPERATOR_CODE' => $request->operator, 
    'ROUTE_ID' => $request->route, 
    'MAKE' => $request->make, 
    'MODEL' => $request->Model, 
    'ENGINE_NO' => $request->engine_no, 
    'CHASIS_NO' => $request->chassis_no, 
    'YEAR_OF_MANUFACTURE' => $request->manufacture, 
    'REG_NO' => $request->registration, 
    'COLOUR' => $request->colour, 
    'HOME_TERMINAL' => $request->home_terminal, 
    'AC_AVAILABLE' => $ac_available, 
    'IS_ROUTE_ASSIGNED' => $route_assign, 
    'amenities' => $amenitiearr, 
     ];

    $Fleet = Fleet::where('FLEET_ID',$id)->update($data);
 
       
        return redirect(route('fleet.edit',$id))->with('message','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fleet::where('id',$id)->delete();
        return redirect()->back()->with('message','User is deleted successfully');
    }

    public function parentTypeDelete($id)
    {
        DB::table('fleet_parent_type')->where('PARENT_TYPE_CODE',$id)->delete();
        return redirect()->back()->with('message','deleted successfully');
    }
    
    public function faqDelete($id)
    {
        DB::table('faq')->where('id',$id)->delete();
        return redirect()->back()->with('message','deleted successfully');
    }
    
    public function fleetTypeDelete($id)
    {
        DB::table('fleet_type')->where('FLEET_TYPE_CODE',$id)->delete();
        return redirect()->back()->with('message','deleted successfully');
    }


     public function fleetsLists(Request $request){
        
        if( empty($request->search['value']) ) {  

  $Fleets=Fleet::with('operator')->offset($request->start)->limit($request->length)->get();
  $cTotal=Fleet::count();
   }
    else{
    $Fleets=Fleet::with('operator','Route')->where('FLEET_NAME','like', '%' .$request->search['value']. '%')->offset($request->start)->limit($request->length)->get();
  $cTotal=Fleet::where('FLEET_NAME',$request->search['value'])->count();
    }

      $data=array();
         foreach($Fleets as $row)
         {
           
             $sub_array = array();
            
             $sub_array[] = $row->FLEET_NAME;
             $sub_array[] = $row->operator->OPERATOR_LEGAL_NAME;
             $sub_array[] = $row->Route->ROUTE_NAME;
             $sub_array[] = $row->REG_NO;
             $sub_array[] = '<a href="'.route("fleet.edit",$row->FLEET_ID).'"> <span class="glyphicon glyphicon-edit"></span></a>';
            
             $data[] = $sub_array;
             }
                
             $output = array(
             "draw"    => intval($request->draw),
             "recordsTotal"  => count($Fleets),
             "recordsFiltered" =>  $cTotal,
             "data"    => $data,
            
            );

             return json_encode($output);
         
    }

}
