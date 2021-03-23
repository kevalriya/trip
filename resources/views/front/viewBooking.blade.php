<?php 
$ActiveSide='booking';
?>  
@extends('front.layouts.app')

@section('title','TripOn - Booking Detail')
@section('main-content')



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

                       <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#bookingtab">Booking Detail</a></li>
    <li><a data-toggle="tab" href="#passengertab">Passenger Detail</a></li>
    
  </ul>


                <div class="tab-content">
    <div id="bookingtab" class="tab-pane fade in active">
      <br>
                   <div class="col-md-12">

      <div class="panel panel-info">
        <div class="panel-heading">Booking Detail</div>
        <div class="panel-body">
          <div class="col-md-4">
          <p>Booking Id : {{$Booking->BOOKING_ID  }} </p>
          <p>Boarding Point : {{$Booking->BOARDING_POINT }}  </p>
          <p>Dropoff Point  : {{$Booking->DROPOFF_POINT }}  </p>
          <p>Processed Date  : {{ date('Y-m-d',strtotime($Booking->PROCESSED_DATE)) }}  </p>
          <p>Price  : {{$Booking->PRICE }}  </p>
          <p>Discount  : {{$Booking->DISCOUNT }}  </p>
        </div>
          <div class="col-md-4">
          <p>Total Seat Booked : {{$Booking->TOTAL_SEAT_BOOKED  }} </p>
          <p>Adult : {{$Booking->ADULT  }} </p>
          <p>Child : {{$Booking->CHILD }}  </p>
          <p>Special  : {{$Booking->SPECIAL }}  </p>
          <p>Payment Method : {{ $Booking->PAYMENT_METHOD }}  </p>
          <p>Status  : {{$Booking->STATUS}} </p>
        </div>
       
       <div class="col-xs-4"><p>Sub Total: <strong>{{$Booking->SUB_TOTAL }}</strong> </p> </div>
       <div class="col-xs-4"><p>Tax: <strong>{{$Booking->TAX }}</strong> </p> </div>
       <div class="col-xs-4"><p>Total: <strong>{{$Booking->TOTAL }}</strong> </p> </div>

       <div class="clearfix"></div>

       <div class="col-md-4">
          <p>Fleet Name: {{$Booking->bus->FLEET_NAME}} </p>
          <p>Fleet Reg No: {{$Booking->bus->REG_NO }}  </p>
          <p>Route Name: {{$Booking->route->ROUTE_NAME  }} </p>

        </div>

       <div class="col-md-4">
           <p>Trip Name: {{$Booking->trip->TRIP_NAME }} </p>
          <p>Departure Time : {{$Booking->trip->ACTUAL_DEP_TIME }}  </p>
          <p>Arrival Time : {{$Booking->trip->ACTUAL_ARR_TIME }}  </p>
       
        </div>


        </div>
      </div>

   </div>
    

   

        

           <div class="clearfix"></div>   


           </div>  

            <div id="passengertab" class="tab-pane fade">
                  <br>
                     <div class="col-md-12">

 
             <table class="table">
              <tr>
                <th>Seat No</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Price</th>
                <th>Insurance</th>
              </tr>
                @forelse ($Booking->bookingDetails as $detail)
                <tr>
               <td> {{$detail->PASSENGER_SEATNO}}</td>
               <td> {{$detail->PASSENGER_FIRSTNAME}} {{$detail->PASSENGER_LASTNAME}}</td>
               <td>{{$detail->PASSENGER_AGE}}</td>
               <td> {{$detail->PASSENGER_GENDER}}</td>
               <td> {{$detail->TICKETNO_PRICE}}</td>
               <td> {{$detail->INSURANCE_PRICE}}</td>
               </tr>
            @empty
                <tr><td>No record found</td></tr>
            @endforelse

            </table>
           
           

       </div>

            </div>

         </div>
        



                   </div>
              </div>
          

          </div>
            </div>
        </div>

        <div class="gap"></div>
       @endsection
