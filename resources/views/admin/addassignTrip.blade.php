<?php 
$ActiveSide='trip';
?> 	
@extends('admin.layouts.app')

@section('title','Assign Trip')
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

	  	<div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
	  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
	  <div class="info-box-content">
	    <span class="info-box-text">Assign Trip</span>
	    <span class="info-box-number"></span>
	  </div>
	  <!-- /.info-box-content -->
	</div>

	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->

	        <form role="form" action="{{ route('assigntrip.store') }}" method="post"  enctype="multipart/form-data">

	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Trip Detail</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          
	          {{ csrf_field() }}
	          {{ method_field('POST') }}
	            <div class="box-body">
	          

   		 <div class="form-group col-md-6">
	                <label for="name">Fleet Type</label>
	           
	                 <select class="form-control select2" name="fleet_type" data-placeholder="Select Fleet Type" id="route-point" aria-hidden="true">
	                 	<option value="">Select Type</option>
                    @foreach ($fleetTypes as $Type)
                    <option value="{{ $Type->FLEET_TYPE_CODE }}">{{ $Type->FLEET_TYPE_NAME }}</option>
                    @endforeach
        </select>
	         
	    </div>	
	    



   <div class="form-group col-md-6">
	        <label for="name">Planned Departure Date</label>
	           <input type="text" class="form-control datepicker" name="dep_date" value="{{old('dep_date')}}" >
	         
	    </div>


   <div class="form-group col-md-6">
	        <label for="name">Planned Departure Time</label>
	           <input type="text" class="form-control timepicker" name="dep_time" value="{{old('dep_time')}}" >
	         
	    </div>


   <div class="form-group col-md-6">
	        <label for="name">Planned Arrival Date</label>
	           <input type="text" class="form-control datepicker" name="arr_date" value="{{old('arr_date')}}" >
	         
	    </div>


   <div class="form-group col-md-6">
	        <label for="name">Planned Arrival Time</label>
	           <input type="text" class="form-control timepicker" name="arr_time" value="{{old('arr_time')}}" >
	         
	    </div>

 


   <div class="form-group col-md-6">
	        <label for="name">Scheduled</label>
	         <select class="form-control" name="scheduled">
	         	<option value="N">No</option>
	         	<option value="Y">Yes</option>
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