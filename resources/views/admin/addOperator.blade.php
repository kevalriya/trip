<?php 
$ActiveSide='operator';
?> 	
@extends('admin.layouts.app')

@section('title','Add New Operator')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endsection
@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">


	  <!-- Main content -->
	  <section class="content">

	  	  <?php
    $ActiveSub="operator";
    ?>
@include('admin.layouts.userHeader')

	  	<div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
	  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
	  <div class="info-box-content">
	    <span class="info-box-text">Add Operator</span>
	    <span class="info-box-number"></span>
	  </div>
	  <!-- /.info-box-content -->
	</div>

	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Operator Detail</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('operator.store') }}" method="post"  enctype="multipart/form-data">
	          {{ csrf_field() }}
	          {{ method_field('POST') }}

	          <input type="hidden" name="country" value="{{ $Countries->COUNTRY_ID }}" id="country">

	        

	            <div class="box-body">
	            
	              <div class="form-group col-md-4">
	                <label for="name">Legal Name</label>
	                <input type="text" class="form-control" name="legalName" value="{{old('legalName')}}" placeholder="Legal Name" >
	              </div>

	              <div class="form-group col-md-4">
	                <label for="name">Short Name</label>
	                <input type="text" class="form-control" name="shortName" value="{{old('shortName')}}" placeholder="Short Name" >
	              </div>

   		 <div class="form-group col-md-4">
	                <label for="name">Website</label>
	                <input type="text" class="form-control" name="website" value="{{old('website')}}" placeholder="Website" >
	              </div>

	    
   		 <div class="form-group col-md-4">
	                <label for="name">Salutation</label>
	           
	                 <select class="form-control select2" name="salutation" value="{{old('salutation')}}"  data-placeholder="Select LGA" aria-hidden="true">
	                 	<option value="">Select Salutation</option>
                    @foreach ($Salutations as $Salutation)
                    <option value="{{ $Salutation->SALUTATION_LABEL_ID }}">{{ $Salutation->SALUTATION_LABEL_DESC }}</option>
                    @endforeach
                  </select>
	         
	    </div>

   		 <div class="form-group col-md-4">
	                <label for="name">First Name</label>
	                <input type="text" class="form-control" name="firstName" value="{{old('firstName')}}" placeholder="first Name" >
	              </div>

	    
   		 <div class="form-group col-md-4">
	                <label for="name">Last Name</label>
	                <input type="text" class="form-control" name="lastName" value="{{old('lastName')}}" placeholder="Last Name" >
	              </div>

   		 <div class="form-group col-md-4">
	                <label for="name">Phone No.</label>
	                <input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Phone No." >
	              </div>

	 <div class="form-group col-md-4">
	                <label for="name">Phone No. 2</label>
	                <input type="text" class="form-control" name="phone1" value="{{old('phone1')}}" placeholder="Phone No." >
	              </div>

	 <div class="form-group col-md-4">
	                <label for="name">Email</label>
	                <input type="email" class="form-control" name="email" value="{{old('MAIN_CONTACT_EMAIL')}}" placeholder="Email" >
	              </div>

	    

   		 <div class="form-group col-md-4">
	                <label for="name">State</label>
	                 <select class="form-control select2" name="state"  id="state" data-placeholder="Select State" aria-hidden="true">
	                 		<option value="">Select State</option>
                    
                  </select>
	              </div>

	    	
	    		 <div class="form-group col-md-4">
	                <label for="name">LGA</label>
	                 <select class="form-control select2" name="LGA" id="LGA"  data-placeholder="Select LGA" aria-hidden="true">
	                 		<option value="">Select LGA</option>
                 
                  </select>
	              </div>
      
	    
	    
   		 <div class="form-group col-md-4">
	                <label for="name">City</label>
	                 <select class="form-control select2" name="city" id="city" data-placeholder="Select a City" aria-hidden="true">
	                 	<option value="">Select City</option>
                    
                  </select>
	              </div>

	       
   	


				

                <div class="form-group col-md-4">
	                <label for="name">Password</label>
	                <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Password" >
	              </div>

                <div class="form-group col-md-4">
	                <label for="name">Fleet Size</label>
	                <input type="text" class="form-control" name="fleetSize" value="{{old('fleetSize')}}" placeholder="Fleet Size" >
	              </div>

                <div class="form-group col-md-4">
	                <label for="name">Preferred Routes</label>
	                <input type="text" class="form-control" name="preferredRoute" value="{{old('preferredRoute')}}" placeholder="Preferred Routes" >
	            </div>
	            
	            <div class="form-group col-md-4">
       <label>Image</label>
            <input type="file" name="image" value="{{old('image')}}" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
     
    	</div>  

	    <div class="form-group col-md-4">
       <label>Address</label>
            <textarea class="form-control" name="address" rows="3">{{old('address')}}</textarea>
     
    	</div>

				<div class="clearfix"></div>

	            <div class="form-group col-md-4">
	              <button type="submit" class="btn btn-primary">Submit</button>
	              <a href='{{ route('operator.index') }}' class="btn btn-warning">Back</a>
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

  	$('#state').empty();
			$('#LGA').empty();
			$('#city').empty();
			getState();

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
			getCity();
	});	

	

  });

   function getState(){
      
    var country=$('#country').val();
  
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

    function getCity(){
      
    var country=$('#state :selected').val();
  
    if(country != '')
      $.ajax({
        url: "{{route('getCity')}}",
        type: "POST",
        data : {id:country, _token: "{{csrf_token()}}"},
       
        success: function(data){
        $('#city').empty();
        $('#city').html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    }
</script>
@endsection