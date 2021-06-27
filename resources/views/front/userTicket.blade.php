<?php 
$ActiveSide='booking';
?>  
@extends('front.layouts.app')

@section('title','TripOn - Booking Detail')
@section('main-content')
<style>
.tickets {
    border: 5px dashed #999;
}
.ticketHeader {
    background-color: #ED8325;
}
.ticketHeader h2 {
 color: #ffffff;
 font-weight: 600;
 margin-top: 10px;
}
.ticketBody {
    margin-top: 20px;
}
.ticketBody h3 {
   font-weight: 600; 
}
</style>


        <div class="container-fluid">
          <div class="gap"></div>
         </div>

        <div class="container-fluid">
            <div class="row">
              <div class="col-md-3">
                  @include('front.layouts.useraside')
                </div>
                 <div class="col-md-9">
        
   
          <div class="box box-primary">
         
       
              <div class="box-body">

                <h2>Ticket(s)</h2>
                @foreach ($Booking->bookingDetails as $detail)
                    <div class="col-md-12 tickets">
                        <div class="col-xs-12 ticketHeader">
                            <h2>BUS TICKET</h2>
                        </div>
                        <div class="col-xs-12 ticketBody">
                            <div class="col-xs-12">
                                <h3>{{$detail->PASSENGER_FIRSTNAME}} {{$detail->PASSENGER_LASTNAME}}</h3>
                            </div>
                            <div class="col-xs-12">
                                <div class="col-xs-6">
                                    <p>FROM: {{$Booking->BOARDING_POINT}}</p>
                                    <p>TO: {{$Booking->DROPOFF_POINT}}</p>
                                </div>
                                <div class="col-xs-6">
                                    <p>DATE TIME: {{$Booking->PROCESSED_DATE}}</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                @endforeach


                   </div>
              </div>
          

          </div>
            </div>
        </div>

        <div class="gap"></div>
       @endsection