<?php 
$ActiveSide='fleet';
?> 	
@extends('admin.layouts.app')

@section('title','Update Fleet')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<style type="text/css">
	.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #337ab7 !important;}
</style>
@endsection
@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">


	  <!-- Main content -->
	  <section class="content">
	  	    <?php
    $ActiveSub="fleet";
    ?>
@include('admin.layouts.fleetHeader')


	  		  	    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Update Fleet </span>
    <span class="info-box-number"></span>
  </div>
  <!-- /.info-box-content -->
</div>
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Fleet Detail</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('fleet.update',$Fleet->FLEET_ID) }}" method="post"  enctype="multipart/form-data">
	          {{ csrf_field() }}
	          {{ method_field('PUT') }}
	            <div class="box-body">
	            
	         

	   
    	
    	 <div class="form-group col-md-4">
	                <label for="name">Fleet Name</label>
	                <input type="text" class="form-control" name="fleet_name" value="{{$Fleet->FLEET_NAME}}" placeholder="Fleet Name" >
	       </div>

   		 <div class="form-group col-md-4">
	                <label for="name">Fleet Type</label>
	           
	                 <select class="form-control select2" name="fleet_type"  data-placeholder="Select Fleet Type" aria-hidden="true">
	                 	<option value="">Select Fleet Type</option>
                    @foreach ($fleetTypes as $Type)
                    <option value="{{ $Type->FLEET_TYPE_CODE }}"
                    	@if ($Type->FLEET_TYPE_CODE == $Fleet->FLEET_TYPE_CODE)
                        selected
                      @endif
                      >{{ $Type->FLEET_TYPE_NAME }}</option>
                    @endforeach
                  </select>
	         
	    </div>	 <div class="form-group col-md-4">
	                <label for="name">Operator</label>
	           
	                 <select class="form-control select2" name="operator"  data-placeholder="Select Operator" aria-hidden="true">
	                 	<option value="">Select Operator</option>
                    @foreach ($Operators as $Operator)
                    <option value="{{ $Operator->OPERATOR_CODE }}" 
                    	@if ($Operator->OPERATOR_CODE == $Fleet->OPERATOR_CODE)
                        selected
                      @endif>{{ $Operator->OPERATOR_LEGAL_NAME }}</option>
                    @endforeach
                  </select>
	         
	    </div>


   		 <div class="form-group col-md-4">
	                <label for="name">Route</label>
	           
	                 <select class="form-control select2" name="route"  data-placeholder="Select Route" aria-hidden="true">
	                 	<option value="">Select Route</option>
                    @foreach ($Routes as $Route)
                    <option value="{{ $Route->ROUTE_ID }}"
                    	@if ($Route->ROUTE_ID == $Fleet->ROUTE_ID)
                        selected
                      @endif>{{ $Route->ROUTE_NAME }}</option>
                    @endforeach
                  </select>
	         
	    </div>
	    

   		

	    
   		 <div class="form-group col-md-4">
	                <label for="name">Make</label>
	                <input type="text" class="form-control" name="make" value="{{$Fleet->MAKE}}" placeholder="Make" >
	      </div>

   		 <div class="form-group col-md-4">
	                <label for="name">Model</label>
	                <input type="text" class="form-control" name="Model" value="{{$Fleet->MODEL}}" placeholder="Model" >
	      </div>

   		 <div class="form-group col-md-4">
	                <label for="name">Engine No</label>
	                <input type="text" class="form-control" name="engine_no" value="{{$Fleet->ENGINE_NO}}" placeholder="Engine No" >
	      </div>

 		<div class="form-group col-md-4">
	                <label for="name">Chassis No</label>
	                <input type="text" class="form-control" name="chassis_no" value="{{$Fleet->CHASIS_NO}}" placeholder="Chassis No" >
	      </div>

   		
 		<div class="form-group col-md-4">
	                <label for="name">Year of Manufacture</label>
	                <input type="text" class="form-control" name="manufacture" value="{{$Fleet->YEAR_OF_MANUFACTURE}}" placeholder="Manufacture" >
	      </div>

   			<div class="form-group col-md-4">
	                <label for="name">Registration No</label>
	                <input type="text" class="form-control" name="registration" value="{{$Fleet->REG_NO}}" placeholder="Registration No" >
	      </div>

   		

   			<div class="form-group col-md-4">
	                <label for="name">Colour</label>
	                <input type="text" class="form-control" name="colour" value="{{$Fleet->COLOUR}}" placeholder="Colour" >
	      </div>

   			<div class="form-group col-md-4">
	                <label for="name">Home Terminal</label>
	                <input type="text" class="form-control" name="home_terminal" value="{{$Fleet->HOME_TERMINAL}}" placeholder="Home Terminal" >
	      </div>

   		
   		<!-- 	<div class="form-group col-md-4">
	                <label for="name">AC Available</label>
	                   <select class="form-control" name="ac_available">
	                 	<option value="">Select</option>
	                 	<option value="Y" <?php // echo ($Fleet->AC_AVAILABLE == 'Y') ? 'selected' : '' ?>>Yes</option>
	                 	<option value="N" <?php // echo ($Fleet->AC_AVAILABLE == 'N') ? 'selected' : '' ?>>N</option>
                   
                  </select>
	        </div>

   			<div class="form-group col-md-4">
	                <label for="name">Route Assignd</label>
	              
	                <select class="form-control" name="route_assign">
	                <option value="">Select</option>
	                 	<option value="Y" <?php // echo ($Fleet->IS_ROUTE_ASSIGNED == 'Y') ? 'selected' : '' ?>>Yes</option>
	                 	<option value="N" <?php // echo ($Fleet->IS_ROUTE_ASSIGNED == 'N') ? 'selected' : '' ?>>N</option>
	                 	
                  </select>
	        </div>
 -->
   		
	   
		
			<div class="clearfix"></div>

			
<div class="form-group">
		<?php 
	           	$fleetAmenitie=array();
	           	if(!empty($Fleet->amenities)){
	           	$fleetAmenitie=json_decode($Fleet->amenities);	
	           	}

	           	?>
  <label  class="col-md-2">Amenities</label>
  <div class="col col-md-9">
<div class="col-xs-5">
          <select name="from" id="lstview" class="form-control" size="13" multiple="multiple" style="height: 150px">
           
           	
                    @foreach ($Amenities as $Amenitie)
                    <option value="{{ $Amenitie->AMENITY_ID }}">{{ $Amenitie->AMENITY_NAME }}</option>
                    @endforeach
          </select>
        </div>
        
        <div class="col-xs-2">
         
          <button type="button" id="lstview_rightAll" class="btn btn-default btn-block"><i class="glyphicon glyphicon-forward"></i></button>
          <button type="button" id="lstview_rightSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
          <button type="button" id="lstview_leftSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
          <button type="button" id="lstview_leftAll" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>
          
        </div>
        
        <div class="col-xs-5">
          <select name="amenitie[]" id="lstview_to" class="form-control" size="13" multiple="multiple" style="height: 150px">
          	

                    @foreach ($Amenities as $Amenitie)
                    @if (in_array($Amenitie->AMENITY_ID,$fleetAmenitie))
                    <option value="{{ $Amenitie->AMENITY_ID }}">{{ $Amenitie->AMENITY_NAME }}</option>
                    @endif
                    @endforeach

          </select>
        </div>

      </div>
    </div>

				<div class="clearfix"></div>

	            <div class="form-group col-md-4">
	             <button type="submit" class="btn btn-primary">Submit</button>
	              <a href='{{ route('fleet.index') }}' class="btn btn-warning">Back</a>
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

<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/multilo.js') }}"></script>
 
<script>
  $(document).ready(function() {
  	 $('.multiple').select2();
  	   $('#lstview').multiselect();
  });
</script>
@endsection