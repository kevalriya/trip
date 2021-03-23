<?php 
$ActiveSide='booking';
?>   
@extends('operator.layouts.app')

@section('title','Booking Detail')

@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">


      <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
    <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
    <div class="info-box-content">
      <span class="info-box-text"># {{$Booking->BOOKING_ID}}</span>
      <span class="info-box-number"></span>
    </div>
    <!-- /.info-box-content -->
  </div>

      <div class="row">
        <div class="col-md-12">
        
   
      
        
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
          <p>Status  : 

            <select class="form-control changebooking_status" style="display: inline;width: 45%;">
              <option value="PAYMENT PENDING" {{ ($Booking->STATUS == 'PAYMENT PENDING' ) ? 'selected' : '' }}>Payment Pending</option>
              <option value="CANCELED BY HOST" {{ ($Booking->STATUS == 'CANCELED BY HOST' || $Booking->STATUS == 'CANCELED BY TRAVELER' ) ? 'selected' : '' }}>Cancel</option>
              <option value="DECLINED" {{ ($Booking->STATUS == 'DECLINED' ) ? 'selected' : '' }}>Declined</option>
              <option value="PAID" {{ ($Booking->STATUS == 'PAID' ) ? 'selected' : '' }}>Paid</option>
              <option value="COMPLETED" {{ ($Booking->STATUS == 'COMPLETED' ) ? 'selected' : '' }}>Completed</option>
            </select>
             
             </p>
        </div>
       
       <div class="col-xs-4"><p>Sub Total: <strong>{{$Booking->SUB_TOTAL }}</strong> </p> </div>
       <div class="col-xs-4"><p>Tax: <strong>{{$Booking->TAX }}</strong> </p> </div>
       <div class="col-xs-4"><p>Total: <strong>{{$Booking->TOTAL }}</strong> </p> </div>
        </div>
      </div>

   </div>
    


   <div class="clearfix"></div>
              <div class="col-md-6">

      <div class="panel panel-info">
        <div class="panel-heading">Client Detail</div>
        <div class="panel-body">
          <p>Name: {{$Booking->user->FIRSTNAME}} {{$Booking->user->MIDDLENAME}} {{$Booking->user->MIDDLENAME}} </p>
          <p>Email: {{$Booking->user->EMAIL_ADDRESS }}  </p>
          <p>Phone: {{$Booking->user->PHONE_NUMBER1}}  </p>
          <p>Phone 2: {{$Booking->user->PHONE_NUMBER2}}  </p>
        </div>
      </div>

   </div>     
              <div class="col-md-6">

      <div class="panel panel-info">
        <div class="panel-heading">Fleet Detail</div>
        <div class="panel-body">
        <div class="col-md-6">
          <p>Name: {{$Booking->bus->FLEET_NAME}} </p>
          <p>Make: {{$Booking->bus->MAKE }}  </p>
          <p>Model: {{$Booking->bus->MODEL }}  </p>
          <p>Reg No: {{$Booking->bus->REG_NO }}  </p>
        </div>
         <div class="col-md-6">
          <p>Seat Capacity: {{$Booking->bus->SEAT_CAPACITY }}  </p>
          <p>Home Terminal: {{$Booking->bus->home_terminal }}  </p>
        </div>
        <div class="clearfix"></div>
        </div>
      </div>

   </div>
   
   <div class="col-md-6">

      <div class="panel panel-info">
        <div class="panel-heading">Trip Detail</div>
        <div class="panel-body">
             <p>Name: {{$Booking->trip->TRIP_NAME }} </p>
          <p>Departure Time : {{$Booking->trip->ACTUAL_DEP_TIME }}  </p>
          <p>Arrival Time : {{$Booking->trip->ACTUAL_ARR_TIME }}  </p>
       
        </div>
      </div>

   </div>
        
   <div class="col-md-6">

      <div class="panel panel-info">
        <div class="panel-heading">Route Detail</div>
        <div class="panel-body">
          <p>Name: {{$Booking->route->ROUTE_NAME  }} </p>
          <p>Origin : {{$Booking->route->ACTUAL_DEP_TIME }}  </p>
          <p>Destination : {{$Booking->route->DEST_CITY  }}  </p>
       
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
          <!-- /.box -->

          
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
@endsection
@section('footerSection')

<script>
  $(document).ready(function() {
        
   $(document).on('change', ".changebooking_status", function(e) {
       
    var status=$('option:selected',this).val();

      $.ajax({

         url: '{{route("operator.booking.update",$Booking->BOOKING_ID)}}',
        type: 'PUT',
        data : {status:status, _token: "{{csrf_token()}}"},
        dataType: 'json',
        success: function(data){
            
         if(data.success == 1){
          alert('Status Update Success');
           }
           else{
              alert('Error in update status');
                }
      },
      error: function(xhr, ajaxOptions, thrownError) {
            alert('Error in update status');
        }
 
        
        });

      }); 
  });

  
</script>
@endsection