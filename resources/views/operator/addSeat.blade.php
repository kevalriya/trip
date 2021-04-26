<?php 
$ActiveSide='fleet';
?> 	
@extends('admin.layouts.app')

@section('title','Add Seat Map')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">

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
	    <span class="info-box-number">Add Seat</span>
	    @foreach ($data as $i)
        <span id="tabInfo" data-id="{{$i->id}}" readonly>{{$i->description}}</span>
        @endforeach
	  </div>
	  <!-- /.info-box-content -->
	</div>

	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Add Seat Map</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('operator.seat.store') }}" method="post"  enctype="multipart/form-data">
	          {{ csrf_field() }}
	          {{ method_field('POST') }}
	            <div class="box-body">

    	
    	 <div class="form-group col-md-6">
	                <label for="name">Map Name</label>
	                <input type="text" class="form-control" name="map_name" value="{{old('map_name')}}" placeholder="Map Name" >
	       </div>
	       <?php 
	       if($default=='yes'){
	       	?>
	       	 <div class="form-group col-md-6">
	                <label for="name">Fleet Type</label>
	           <input type="hidden" name="fleet_type" value="{{$FleetTypes->FLEET_TYPE_CODE}}" >
	           <input type="text" class="form-control" value="{{$FleetTypes->FLEET_TYPE_NAME}}" readonly="">
	         
	    </div>
	       	<?php
	       }
	       else{


	       ?>
   		 <div class="form-group col-md-6">
	                <label for="name">Fleet Type</label>
	           
	                 <select class="form-control select2" name="fleet_type"  data-placeholder="Select Fleet Type" aria-hidden="true">
	                 	<option value="">Select Fleet Type</option>
                    @foreach ($FleetTypes as $FleetType)
                    <option value="{{ $FleetType->FLEET_TYPE_CODE }}"  >{{ $FleetType->FLEET_TYPE_NAME }}</option>
                    @endforeach
                  </select>
	         
	    </div>
	<?php } ?>
	
			

				    <div class="form-group col-md-3">
       <label>No of Column</label>
    
     <input type="number" class="form-control" max="26" min="1" name="column">
    	</div>  
	 <div class="form-group col-md-3">
       <label>No of rows</label>
    
     <input type="number" class="form-control" max="26" min="1" name="row">
    	</div>  

    	    <div class="form-group col-md-6">
       <label>Description</label>
            <textarea class="form-control" name="description" rows="3">{{old('description')}}</textarea>
     
    	</div>


				<div class="clearfix"></div>
				<br>
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

<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>

<script>
  $(document).ready(function() {
  	
  });
</script>
@endsection