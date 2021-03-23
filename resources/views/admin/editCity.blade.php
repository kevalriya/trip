<?php 
$ActiveSide='route';
$url=config('constants.city_url');

?> 	
@extends('admin.layouts.app')

@section('title','Update City')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
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
	    <span class="info-box-text">Update City</span>
	    <span class="info-box-number"></span>
	  </div>
	  <!-- /.info-box-content -->
	</div>

	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Update City</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('city.update',$City->CITY_CODE) }}" method="post"  enctype="multipart/form-data">
	          {{ csrf_field() }}
	           {{ method_field('PUT') }}
	            <div class="box-body">

    	
    	 <div class="form-group col-md-6">
	                <label for="name">City Code</label>
	                <input type="text" class="form-control" name="city_code" value="{{$City->CITY_CODE}}" placeholder="City Code" >
	       </div>

	    
    	 <div class="form-group col-md-6">
	                <label for="name">City Name</label>
	                <input type="text" class="form-control" name="city_name" value="{{$City->CITY_NAME}}" placeholder="City Name" >
	       </div>

	    
	    	<div class="form-group col-md-6" >
                  <label>Select Country</label>
                  <select class="form-control select2" name="country" data-placeholder="Select a Country" id="country" tabindex="-1" aria-hidden="true">
                  			<option value="">Select Country</option>
                    @foreach ($Countries as $Country)
                    <option value="{{ $Country->COUNTRY_ID }}"
                    	  @if ($Country->COUNTRY_ID == $City->COUNTRY_ID)
                        selected
                      @endif
                      >{{ $Country->COUNTRY_NAME }}</option>
                    @endforeach
                  </select>
                </div>
          	
          		 <div class="form-group col-md-6">
	                <label for="name">State</label>
	                 <select class="form-control select2" name="state"  id="state" data-placeholder="Select State" aria-hidden="true">
	                 		<option value="">Select State</option>
                     @foreach ($States as $State)
                    <option value="{{ $State->STATE_CODE }}" 
                    	@if ($State->STATE_CODE == $City->STATE_CODE)
                        selected
                      @endif
                    	>{{ $State->NAME }}</option>
                    @endforeach
                  </select>
	              </div>

      		     <div class="form-group col-md-6">
	                <label for="name">Longitude</label>
	                <input type="text" class="form-control" name="longitude" value="{{$City->LONGITUDE}}" placeholder="Longitude" >
	       </div>

    	 <div class="form-group col-md-6">
	                <label for="name">Latitude</label>
	                <input type="text" class="form-control" name="latitude" value="{{$City->LATITUDE}}" placeholder="Latitude" >
	       </div>
            
	            <div class="form-group col-md-4">
       <label>Image</label>
            <input type="file" name="image"  class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
     
    	</div>  
   		

         <div class="form-group col-md-2">
      	 @if (!empty($City->CITY_PHOTO))
			<img src="{{url($url.$City->CITY_PHOTO)}}" style="width: 70px;">
              @endif
     
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

<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>

<script>
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