<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Routepoint;

class TicketController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getTicketPoint(Request $request)
    {
        if(empty($request->route)) {
            die('missing route');
        }
          $RoutePoint=Routepoint::join('city', 'city.CITY_CODE', '=', 'route_stoppoint.CITY_CODE')->where('ROUTE_ID',$request->route)->orderBy('ROUTE_STOPPOINT_SEQNO', 'ASC')->select(['route_stoppoint.*','city.CITY_NAME'])->get()->toArray();
          return view('admin.ticketPrice',compact('RoutePoint'));
    }
}
