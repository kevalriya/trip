<?php 
$ActiveSide='operator';
?>  
@extends('admin.layouts.app')

@section('title','Operators')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->


  <!-- Main content -->
  <section class="content">
       <?php
    $ActiveSub="operator";
    ?>
@include('admin.layouts.userHeader')

<div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Operators</span>
    <span class="info-box-number"></span>
  </div>
  <!-- /.info-box-content -->
</div>
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Operators</h3>
        <a class='col-md-2 pull-right btn btn-success' href="{{ route('operator.create') }}">Add Operator</a>
     
      </div>
      <div class="box-body">
        <div class="box">
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th>Legel Name</th>
                          <th>City</th>
                          <th>Contact Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Fleet Size</th>
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
<script>
   $(document).ready(function() {
     
        $('#dataTables').DataTable({
            "processing": true,
            "serverSide": true,
         responsive: true,
            "ajax":{
                     "url": "{{ route('operatorData') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
       

        });
  

  
    
    });
</script>
@endsection