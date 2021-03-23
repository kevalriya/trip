<?php 
$ActiveSide='fleet';
?>  
@extends('operator.layouts.app')

@section('title','Fleet Type')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Main content -->
  <section class="content">

    <?php
    $ActiveSub="fleettype";
    ?>
@include('operator.layouts.fleetHeader')
    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Fleet Parent Type</span>
    <span class="info-box-number"></span>
  </div>
  <!-- /.info-box-content -->
</div>
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Fleet Type</h3>
        <a href="{{route('opcreateFleetType')}}" class='col-md-2 pull-right btn btn-success' >Add New</a>
     
      </div>
      <div class="box-body">
        <div class="box">
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th>Parent Type</th>
                          <th>Type Name</th>
                          <th>Seat Count</th>
                          <th>Action</th>
                         
                        </tr>
                        </thead>
                        <tbody>
                         @foreach ($Types as $Type)
                          <tr>
                           
                            <td >{{ $Type->PARENT_TYPE_NAME }}</td>
                            <td >{{ $Type->FLEET_TYPE_NAME }}</td>
                            <td >{{ $Type->SEAT_COUNT }}</td>
                              <td>
                             <a href="{{route('opeditFleetType',$Type->FLEET_TYPE_CODE)}}" class="btn btn-xs btn-primary"> <span class="glyphicon glyphicon-edit"></span></a>

                              <form id="delete-form-{{ $Type->FLEET_TYPE_CODE }}" method="post" action="{{ route('opfleetType.destroy',$Type->FLEET_TYPE_CODE) }}" style="display: none">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                </form>
                                <button  class="btn btn-xs btn-danger"  onclick="
                                if(confirm('Are you sure, You Want to delete this?'))
                                    {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $Type->FLEET_TYPE_CODE }}').submit();
                                    }
                                    else{
                                      event.preventDefault();
                                    }" ><span class="glyphicon glyphicon-trash"></span></button>

                                    <a href="{{route('opaddseatMap',$Type->FLEET_TYPE_CODE)}}" class="btn btn-xs btn-warning"> <span class="glyphicon glyphicon-th-large"></span></a>
                              </td>
                            </tr>
                          </tr>
                        @endforeach
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

    
  
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
   $(document).ready(function() {
     
  
$('#dataTables').DataTable();

 });
</script>
@endsection