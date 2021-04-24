<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Amenitie;
use Illuminate\Support\Facades\Hash;
use App\Tab;
use Illuminate\Http\Request;

class AmenitieController extends Controller
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
      
        $Amenities=amenitie::orderBy('AMENITY_NAME', 'ASC')->get();
        $data=Tab::where('id',22)->get();
        return view('admin.amenitie',compact('Amenities'), ['data'=>$data]);
    }

   

    public function destroy($id)
    {
        amenitie::where('AMENITY_ID',$id)->delete();
        return redirect()->back()->with('message','User is deleted successfully');
    }


  
}
