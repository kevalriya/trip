<?php 
$ActiveSide='route';
function generateRandomString($length = 10) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
     return $randomString;
}
?> 	
@extends('admin.layouts.app')

@section('title','Add City')
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
    $ActiveSub="city";
    ?>
@include('admin.layouts.routeHeader')
	  		  	<div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
	  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
	  <div class="info-box-content">
	    <span class="info-box-number">Add City</span>
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
	            <h3 class="box-title">Add City</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('city.store') }}" method="post"  enctype="multipart/form-data">
	          {{ csrf_field() }}
	          {{ method_field('POST') }}
	            <div class="box-body">

    	
    	 <div class="form-group col-md-6">
	                <label for="name">City Code</label>
	                <input type="text" class="form-control" name="city_code" value="{{generateRandomString()}}" placeholder="City Code" readonly>
	       </div>

	    
    	 <div class="form-group col-md-6">
	                <label for="name">City Name</label>
	                <input type="text" class="form-control" name="city_name" value="{{old('city_name')}}" placeholder="City Name" >
	       </div>

	    
	    	<div class="form-group col-md-6" >
                  <label>Select Country</label>
                  <select class="form-control select2" name="country" data-placeholder="Select a Country" id="country" tabindex="-1" aria-hidden="true">
                  			<option value="">Select Country</option>
                    @foreach ($Countries as $Country)
                    <option value="{{ $Country->COUNTRY_ID }}">{{ $Country->COUNTRY_NAME }}</option>
                    @endforeach
                  </select>
                </div>
          	
          		 <div class="form-group col-md-6">
	                <label for="name">State</label>
	                 <select class="form-control select2" name="state"  id="state" data-placeholder="Select State" aria-hidden="true">
	                 		<option value="">Select State</option>
                    
                  </select>
	              </div>

      
	        <div class="form-group col-md-6">
	                <label for="name">Longitude</label>
	                <input type="text" class="form-control" name="longitude" value="{{old('longitude')}}" placeholder="Longitude" >
	       </div>

    	 <div class="form-group col-md-6">
	                <label for="name">Latitude</label>
	                <input type="text" class="form-control" name="latitude" value="{{old('latitude')}}" placeholder="Latitude" >
	       </div>
  
   		            <div class="form-group col-md-4">
       <label>Image</label>
            <input type="file" name="image" value="{{old('image')}}" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
     
    	</div>  
   

				<div class="clearfix"></div>
				<br>
	            <div class="form-group col-md-6">
	             <button type="submit" class="btn btn-primary">Submit</button>
	              <a href='{{ route('city.index') }}' class="btn btn-warning">Back</a>
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
  	
  	  	 $(document).on('change', "#country", function(e) {
			e.preventDefault;
			$('#state').empty();
			$('#LGA').empty();
			$('#city').empty();
			getState();
	});

 	 $(document).on('change', "#state", function(e) {
			e.preventDefault;
		
			$('#LGA').empty();
			$('#city').empty();
			getLGA();
			
	});	

  });

     function getState(){
      
    var country=$('#country :selected').val();
  
    if(country != '')
      $.ajax({
        url: "{{route('getState')}}",
        type: "POST",
        data : {id:country, _token: "{{csrf_token()}}"},
       
        success: function(data){
        $('#state').empty();
        $('#state').html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    }

    function getLGA(){
      
    var country=$('#state :selected').val();
  
    if(country != '')
      $.ajax({
        url: "{{route('getlga')}}",
        type: "POST",
        data : {id:country, _token: "{{csrf_token()}}"},
       
        success: function(data){
        $('#LGA').empty();
        $('#LGA').html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    } 

</script>
@endsection