<?php 
$ActiveSide='trip';
?>  
@extends('admin.layouts.app')

@section('title','Trip')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('admin/dist/css/info.css') }}">
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
    <span class="info-box-number">Trip List</span>
        @foreach ($data as $i)
        <textarea id="tabInfo" data-id="{{$i->id}}" readonly>{{$i->description}}</textarea>
        @endforeach
      <button class="btn-aqua" id="infoUpdate"><i class="fa fa-check fa-2x"></i></button>
  </div>
  
  <!-- /.info-box-content -->
</div>
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Trip List</h3>
        <a class='col-md-2 pull-right btn btn-success' href="{{ route('trip.create') }}">Add Trip</a>
     
      </div>
      <div class="box-body">
        <div class="box">
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th>Trip ID</th>
                         
                          <th>Operator</th>
                          <th>Route</th>
                          <th>Fare</th>
                          <th>Fleet ID</th>
                           <th>Driver</th>
                          <th>Departure</th>
                          
                          <th>Max Seat</th>
                          <th>Sold Seat</th>
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
<script src="{{ asset('admin/dist/js/info.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script>
  updateInformation("{{route('trip.tabInfo')}}", '{{csrf_token()}}');
   $(document).ready(function() {
     
        $('#dataTables').DataTable({
            "processing": true,
            "serverSide": true,
            "orderable": false,
         responsive: true,
            "columnDefs": [
      { "width": "5%", "targets": 0 },
      { "width": "15%", "targets": 1 },
      { "width": "15%", "targets": 2 },
      { "width": "5%", "targets": 3 },
      { "width": "5%", "targets": 4 },
      { "width": "10%", "targets": 5 },
      { "width": "10%", "targets": 6 },
      { "width": "5%", "targets": 7 },
      { "width": "5%", "targets": 8 },
      { "width": "5%", "targets": 9 },
      { "width": "10%", "targets": 10 },
    ],
    /* dom: 'Bfrtip',
        buttons: [
              {
               extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8 ]
                }
            },
        ],*/
  
            "ajax":{
                     "url": "{{ route('tripData') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
       

        });
  

  
    
    });
</script>
@endsection