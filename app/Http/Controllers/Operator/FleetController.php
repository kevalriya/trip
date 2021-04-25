<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Model\Operator;
use App\Model\Fleet;
use App\Model\Route;
use App\Model\Amenitie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Tab;
use DB;
use Auth;
use DataTables;
class FleetController extends Controller
{ 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data=Tab::where('id',7)->get();
        return view('operator.fleets', ['data'=>$data]);
    }

 
     public function fleetType()
    {
        $Types = DB::table('fleet_type')
                        ->leftjoin('fleet_parent_type', 'fleet_type.PARENT_TYPE_CODE', '=', 'fleet_parent_type.PARENT_TYPE_CODE')
                        ->select(['fleet_type.*',
                                    'fleet_parent_type.PARENT_TYPE_NAME'])
                       ->where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->limit(3000)->get();
        $data=Tab::where('id',2)->get();
       return view('operator.fleetType',compact('Types'), ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $Routes=Route::where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->get();
        $Amenities=amenitie::orderBy('AMENITY_NAME', 'ASC')->get();
        $fleetTypes = DB::table('fleet_type')->where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->get();
         $data=Tab::where('id',23)->get();
        return view('operator.addFleet',compact('Routes','fleetTypes','Amenities'), ['data'=>$data]);
    }

    public function addFleetType()
    {
        
        $parentTypes = DB::table('fleet_parent_type')->get();
        $seatMaps = DB::table('seatmap_library')->get();

        $data=Tab::where('id',3)->get();
        return view('operator.addFleetType',compact('parentTypes','seatMaps'), ['data'=>$data]);
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
            'seat_count' => 'required',
        ]);


    DB::table('fleet_type')->insert([
    [
    'PARENT_TYPE_CODE' => $request->parent_type,
    'OPERATOR_CODE' => Auth::guard('operator')->user()->OPERATOR_CODE,
    'FLEET_TYPE_NAME' => $request->type_name,
    'FLEET_TYPE_DESC' => $request->description,
    'SEAT_COUNT' => $request->seat_count,
    ],
   
  ]);
   
        return redirect(route('opfleetType'));
    }

   
    public function store(Request $request)
    {

     $this->validate($request,[
             'fleet_name' => 'required|unique:fleet_registration,FLEET_NAME',
            'fleet_type' => 'required',
            'route' => 'required',   
            'registration' => 'required',   
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
    'OPERATOR_CODE' => Auth::guard('operator')->user()->OPERATOR_CODE, 
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
   
        return redirect(route('operator.fleet.index'));
    }

    public function updateFleetType(Request $request,$id)
    {

        $this->validate($request,[
            'parent_type' => 'required',
            'type_name' => 'required|string|max:35',
            'seat_count' => 'required',
        ]);


    DB::table('fleet_type')->where('FLEET_TYPE_CODE',$id)->update(
    [
    'PARENT_TYPE_CODE' => $request->parent_type,
    'OPERATOR_CODE' => Auth::guard('operator')->user()->OPERATOR_CODE,
    'FLEET_TYPE_NAME' => $request->type_name,
    'FLEET_TYPE_DESC' => $request->description,
    'SEAT_COUNT' => $request->seat_count,
    ]
   );
   
        return redirect(route('opfleetType'));
    }

    public function editFleetType($id)
    {

        $parentTypes = DB::table('fleet_parent_type')->get();
       $seatMaps = DB::table('seatmap_library')->get();
       $fleetType = DB::table('fleet_type')->where('FLEET_TYPE_CODE',$id)->where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->first();
       if(!$fleetType){
        abort(403, 'Unauthorized action.');

       }

        return view('operator.editFleetType',compact('parentTypes','seatMaps','fleetType'));
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
        $Routes=Route::where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->get();
        $Amenities=amenitie::orderBy('AMENITY_NAME', 'ASC')->get();
        $fleetTypes = DB::table('fleet_type')->where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->get();

        $Fleet = Fleet::where('FLEET_ID',$id)->where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->first();

        
       if(!$Fleet){
        abort(403, 'Unauthorized action.');

       }
       
        return view('operator.editFleet',compact('Routes','fleetTypes','Fleet','Amenities'));
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
            'route' => 'required',   
            'registration' => 'required',   
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
    'OPERATOR_CODE' => Auth::guard('operator')->user()->OPERATOR_CODE, 
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
   
       
        return redirect(route('operator.fleet.edit',$id))->with('message','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

  
    public function fleetTypeDelete($id)
    {
        DB::table('fleet_type')->where('FLEET_TYPE_CODE',$id)->where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->delete();
        return redirect()->back()->with('message','deleted successfully');
    }


   public function fleetsLists(Request $request){
        

        if ($request->ajax()) {
            $data=Fleet::where('OPERATOR_CODE',Auth::guard('operator')->user()->OPERATOR_CODE)->get();

            return DataTables::of($data)
                  ->addColumn('fleet_name',function ($data){
                     return $data->FLEET_NAME ;
                 })  ->addColumn('route_name',function ($data){
                     return  $data->Route->ROUTE_NAME; ;
                 })  ->addColumn('reg_no',function ($data){
                     return $data->REG_NO ;
                 })
                 ->addColumn('action', function($row){


                    $btn= '<a href="'.route("operator.fleet.edit",$row->FLEET_ID).'"> <span class="glyphicon glyphicon-edit"></span></a>';
        
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
         
    }

}
