<?php 
$ActiveSide='trip';
?> 
@extends('admin.layouts.app')

@section('title','Assign Trip')
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
    <span class="info-box-text">Assign Trip</span>
    <span class="info-box-number"></span>
  </div>
  <!-- /.info-box-content -->
</div>
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Assign Trip List</h3>
       
      

         <div class="col-md-3 pull-right">
                  <label for="name">Trip</label>
                   <select class="form-control select2" id="triplist"   data-placeholder="Select Fleet Type" id="route-point" aria-hidden="true">
                   
                    @foreach ($Trips as $Trip)
                    <option value="{{ $Trip->TRIP_ID }}">{{ $Trip->TRIP_NAME }}</option>
                    @endforeach
        </select>
         </div>
      <div class="clearfix"></div>
      </div>
      <div class="box-body">
        <div class="box">
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="report_result">
                    </div>
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
     
    getReport();
    
       $(document).on('change','#triplist',function (e) {
   
         getReport();
      });



  
    
    });


   function getReport(){
  
    var trip=$('#triplist').val();
   

      $.ajax({
        url: "{{route('assigntripData')}}",
        type: "POST",
        data : { _token: "{{csrf_token()}}",trip:trip},
       
        success: function(data){
        $('.report_result').empty();
        $('.report_result').html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    }


</script>
@endsection