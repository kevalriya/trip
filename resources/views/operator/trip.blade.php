<?php 
$ActiveSide='trip';
?>  
@extends('operator.layouts.app')

@section('title','Trip')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
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
    <span class="info-box-text">Trip List</span>
    <span class="info-box-number"></span>
  </div>
  <!-- /.info-box-content -->
</div>
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Trip List</h3>
        <a class='col-md-2 pull-right btn btn-success' href="{{ route('operator.trip.create') }}">Add Trip</a>
     
      </div>
      <div class="box-body">
        <div class="box">
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th>Trip ID</th>
                         
                          <th>Route</th>
                          <th>Fare</th>
                          <th>Fleet ID</th>
                          <th>Departure</th>
                          
                          <th>Max Seat</th>
                          <th>Status</th>
                          <th>Action</th>
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
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script>
   $(document).ready(function() {
     
        $('#dataTables').DataTable({
            "processing": true,
            "serverSide": true,
            "orderable": false,
         responsive: true,
   

            "ajax":{
                     "url": "{{ route('optripData') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },

           columns: [
            {data: 'trip_id', name: 'trip_id'},
            {data: 'route_name', name: 'route_name'},
            {data: 'fare', name: 'fare'},
            {data: 'reg_id', name: 'reg_id'},
            {data: 'dep_time', name: 'dep_time'},
            {data: 'max_seat', name: 'max_seat'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        });
  

  
    
    });
</script>
@endsection