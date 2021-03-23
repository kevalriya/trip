<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Operator;
use App\Model\Seat;
use DB;
class SeatController extends Controller
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
        
        return view('operator.seat');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id=null)
    {
        if(isset($id)){
             $FleetTypes=DB::table('fleet_type')->where('FLEET_TYPE_CODE',$id)->first();
             $default="yes";
        }
        else{
            $FleetTypes=DB::table('fleet_type')->get();
            $default="no";
        }
        
        
        return view('operator.addSeat',compact('FleetTypes','default'));
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
            'map_name' => 'required|string|max:255',
            'fleet_type' => 'required',
            'column' => 'required|numeric',
            'row' => 'required|numeric',
           
        ]);


    $id = DB::table('seatmap_library')->insertGetId(
    [
    'SEAT_MAP_NAME' => $request->map_name,
    'SEAT_MAP_DESC' => $request->description,
    'FLEET_TYPE_CODE' =>$request->fleet_type,
    'rows' => $request->row,
    'columns' => $request->column,
    ]
   );


        
        return redirect(route('opaddseatMap',$request->fleet_type));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$fleet=null)
    {
       $FleetTypes=DB::table('fleet_type')->get();
       $Seat=DB::table('seatmap_library')->where('SEATMAP_LIB_CODE', $id)->first();
       $SeatLibs=Seat::where('SEATMAP_LIB_CODE',$id)->get();

       $SeatArr=array();
       foreach ($SeatLibs as $SeatLib) {
            $SeatArr[$SeatLib->SEAT_NAME]= $SeatLib->SEATTYPE;
       }

       if(isset($fleet)){
             $FleetTypes=DB::table('fleet_type')->where('FLEET_TYPE_CODE',$fleet)->first();
             $default="yes";
        }
        else{
            $FleetTypes=DB::table('fleet_type')->get();
            $default="no";
        }
    
        
        return view('operator.editSeat',compact('Seat','SeatArr','FleetTypes','default'));
    }


    public function addseatMap($id)
    {
        
      $SeatMap=DB::table('seatmap_library')->where('FLEET_TYPE_CODE',$id)->first();
      
      if(isset($SeatMap->SEATMAP_LIB_CODE)){
        return $this->edit($SeatMap->SEATMAP_LIB_CODE,$id);
      }
      else{
        return $this->create($id);
      }
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
            'map_name' => 'required|string|max:255',
            'fleet_type' => 'required',
            'row' => 'required',
            'column' => 'required',
           
        ]);

         $Data=array();
          $Data=[
    'SEAT_MAP_NAME' => $request->map_name,
    'SEAT_MAP_DESC' => $request->description,
    'FLEET_TYPE_CODE' =>$request->fleet_type,
    'rows' => $request->row,
    'columns' => $request->column,
    ];
   

   
    DB::table('seatmap_library')->where('SEATMAP_LIB_CODE',$id)->update($Data);

       Seat::where('SEATMAP_LIB_CODE',$id)->delete();
        if ($request->has('seat') )
                {
                  

                    $sdata = array();
                    foreach ($request->seat as $k => $seat)
                    {
                        
                        $sdata['SEAT_NAME'] = $k;
                        $sdata['SEATTYPE'] = $request->seat[$k];
                        $sdata['SEATMAP_LIB_CODE'] = $id;
                        
                        
                       Seat::create($sdata);
                    }
                }


     
                return redirect(route('opaddseatMap',$request->fleet_type))->with('message','updated successfully');
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function seatLists(Request $request){
        
        if(empty($request->search['value']) ) {  

  $Seats=DB::table('seatmap_library')->offset($request->start)->limit($request->length)->get();
  $cTotal=DB::table('seatmap_library')->count();
   }
    else{
    $Seats=DB::table('seatmap_library')->where('SEAT_MAP_NAME','like', '%' .$request->search['value']. '%')->offset($request->start)->limit($request->length)->get();
 
  $cTotal=DB::table('seatmap_library')->where('SEAT_MAP_NAME','like', '%' .$request->search['value']. '%')->count();
    }

      $data=array();
         foreach($Seats as $row)
         {
           
             $sub_array = array();
            
             $sub_array[] = $row->SEAT_MAP_NAME;
             $sub_array[] = $row->SEAT_MAP_DESC;
           
             $sub_array[] = '<a href="'.route("seat.edit",$row->SEATMAP_LIB_CODE).'"> <span class="glyphicon glyphicon-edit"></span></a>';
            
             $data[] = $sub_array;
             }
                
             $output = array(
             "draw"    => intval($request->draw),
             "recordsTotal"  => count($Seats),
             "recordsFiltered" =>  $cTotal,
             "data"    => $data,
            
            );

             return json_encode($output);
         
    }

}
