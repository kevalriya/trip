<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AssignTrip;
use App\Model\Route;
use App\Model\Trip;
use App\Tab;
use DB;
class AssigntripController extends Controller
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
        $Trips=Trip::where('status',1)->get();
        return view('admin.assigntrip',compact('Trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        $Trips=Trip::all();
        $fleetTypes = DB::table('fleet_type')->get();
        
        return view('admin.addassignTrip',compact('Trips','fleetTypes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       
        $Data=[
   
  'PLANNED_DEP_DATE' =>  $request->dep_date , 
  'PLANNED_DEP_TIME' =>  $request->dep_time , 
   
  'PLANNED_ARR_DATE' =>  $request->arr_date , 
 'PLANNED_ARR_TIME'  =>  $request->arr_time , 
 'SCHEDULED_FLAG' =>  $request->scheduled , 
        ];
      $Assign=  AssignTrip::create($Data);
      
        return redirect(route('assigntrip.edit',$Assign->TRIP_ASSIGN_ID));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if(!isset($_GET['t'])){
           $date=date('Y-m-d');
           $gett=strtotime($date);
        }
        else{
            $gett=$_GET['t'];
             $date=date('Y-m-d',$gett);
        }
       
        $Trip=Trip::where('TRIP_ID',$id)->first();
       $AssignTrip=AssignTrip::where('TRIP_ID',$id)->where('scriptDate',$date)->first();

        return view('admin.editassignTrip',compact('Trip','AssignTrip','date','gett','id'));
    }

    public function startTrip($id)
    {
           $date=date('Y-m-d');
    
        $Trip=Trip::where('TRIP_ID',$id)->first();
       $AssignTrip=AssignTrip::where('TRIP_ID',$id)->where('ACTUAL_DEP_DATE',$date)->first();
        $data=Tab::where('id',34)->get();
        return view('admin.startTrip',compact('Trip','AssignTrip','date','id'), ['data'=>$data]);
   
      
    }

    public function endTrip($id)
    {
       
           $date=date('Y-m-d');
        

       
        $Trip=Trip::where('TRIP_ID',$id)->first();
       $AssignTrip=AssignTrip::where('TRIP_ID',$id)->where('ACTUAL_DEP_DATE',$date)->first();
       
    $data=Tab::where('id',35)->get();
        return view('admin.endTrip',compact('Trip','AssignTrip','date','id'), ['data'=>$data]);
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
         

        $Data=[
   'TRIP_ID'    => $id,
  'PLANNED_DEP_DATE' =>  $request->dep_date , 
  'PLANNED_DEP_TIME' =>  $request->dep_time , 
   
  'PLANNED_ARR_DATE' =>  $request->arr_date , 
 'PLANNED_ARR_TIME'  =>  $request->arr_time , 
 
   'SCHEDULED_FLAG' =>  $request->scheduled , 
   'scriptDate' =>  $request->srdate , 
        ];

        if($request->has('assignid')){
            AssignTrip::where('TRIP_ASSIGN_ID',$request->assignid)->where('TRIP_ID',$id)->update($Data);
        }
        else{
            AssignTrip::create($Data);
        }
        
      
        return redirect(route('assigntrip.edit',$id).'?t='.$request->gett);

      

      
    }
      
    public function editstartTrip(Request $request, $id)
    {
         
        $Data=[
    
   'ACTUAL_DEP_DATE' =>  $request->act_dep_date , 
  'ACTUAL_DEP_TIME' =>  $request->act_dep_time , 
  'BEGIN_ODOMETER' =>  $request->b_odometer ,  
  'TotalPassenger' =>  $request->totalpassenger, 
  'TRIP_ID' =>  $id, 
        ];

          if($request->has('assignid')){
            AssignTrip::where('TRIP_ASSIGN_ID',$request->assignid)->where('TRIP_ID',$id)->update($Data);
        }
        else{
            AssignTrip::create($Data);
        }
        
       
        return redirect(route('startTrip',$id).'?t='.$request->gett);
    }

    public function editendTrip(Request $request, $id)
    {

   
        $Data=[

   'ACTUAL_ARR_DATE' =>  $request->act_arr_date , 
  'ACTUAL_ARR_TIME' =>  $request->act_arr_time , 
     'TRIP_ID' =>  $id, 
   'END_ODOMETER' =>  $request->e_odometer , 
  'TOTAL_FUEL' =>  $request->fuel , 
  'TRIP_COMMENT' =>  $request->comment , 
   'scriptDate' =>  $request->srdate , 
   
   'TOTAL_INCOME' =>  $request->totalIncome , 
   'TOTAL_EXPENSE' =>  $request->totalexpense , 

     ];

        
        if($request->has('assignid')){
            AssignTrip::where('TRIP_ASSIGN_ID',$request->assignid)->where('TRIP_ID',$id)->update($Data);
        }
        else{
            AssignTrip::create($Data);
        }

            return redirect(route('endTrip',$id).'?t='.$request->gett);
    
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }


    public function assignLists(Request $request){
      
      if($request->has('trip')){
        $Trip=Trip::leftjoin('route', 'route.ROUTE_ID', '=', 'trip.ROUTE_ID')->leftjoin('operator', 'operator.OPERATOR_CODE', '=', 'route.OPERATOR_CODE')->where('TRIP_ID',$request->trip)->select(['trip.*','route.ROUTE_NAME','operator.OPERATOR_LEGAL_NAME'])->first();
        return view('admin.assignData',compact('Trip'));
        }
        else{
            echo die('<h3>Missing Trip</h3>');
        }

    }

}
