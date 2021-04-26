<?php 
$ActiveSide='trip';

?>  	
@extends('admin.layouts.app')

@section('title','Start Trip')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/timepicker/timePicker.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" href="{{ asset('admin/dist/css/info.css') }}">
@endsection
@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->


	  <!-- Main content -->
	  <section class="content">

	  		  	    
 	    <ul class="nav nav-tabs">
  <li><a  href="{{route('editTripschedule',$Trip->TRIP_ID)}}">Schedule</a></li>
  <li><a  href="{{route('editTripTime',$Trip->TRIP_ID)}}">Itinerary</a></li>
   <li><a  href="{{route('editTripFare',$Trip->TRIP_ID)}}">Fare</a></li>
    <li class="active"> <a href="{{route('startTrip',$Trip->TRIP_ID)}}">Start Trip</a></li>

    <li> <a href="{{route('endTrip',$Trip->TRIP_ID)}}">End Trip</a></li>
 
</ul>

	  		  	<div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
	  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
	  <div class="info-box-content">
	    <span class="info-box-number">Start Trip</span>
	    @foreach ($data as $i)
        <textarea id="tabInfo" data-id="{{$i->id}}" readonly>{{$i->description}}</textarea>
        @endforeach
      <button class="btn-aqua" id="infoUpdate"><i class="fa fa-check fa-2x"></i></button>
	  </div>
	  <!-- /.info-box-content -->
	</div>
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->

	        <form role="form" action="{{ route('editstartTrip',$id) }}" method="post"  enctype="multipart/form-data">

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

	   

   <div class="form-group col-md-4">
	        <label for="name">Trip</label>
	       <input type="text" class="form-control"  value="{{ $Trip->TRIP_ID }}" disabled>
	         
	    </div>
	    
	    <div class="clearfix"></div>
   		

   <div class="form-group col-md-4">
	        <label for="name">Actual Departure Date</label>
	           <input type="text" class="form-control datepicker" name="act_dep_date"  value="{{(isset( $AssignTrip->ACTUAL_DEP_DATE)) ? date('Y-m-d',strtotime($AssignTrip->ACTUAL_DEP_DATE)) : '' }}" >
	         
	</div>
<div class="clearfix"></div>

	    
   <div class="form-group col-md-4">
	        <label for="name">Actual Departure Time</label>
	        <input type="text" class="form-control timepicker" name="act_dep_time" value="{{(isset( $AssignTrip->ACTUAL_DEP_TIME)) ? date('H:i',strtotime($AssignTrip->ACTUAL_DEP_TIME)) : '' }}" >
	         
	    </div>
	    <div class="clearfix"></div>
   <div class="form-group col-md-4">
	        <label for="name">Begin Odometer</label>
	           <input type="text" class="form-control" name="b_odometer"  value="{{(isset( $AssignTrip->BEGIN_ODOMETER)) ?  $AssignTrip->BEGIN_ODOMETER  : '' }}" >
	         
	    </div>
	    <div class="clearfix"></div>
   <div class="form-group col-md-4">
	        <label for="name">Total Passenger Count</label>
	           <input type="text" class="form-control" name="totalpassenger"  value="{{(isset( $AssignTrip->TotalPassenger)) ?  $AssignTrip->TotalPassenger  : '' }}" >
	         
	    </div>
<div class="clearfix"></div>
	    
				<div class="clearfix"></div>

	            <div class="form-group col-md-3">
	             <button type="submit" class="btn btn-primary">Begin Trip</button>
	             
	            </div>
	            	<hr>

	       		<div class="clearfix"></div>
			
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
<script src="{{ asset('admin/dist/js/info.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/plugins/timepicker/jquery-timepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
updateInformation("{{route('trip.tabInfo')}}", '{{csrf_token()}}');
  $(document).ready(function() {
  		  $(".timepicker").hunterTimePicker();
  			$('.datepicker').datepicker({
  				  format: 'yyyy-mm-dd',
      autoclose: true,
    });
  		
  });

    

</script>
@endsection