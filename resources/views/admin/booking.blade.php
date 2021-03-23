<?php 
$ActiveSide='booking';
?>  
@extends('admin.layouts.app')

@section('title','Booking List')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Main content -->
  <section class="content">

    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Booking List</span>
    <span class="info-box-number"></span>
  </div>
  <!-- /.info-box-content -->
</div>

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Booking</h3>
        <div class="box-tools pull-right">
        <div class="btn-group">
                  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i> Update Status</button>
                  <ul class="dropdown-menu" role="menu">
                       <li class="update_booking_status" data-value="PAYMENT PENDING" {{ ($Booking->STATUS == 'PAYMENT PENDING' ) ? 'selected' : '' }}><a href="#">Payment Pending</a></li>

              <li class="update_booking_status" data-value="CANCELED BY HOST" {{ ($Booking->STATUS == 'CANCELED BY HOST' || $Booking->STATUS == 'CANCELED BY TRAVELER' ) ? 'selected' : '' }}><a href="#">Cancel</a></li>

              <li class="update_booking_status" data-value="DECLINED" {{ ($Booking->STATUS == 'DECLINED' ) ? 'selected' : '' }}><a href="#">Declined</a></li>

              <li class="update_booking_status" data-value="PAID" {{ ($Booking->STATUS == 'PAID' ) ? 'selected' : '' }}><a href="#">Paid</a></li>

              <li class="update_booking_status" data-value="COMPLETED" {{ ($Booking->STATUS == 'COMPLETED' ) ? 'selected' : '' }}><a href="#">Completed</a></li>      

                  </ul>
                </div>
              </div>
      </div>
      <div class="box-body">
        <div class="box">
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                            <th><input type="checkbox" class="all_bookingchk" ></th>
                          <th>Booking ID</th>
                          <th>Processed Date</th>
                          <th>Fleet</th>
                          <th>Trip</th>
                          <th>Route</th>
                          <th>Boarding</th>
                          <th>Drop Off</th>
                          <th>Status</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
                      
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
    
     $(document).ready(function() {
      
      getBooking();

     $(document).on('click', ".update_booking_status", function(e) {
       
    var status=$(this).attr('data-value');

     var booking = []; 
   $("input:checkbox[name=bookingstatus]:checked").each(function(){
    booking.push($(this).val());
    });

   
    if(booking.length <= 0)  
    {  
      mytoastr("error","Please select at least one booking.");  
      return false;
    } 
   

      $.ajax({

         url: '{{route("updatemultistatus")}}',
        type: 'POST',
        data : {status:status,booking:booking,_token: "{{csrf_token()}}"},
        dataType: 'json',
        success: function(data){
            
         if(data.success == 1){
          mytoastr('success','Status Update Success');
          $(".all_bookingchk").prop('checked',false);
          getBooking();
           }
           else{
           
               mytoastr("error","Error in update status");  
                }
      },
      error: function(xhr, ajaxOptions, thrownError) {
              mytoastr("error","Error in update status");  
        }
 
        
        });

      }); 

function getBooking() {

       $('#dataTables').DataTable().destroy();

       $('#dataTables').DataTable({
        processing: true,
        serverSide: true,
         responsive: true,
      
            "ajax":{
                     "url": "{{ route('getbooking') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
        columns: [
            {data: 'check', name: 'check', orderable: false, searchable: false},
            {data: 'booking', name: 'booking'},
            {data: 'processed_date', name: 'processed_date', "visible": false,},
            {data: 'fleet', name: 'fleet'},
            {data: 'trip', name: 'trip'},
            {data: 'route', name: 'route'},
            {data: 'boarding', name: 'boarding'},
            {data: 'drop_off', name: 'drop_off'},
            {data: 'status', name: 'status'},
        ]
    });
    
}

   $(document).on('click','.all_bookingchk', function(e) { 
    e.preventDefault;
   
  
  if($(this).is(':checked',true))  
  {
    $(".booking_chk").prop('checked', true);  
  }  
  else  
  {  
    $(".booking_chk").prop('checked',false);  
  }  
});
    
    });
</script>
@endsection