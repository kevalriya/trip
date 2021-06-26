<?php 
$ActiveSide='booking';
?>  
@extends('front.layouts.app')

@section('title','TripOn - Booking History')

@section('main-content')



<style type="text/css">
    div#booking_table_paginate,#booking_table_filter{
        float: right;
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
                   
                    <table class="table table-bordered table-striped table-booking-history" id="booking_table">
                        <thead>
                            <tr>
                                
                          <th>Booking ID</th>
                          <th>Fleet</th>
                          <th>Trip</th>
                          <th>Route</th>
                          <th>Boarding</th>
                          <th>Drop Off</th>
                          <th>Status</th>
                          <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="gap"></div>
      
@endsection

@section('footerSection')    

            <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip(); 
     fetch_data();



    $(document).on('click', ".cancel-booking", function(e) {
      e.preventDefault;
         var t=this;

        var id=$(this).attr('data-id');
        var uid=$(this).attr('data-uid');
            $.ajax({
                url: 'cpresponse.php',
                data: {action:'cancelBooking',uid:uid,id:id},
                type: 'POST',
                dataType: 'json',
                success: function(response){
                

                },
                error: function(e){
                  alert('Error processing your request: '+e.responseText);
                }
              });
          

   });

   });

 function fetch_data()
 {

    $('#booking_table').DataTable({
        processing: true,
        serverSide: true,
         responsive: true,
      
            "ajax":{
                     "url": "{{ route('bookingData') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
        columns: [
            {data: 'booking', name: 'booking'},
            {data: 'fleet', name: 'fleet'},
            {data: 'trip', name: 'trip'},
            {data: 'route', name: 'route'},
            {data: 'boarding', name: 'boarding'},
            {data: 'drop_off', name: 'drop_off'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });


 }
 
</script>
  
@endsection




