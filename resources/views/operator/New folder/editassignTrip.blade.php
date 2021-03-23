<?php 
$ActiveSide='trip';
?> 	
@extends('admin.layouts.app')

@section('title','Update Assign Trip')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/timepicker/timePicker.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
@endsection
@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->


	  <!-- Main content -->
	  <section class="content">
	  	  <?php
    $ActiveSub="assign";
    ?>
@include('admin.layouts.tripassign')
	  		  	<div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
	  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
	  <div class="info-box-content">
	    <span class="info-box-text">Update Assign Trip</span>
	    <span class="info-box-number"></span>
	  </div>
	  <!-- /.info-box-content -->
	</div>
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->

	        <form role="form" action="{{ route('assigntrip.update',$id) }}" method="post"  enctype="multipart/form-data">

	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Trip Detail</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          
	          {{ csrf_field() }}
	          {{ method_field('PUT') }}
	            <div class="box-body">
	            
	         

	          <?php 
	   if(isset($AssignTrip->TRIP_ASSIGN_ID)){
	   	?>
	   <input type="hidden" name="assignid" value="{{$AssignTrip->TRIP_ASSIGN_ID }}">
	   <?php
	   }
	 
	   ?>
  	<input type="hidden" name="srdate" value="{{$date}}">
  	<input type="hidden" name="gett" value="{{$gett}}">
   	
	   

   <div class="form-group col-md-6">
	        <label for="name">Trip</label>
	       <input type="text" class="form-control"  value="{{ $Trip->TRIP_NAME }} - {{$date}}"disabled>
	         
	    </div>
	    

   <div class="form-group col-md-6">
	        <label for="name">Planned Departure Date</label>
	           <input type="text" class="form-control datepicker" name="dep_date"   value="{{(isset( $AssignTrip->PLANNED_DEP_DATE)) ? date('Y-m-d',strtotime($AssignTrip->PLANNED_DEP_DATE)) : '' }}" >
	         
	    </div>


   <div class="form-group col-md-6">
	        <label for="name">Planned Departure Time</label>
	           <input type="text" class="form-control timepicker" name="dep_time" value="{{(isset( $AssignTrip->PLANNED_DEP_TIME)) ? date('H:i',strtotime($AssignTrip->PLANNED_DEP_TIME)) : '' }}" >
	         
	    </div>

 



   <div class="form-group col-md-6">
	        <label for="name">Planned Arrival Date</label>
	           <input type="text" class="form-control datepicker" name="arr_date"  value="{{(isset( $AssignTrip->PLANNED_ARR_TIME)) ? date('Y-m-d',strtotime($AssignTrip->PLANNED_ARR_TIME)) : '' }}" >
	         
	    </div>


   <div class="form-group col-md-6">
	        <label for="name">Planned Arrival Time</label>
	           <input type="text" class="form-control timepicker" name="arr_time" value="{{(isset( $AssignTrip->PLANNED_DEP_TIME)) ? date('H:i',strtotime($AssignTrip->PLANNED_DEP_TIME)) : '' }}" >
	         
	    </div>



	    <?php
	    if(isset($AssignTrip->SCHEDULED_FLAG )){
	    	$SCHEDULED_FLAG=$AssignTrip->SCHEDULED_FLAG;
	    }
	    else{
	    	$SCHEDULED_FLAG='N';
	    }
	    ?>
  
   <div class="form-group col-md-6">
	        <label for="name">Scheduled</label>
	         <select class="form-control" name="scheduled">
	         	<option value="N" <?php echo ($SCHEDULED_FLAG == 'N') ? 'selected' : '' ?>>No</option>
	         	<option value="Y" <?php echo ($SCHEDULED_FLAG == 'Y') ? 'selected' : '' ?>>Yes</option>
	         </select>
	    </div>


	   

				<div class="clearfix"></div>

	            <div class="form-group col-md-3">
	             <button type="submit" class="btn btn-primary">Submit</button>
	             
	            </div>
	            	<hr>

	       		<div class="clearfix"></div>
				 <div id="routepoints-result"> </div>
	            </div>

			
				</div>

	          </form>


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

<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/plugins/timepicker/jquery-timepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
  $(document).ready(function() {
  		  $(".timepicker").hunterTimePicker();
  			$('.datepicker').datepicker({
  				  format: 'yyyy-mm-dd',
      autoclose: true,
    });
  		
  });

    

</script>
@endsection