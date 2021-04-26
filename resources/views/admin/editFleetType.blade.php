<?php 
$ActiveSide='fleet';
?> 	
@extends('admin.layouts.app')

@section('title','Update Fleet Type')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/dist/css/info.css') }}">
@endsection
@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">


	  <!-- Main content -->
	  <section class="content">
    <?php
    $ActiveSub="fleettype";
    ?>
@include('admin.layouts.fleetHeader')
	  	    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-number">Update Fleet Type</span>
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
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Fleet Type</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{route('updateFleetType',$fleetType->FLEET_TYPE_CODE)}}" method="post"  enctype="multipart/form-data">
	          {{ csrf_field() }}
	          {{ method_field('PUT') }}
	            <div class="box-body">
	            
	         

	    
   		 <div class="form-group col-md-6">
	                <label for="name">Parent Type</label>
	           
	                 <select class="form-control select2" name="parent_type"  data-placeholder="Select Parent Type" aria-hidden="true">
	                 	<option value="">Select Parent Type</option>
                    @foreach ($parentTypes as $Types)
                    <option value="{{ $Types->PARENT_TYPE_CODE }}" 
                    	 @if ($Types->PARENT_TYPE_CODE == $fleetType->PARENT_TYPE_CODE)
                        selected
                      @endif
                      >{{ $Types->PARENT_TYPE_NAME }}</option>
                    @endforeach
                  </select>
	         
	    </div>
    	
    	 <div class="form-group col-md-6">
	                <label for="name">Type Name</label>
	                <input type="text" class="form-control" name="type_name" value="{{$fleetType->FLEET_TYPE_NAME}}" placeholder="Type Name" >
	       </div>

   		 <div class="form-group col-md-6">
	                <label for="name">Operator</label>
	           
	                 <select class="form-control select2" name="operator"  data-placeholder="Select Operator" aria-hidden="true">
	                 	<option value="">Select Operator</option>
                    @foreach ($Operators as $Operator)
                    <option value="{{ $Operator->OPERATOR_CODE }}"
                    	 @if ($Operator->OPERATOR_CODE == $fleetType->OPERATOR_CODE)
                        selected
                      @endif
                       >{{ $Operator->OPERATOR_LEGAL_NAME }}</option>
                    @endforeach
                  </select>
	         
	    </div>


   		

	    
   		 <div class="form-group col-md-6">
	                <label for="name">Seat Count</label>
	                <input type="text" class="form-control" name="seat_count" value="{{$fleetType->SEAT_COUNT}}" placeholder="Seat Count" >
	      </div>

   		
	    <div class="form-group col-md-6">
       <label>Description</label>
            <textarea class="form-control" name="description" rows="3">{{$fleetType->FLEET_TYPE_DESC}}</textarea>
     
    	</div>

				<div class="clearfix"></div>

	            <div class="form-group col-md-6">
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

<script>
updateInformation("{{route('trip.tabInfo')}}", '{{csrf_token()}}');
  $(document).ready(function() {
  
  });
</script>
@endsection