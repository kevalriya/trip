<?php 
$ActiveSide='trip';
?> 	
@extends('operator.layouts.app')

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

	    <ul class="nav nav-tabs">
 
  <li ><a  href="{{route('opeditTripschedule',$Trip->TRIP_ID)}}">Schedule</a></li>
  <li ><a  href="{{route('opeditTripTime',$Trip->TRIP_ID)}}">Itinerary</a></li>
   <li ><a  href="{{route('opeditTripFare',$Trip->TRIP_ID)}}">Fare</a></li>
    <li > <a href="{{route('opstartTrip',$Trip->TRIP_ID)}}">Start Trip</a></li>

    <li class="active"> <a href="{{route('opendTrip',$Trip->TRIP_ID)}}">End Trip</a></li>
 
</ul>


	  		  	<div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
	  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
	  <div class="info-box-content">
	    <span class="info-box-number">End Trip</span>
	     @foreach ($data as $i)
        <span id="tabInfo" data-id="{{$i->id}}" readonly>{{$i->description}}</span>
        @endforeach
	  </div>
	  <!-- /.info-box-content -->
	</div>
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->

	        <form role="form" action="{{ route('opeditendTrip',$id) }}" method="post"  enctype="multipart/form-data">

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
	        <label for="name">Actual Arrival Date</label>
	           <input type="text" class="form-control datepicker" name="act_arr_date"  value="{{(isset( $AssignTrip->ACTUAL_ARR_DATE)) ? date('Y-m-d',strtotime($AssignTrip->ACTUAL_ARR_DATE)) :  date('Y-m-d') }}"  required>
	         
	    </div>

<div class="clearfix"></div>
	    
   <div class="form-group col-md-4">
	        <label for="name">Actual Arrival Time</label>
	           <input type="text" class="form-control timepicker" name="act_arr_time"  value="{{(isset( $AssignTrip->ACTUAL_ARR_TIME)) ? date('H:i',strtotime($AssignTrip->ACTUAL_ARR_TIME)) : date('H:i') }}" required>
	         
	    </div>
 
<div class="clearfix"></div>
   		
	    
   <div class="form-group col-md-4">
	        <label for="name">End Odometer</label>
	           <input type="text" class="form-control" name="e_odometer"  value="{{(isset( $AssignTrip->END_ODOMETER)) ?  $AssignTrip->END_ODOMETER  : '' }}" required>
	         
	    </div>
   <div class="clearfix"></div>
   <div class="form-group col-md-4">
	        <label for="name"> Total Income</label>
	           <input type="text" class="form-control" name="totalIncome" value="{{(isset( $AssignTrip->TOTAL_INCOME)) ?  $AssignTrip->TOTAL_INCOME  : '' }}">
	         
	    </div>
	    <div class="clearfix"></div>
   <div class="form-group col-md-4">
	        <label for="name"> Total Expense</label>
	           <input type="text" class="form-control" name="totalexpense" value="{{(isset( $AssignTrip->TOTAL_EXPENSE)) ?  $AssignTrip->TOTAL_EXPENSE  : '' }}">
	         
	    </div>
<div class="clearfix"></div>
   
   <div class="form-group col-md-4">
	        <label for="name">Total Fuel Cost</label>
	           <input type="text" class="form-control" name="fuel" value="{{(isset( $AssignTrip->TOTAL_FUEL)) ?  $AssignTrip->TOTAL_FUEL  : '' }}">
	         
	    </div>

<div class="clearfix"></div>

 
   <div class="form-group col-md-4">
	        <label for="name">Driver Closing Notes</label>
	        <textarea class="form-control" name="comment" rows="3">{{(isset( $AssignTrip->TRIP_COMMENT)) ?  $AssignTrip->TRIP_COMMENT  : '' }}</textarea>
	    </div>

<div class="clearfix"></div>
   		

	    
   		
	   

				<div class="clearfix"></div>

	            <div class="form-group col-md-3">
	             <button type="submit" class="btn btn-primary">Close Trip</button>
	             
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