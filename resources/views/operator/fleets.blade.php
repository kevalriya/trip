<?php 
$ActiveSide='fleet';
?>  
@extends('operator.layouts.app')

@section('title','Fleets')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Main content -->
  <section class="content">

    <?php
    $ActiveSub="fleet";
    ?>
@include('operator.layouts.fleetHeader')



    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-number">Fleet Parent Type</span>
    @foreach ($data as $i)
        <span id="tabInfo" data-id="{{$i->id}}" readonly>{{$i->description}}</span>
        @endforeach
  </div>
  <!-- /.info-box-content -->
</div>

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Fleets</h3>
        <a class='col-md-2 pull-right btn btn-success' href="{{ route('operator.fleet.create') }}">Add Fleet</a>
     
      </div>
      <div class="box-body">
        <div class="box">
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th>Fleet Name</th>
                          <th>Route</th>
                          <th>Reg No</th>
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
<script>
   $(document).ready(function() {
     
    $('#dataTables').DataTable({
        processing: true,
        serverSide: true,
         responsive: true,
            "ajax":{
                     "url": "{{ route('opfleetsData') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },

        columns: [
            {data: 'fleet_name', name: 'fleet_name'},
            {data: 'route_name', name: 'route_name'},
            {data: 'reg_no', name: 'reg_no'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

  
    
    });
</script>
@endsection