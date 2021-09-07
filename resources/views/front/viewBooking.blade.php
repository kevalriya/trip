<?php 
$ActiveSide='booking';
?>  
@extends('front.layouts.app')

@section('title','TripOn - Booking Detail')
@section('main-content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.0/jquery.fancybox.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/qrcode.js') }}"></script>
<script>
function addScript(url) {
    var script = document.createElement('script');
    script.type = 'application/javascript';
    script.src = url;
    document.head.appendChild(script);
}
addScript('https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js');
</script>
<style>
.tickets {
    border: 5px dashed #999999;
    margin-top: 20px;
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
.p-4{
  padding: 20px 10px;
}
.tickets p {
  font-size: 18px;
}
.bgGrey {
  background-color: #e0e0e0;
  padding: 10px;
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

                       <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#bookingtab">Booking Detail</a></li>
    <li><a data-toggle="tab" href="#passengertab">Passenger Detail</a></li>
   <li><a data-toggle="tab" href="#tickettab">Ticket(s)</a></li>
    
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
                <th>Insurance</th>
              </tr>
                @forelse ($Booking->bookingDetails as $detail)
                <tr>
               <td> {{$detail->PASSENGER_SEATNO}}</td>
               <td> {{$detail->PASSENGER_FIRSTNAME}} {{$detail->PASSENGER_LASTNAME}}</td>
               <td>{{$detail->PASSENGER_AGE}}</td>
               <td> {{$detail->PASSENGER_GENDER}}</td>
               <td> {{$detail->INSURANCE === 1 ? 'CHOSEN' : 'DECLINED'}}</td>
               </tr>
            @empty
                <tr><td>No record found</td></tr>
            @endforelse

            </table>
           
           

       </div>

            </div>

             <div id="tickettab" class="tab-pane fade">

                <br>
                  <div class="col-md-12">
                    <div class="box-body">
                    <div class="col-xs-8"><h2>Ticket(s)</h2></div>
                     
                     <div class="col-xs-4">
                       <button onclick="printDiv()"><i class="fa fa-print fa-3x" aria-hidden="true"></i></button>
                       <button onclick="pdf()"><i class="fa fa-download fa-3x" aria-hidden="true"></i></button>
                      </div>
                     <div id="DivIdToPrint">
                      @foreach ($Booking->bookingDetails as $detail)
                          <div class="col-md-12 tickets">
                              
                              <div class="col-xs-12 ticketBody">
                                  <div class="col-sm-6 col-xs-12 p-4">
                                      <h3>{{$detail->PASSENGER_FIRSTNAME}} {{$detail->PASSENGER_LASTNAME}}</h3>
                                    <p><b>TRIP NAME:</b> {{$Booking->trip->TRIP_NAME }}</p>
                                    <p><b>FLEET NAME:</b> {{$Booking->bus->FLEET_NAME}} </p>
                                    <p><b>FLEET REG NO:</b> {{$Booking->bus->REG_NO }}  </p>
                                    <p><b>ROUTE NAME:</b> {{$Booking->route->ROUTE_NAME  }} </p>
                                      
                                     
                                  
                                  </div>
                                  <div class="col-sm-6 col-xs-12 p-4">
                                    <h3 style='color: green;'>SEAT NO: {{$detail->PASSENGER_SEATNO}}</h3>
                                      <!-- <a data-fancybox="gallery" class="primary-btn" href="https://cdn-codespeedy.pressidium.com/wp-content/uploads/2020/02/Qrcode.png"> <img src="https://cdn-codespeedy.pressidium.com/wp-content/uploads/2020/02/Qrcode.png" alt="barcode" style="width: 150px;" /></a> -->
                                      {!! QrCode::size(160)->generate($detail->BARCODE); !!}
                                      
                                  </div>
                                  <div class="col-xs-12 p-4 bgGrey">
                                      <div class="col-sm-6 col-xs-12">
                                          <h3>DEPEARTURE:</h3>
                                          <p><b>FROM:</b> {{$Booking->BOARDING_POINT}}</p>
                                          <p><b>DATE:</b> {{$Booking->trip->fromDate}}</p>
                                          <?php
                                            $ddate = strtotime($Booking->trip->ACTUAL_DEP_TIME);
                                          ?>
                                           <p><b>TIME:</b> {{date("h:i A", $ddate)}}</p>
                                          
                                      </div>
                                      <div class="col-sm-6 col-xs-12">
                                        <h3>ARRIVAL:</h3>
                                          <p><b>TO:</b> {{$Booking->DROPOFF_POINT}}</p>
                                          <p><b>DATE:</b> {{$Booking->trip->toDate}}</p>
                                           <?php
                                            $adate = strtotime($Booking->trip->ACTUAL_ARR_TIM);
                                          ?>
                                          <p><b>TIME:</b> {{date("h:i A", $adate)}}</p>
                                      </div>
                                      
                                  </div>
                                  <div class="col-sm-6 col-xs-12 p-4">
                                    <p><b>PAYMENT STATUS:</b> <?php 
                                    if($Booking->PAYMENT_STATUS === "SUCCESS") {
                                      echo "<b style='color: green;'>" . $Booking->PAYMENT_STATUS . "</b>"; 
                                      } else { echo  "<b style='color: red;'>" . $Booking->PAYMENT_STATUS . "</b>";
                                      }
                                      ?></p>
                                  </div>
                                  <div class="col-sm-6 col-xs-12 p-4">
                                    <p><b>INSURANCE:</b> {{$Booking->TRAVEL_INS_FLAG}}</p>
                                  </div>
                                   <div class="col-sm-6 col-xs-12 p-4">
                                    <span>{{$Booking->TX_REF}}</span>
                                  </div>
                                  <div class="col-sm-6 col-xs-12 p-4">
                                    <span>{{$detail->BARCODE}}</span>
                                  </div>
                              </div>
                              
                          </div> 
                      @endforeach
                      </div>
                   </div>
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
<script>
function printDiv() 
{
  // var divToPrint=document.getElementById('DivIdToPrint');
  
  var element = document.getElementById('DivIdToPrint');
  var opt = {
  margin:       1,
  filename:     'Ticket.pdf',
  jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
};
html2pdf().set(opt).from(element).toPdf().get('pdf').then(function (pdfObj) {
    // pdfObj has your jsPDF object in it, use it as you please!
    // For instance (untested):
    pdfObj.autoPrint();
    var newWin = window.open(pdfObj.output('bloburl'));

    // var newWin=window.open('','Print-Window');
  // newWin.document.open();
  // newWin.document.write('<html><body onload="window.print()"><object width="100%" height="100%" data="'+pdfObj.output('bloburl')+'"></object></body></html>');
  // newWin.document.close();
  // setTimeout(function(){newWin.close();},10);
});
}
function pdf() {
  var element = document.getElementById('DivIdToPrint');
  var opt = {
  margin:1,
  filename:'Ticket.pdf',
  jsPDF:{ unit: 'in', format: 'letter', orientation: 'landscape' }
};
  // html2pdf(element, opt);
  html2pdf().set(opt).from(element).save();
}


</script>