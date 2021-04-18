<?php 
$ActiveSide='trip';
?> 	
@extends('admin.layouts.app')

@section('title','Add Trip')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/timepicker/timePicker.css') }}">
<link rel="stylesheet" href="{{ asset('admin/dist/css/info.css') }}">
<style type="text/css">
	.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #337ab7 !important;}
</style>
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
	    <span class="info-box-number">Add Trip</span>
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

	        <form role="form" action="{{ route('trip.store') }}" method="post"  enctype="multipart/form-data">

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
	                <label for="name">Trip Name</label>
	                <input type="text" class="form-control" name="trip_name" value="{{old('trip_name')}}" placeholder="Trip Name" >
	       </div>
<div class="clearfix"></div>


                  <div class="form-group col-md-6">
                   <label> Operator </label>
                   <select class="form-control select2 required" name="operator" id="operator"  data-placeholder="Select a City" aria-hidden="true">
                    <option value="">Select Operator</option>
                    @foreach ($Operators as $Operator)
                    <option value="{{ $Operator->OPERATOR_CODE }}">{{ $Operator->OPERATOR_LEGAL_NAME }}</option>
                    @endforeach
                  </select>
                </div>
         <div class="clearfix"></div>
   		 <div class="form-group col-md-6">
	                <label for="name">Route</label>
	           
	                 <select class="form-control select2" name="route"  data-placeholder="Select Fleet Type" id="route" aria-hidden="true">
	                 	<option value="">Select Route</option>
                   
        </select>
	         
	    </div>	

<div class="clearfix"></div>	    

	     <div class="form-group col-md-6">
	                <label for="name">Fleet</label>
	           
	                 <select class="form-control select2" name="fleet" id="fleet"  data-placeholder="Select Fleet" aria-hidden="true">
	                 	<option value="">Select Fleet</option>
                    @foreach ($Fleets as $Fleet)
                    <option value="{{ $Fleet->FLEET_ID }}" data-type="{{$Fleet->FLEET_TYPE_CODE}}">{{ $Fleet->FLEET_NAME }}</option>
                    @endforeach
                  </select>
	         
	    </div>
<div class="clearfix"></div>	
   <div class="form-group col-md-6">
	                <label for="name">Driver</label>
	           
	                 <select class="form-control select2" name="driver"  data-placeholder="Select Operator" aria-hidden="true">
	                 	<option value="">Select Driver</option>
	                 	@foreach ($Drivers as $Driver)
                    <option value="{{ $Driver->USER_ID }}">{{ $Driver->FIRSTNAME  }} {{ $Driver->SURNAME }}</option>
                    @endforeach
                  </select>
	         
	    </div>
<div class="clearfix"></div>	


	       
	       <div class="form-group col-md-6">
	        <label for="name">Fare</label>
	           <input type="text" class="form-control" name="fare" value="{{old('fare')}}" >
	         
	    </div>
<div class="clearfix"></div>	
	       <div class="form-group col-md-6">
	        <label for="name">Max Seat</label>
	           <input type="text" class="form-control" name="max_seat" value="{{old('max_seat')}}" >
	         
	    </div>
		<div class="clearfix"></div>	
	         <div class="form-group col-md-6">
	                <label for="name">Add Seat</label>
	           
	                 <select class="form-control select2" name="seat" id="seat"  data-placeholder="Select Seat" aria-hidden="true">
	                 	<option value="">Select Seat</option>
                 
                  </select>
	         
	    </div>
	    	<div class="clearfix"></div>




			<div class="form-group col-md-4">
	             <button type="submit" class="btn btn-primary">Submit</button>
	             
	            </div>
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
  			 $('.multiple').select2();
  	 			$('.datepicker').datepicker({
  				  format: 'yyyy-mm-dd',
      autoclose: true,
    });

  	 			  $(".timepicker").hunterTimePicker();
  		

  		 $(document).on('change', "#fleet", function(e) {
			e.preventDefault;
			$('#seat').empty();
			getSeat();
	});
 			
  		 $(document).on('change', "#operator", function(e) {
			e.preventDefault;
			getRoute();
	});
 			
  		
  });

  
   function getSeat(){
      
    var type=$('#fleet :selected').attr('data-type');
  	 $('#seat').empty();
    if(type != '')
      $.ajax({
        url: "{{route('getSeat')}}",
        type: "POST",
        data : {id:type, _token: "{{csrf_token()}}"},
       
        success: function(data){
       
        $('#seat').html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    }
  
   function getRoute(){
      
    var op=$('#operator :selected').val();
  	 $('#route').empty();
    if(op != '')
      $.ajax({
        url: "{{route('getRoute')}}",
        type: "POST",
        data : {op:op, _token: "{{csrf_token()}}"},
       
        success: function(data){
       
        $('#route').html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    }

</script>
@endsection