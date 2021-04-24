<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Country;
use App\Model\City;
use App\Model\State;
use App\Tab;
class CityController extends Controller
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
        $data=Tab::where('id',16)->get();
        return view('admin.city', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
      $Countries=Country::orderBy('COUNTRY_NAME', 'ASC')->get();
        $data=Tab::where('id',17)->get();
        return view('admin.addCity',compact('Countries'), ['data'=>$data]);
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
          'city_code' => 'required|unique:city,CITY_CODE',
          'city_name' => 'required',
            'country' => 'required',
            'state' => 'required',
        ]);

     
       
         if ($request->hasFile('image')) {

            $this->validate($request,[
            
             'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

          $image = $request->file('image');

    $ImgName = time().'.'.$image->getClientOriginalExtension();
    $url=config('constants.city_url');
      
    $destinationPath = public_path($url);

    $image->move($destinationPath, $ImgName);
    }
    else{
        $ImgName='';
    }
      if (!empty($request->longitude) && !empty($request->latitude) ) {
         $longitude=$request->longitude;
        $latitude=$request->latitude;
      }
      else{
       $GETLT= $this->getLatlONG($request->city_name);
        $latitude=$GETLT['lat'];
        $longitude=$GETLT['long'];        
      }

        $Data=[
            'CITY_CODE' =>  $request->city_code,
            'CITY_NAME' => $request->city_name,
            'STATE_CODE' =>$request->state ,
            'COUNTRY_ID' => $request->country,
            'CITY_PHOTO' => $ImgName,
            'LONGITUDE' => $longitude,
            'LATITUDE' => $latitude,
        ];


       $addCity= City::create($Data);

      return redirect(route('city.index'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $Countries=Country::orderBy('COUNTRY_NAME', 'ASC')->get();
         $City=City::where('CITY_CODE',$id)->first();
         $States=State::where('COUNTRY_ID',$City->COUNTRY_ID)->orderBy('NAME','ASC')->get();
         $data=Tab::where('id',26)->get(); 
        return view('admin.editCity',compact('Countries','States','City'), ['data'=>$data]);
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
          'city_code' => 'required|unique:city,CITY_CODE,'.$id.',CITY_CODE',
          'city_name' => 'required',
            'country' => 'required',
            'state' => 'required',
        ]);

       if (!empty($request->longitude) && !empty($request->latitude) ) {
         $longitude=$request->longitude;
        $latitude=$request->latitude;
      }
      else{
       $GETLT= $this->getLatlONG($request->city_name);
        $latitude=$GETLT['lat'];
        $longitude=$GETLT['long'];       
      }

        $Data=[
            'CITY_CODE' =>  $request->city_code,
            'CITY_NAME' => $request->city_name,
            'STATE_CODE' =>$request->state ,
            'COUNTRY_ID' => $request->country,
            
            'LONGITUDE' => $longitude,
            'LATITUDE' => $latitude,
        ];

          if ($request->hasFile('image')) {

            $this->validate($request,[
            
             'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

          $image = $request->file('image');

    $ImgName = time().'.'.$image->getClientOriginalExtension();

    $destinationPath = public_path('/images/city/');

    $image->move($destinationPath, $ImgName);
    $Data['CITY_PHOTO']=$ImgName;
    }

        City::where('CITY_CODE',$id)->update($Data);
        
     

      return redirect(route('city.index'));

      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::where('CITY_CODE',$id)->delete();
         return redirect()->back()->with('message','City is deleted successfully');
    }


     public function cityLists(Request $request){
        
        if(empty($request->search['value']) ) {  

  $Cities=City::join('country', 'country.COUNTRY_ID', '=', 'city.COUNTRY_ID')
            ->join('state', 'state.STATE_CODE', '=', 'city.STATE_CODE')
           ->select(['city.*','country.COUNTRY_NAME','state.NAME'])->offset($request->start)->groupBy('CITY_CODE')->orderBy('CITY_NAME','ASC')->limit($request->length)->get();
  $cTotal=City::count();
   }
    else{
         
    $Cities=City::join('country', 'country.COUNTRY_ID', '=', 'city.COUNTRY_ID')
            ->join('state', 'state.STATE_CODE', '=', 'city.STATE_CODE')
            ->where('city.CITY_NAME','like', '%' .$request->search['value']. '%')->select(['city.*','country.COUNTRY_NAME','state.NAME'])->offset($request->start)->limit($request->length)->groupBy('CITY_CODE')->orderBy('CITY_NAME','ASC')->get();

  $cTotal=City::where('CITY_NAME','like', '%' .$request->search['value']. '%')->count();
    }

      $data=array();
         foreach($Cities as $row)
         {
           
             $sub_array = array();
            
             $frm=' <form id="delete-form-'.$row->CITY_CODE.'" method="post" action="'.route("city.destroy",$row->CITY_CODE).'" style="display: none">'.csrf_field(). method_field("DELETE").'</form>';
            $onclick	= "if(confirm('Are you sure, You Want to delete this?')){event.preventDefault();document.getElementById('delete-form-".$row->CITY_CODE."').submit(); }else{event.preventDefault();}";

             $sub_array[] = $row->CITY_NAME;
             $sub_array[] = $row->NAME;
             $sub_array[] = $row->COUNTRY_NAME;
           
             $sub_array[] = '<a href="'.route("city.edit",$row->CITY_CODE).'" class="btn btn-info btn-xs"> <span class="glyphicon glyphicon-edit"></span></a>&nbsp;'.$frm.' <a href="" class="btn btn-xs btn-danger" onclick="'.$onclick.'" ><span class="glyphicon glyphicon-trash"></span></a>';
            
             $data[] = $sub_array;
             }
                
             $output = array(
             "draw"    => intval($request->draw),
             "recordsTotal"  => count($Cities),
             "recordsFiltered" =>  $cTotal,
             "data"    => $data,
            
            );

             return json_encode($output);
         
    }

    private function getLatlONG($address)
    {
         
    $url = "https://maps.google.com/maps/api/geocode/json?sensor=false&key=AIzaSyCErrMt0mj6St2316G_GpD4dptGv0w7-II&address=".urlencode($address);



    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
    $responseJson = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($responseJson);

    if ($response->status == 'OK') {
        $latitude = $response->results[0]->geometry->location->lat;
        $longitude = $response->results[0]->geometry->location->lng;

               return array('lat'=>$latitude,'long'=>$longitude);

    } else {
       return array('lat'=>0.000000,'long'=>0.000000);
    }    

    }

}
