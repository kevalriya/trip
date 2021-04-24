<?php 
$ActiveSide='operator';
?> 	
@extends('admin.layouts.app')

@section('title','Update New User')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datepicker/datepicker3.css') }}">
<link rel="stylesheet" href="{{ asset('admin/dist/css/info.css') }}">
<style type="text/css">
  .select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 0;
    padding-right: 0;
    height: auto;
    margin-top: -4px;
}
.select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0;
    padding: 6px 12px;
    height: 34px;
}
</style>
@endsection
@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">


	  <!-- Main content -->
	  <section class="content">
	  	    <?php
    $ActiveSub="user";
    ?>
@include('admin.layouts.userHeader')

	  	<div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
	  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
	  <div class="info-box-content">
	    <span class="info-box-number">Update User</span>
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
	            <h3 class="box-title">User Detail</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('user.update',$User->USER_ID) }}" method="post"  enctype="multipart/form-data">
	          {{ csrf_field() }}
	           {{ method_field('PUT') }}
              <input type="hidden" name="country" value="{{ $Countries->COUNTRY_ID }}" id="country">

                <input type="hidden" name="marital_status" value="SINGLE">
	            <div class="box-body">
	   		 <div class="form-group col-md-4">
	                <label for="name">Salutation</label>
	           
	                 <select class="form-control select2" name="salutation"   data-placeholder="Select Salutation" aria-hidden="true">
	                 	<option value="">Select Salutation</option>
                    @foreach ($Salutations as $Salutation)
                    <option value="{{ $Salutation->SALUTATION_LABEL_ID }}" 
                    	    @if ($Salutation->SALUTATION_LABEL_ID == $User->SALUTATION_ID)
                        selected
                      @endif
                    	>{{ $Salutation->SALUTATION_LABEL_DESC }}</option>
                    @endforeach
                  </select>
	         
	    </div>


	              <div class="form-group col-md-4">
	                <label for="name">First Name</label>
	                <input type="text" class="form-control" name="firstName" value="{{$User->FIRSTNAME}}" placeholder="First Name" >
	              </div>

	              <div class="form-group col-md-4">
	                <label for="name">Middle Name</label>
	                <input type="text" class="form-control" name="middleName" value="{{$User->MIDDLENAME}}" placeholder="Middle Name" >
	              </div>

	              <div class="form-group col-md-4">
	                <label for="name">Surname Name</label>
	                <input type="text" class="form-control" name="surnameName" value="{{$User->SURNAME}}" placeholder="Surname Name" >
	              </div>

   
	    


   		 <div class="form-group col-md-4">
	                <label for="name">Phone No.</label>
	                <input type="text" class="form-control" name="phone" value="{{$User->PHONE_NUMBER1}}" placeholder="Phone No." >
	              </div>

	 <div class="form-group col-md-4">
	                <label for="name">Phone No. 2</label>
	                <input type="text" class="form-control" name="phone1" value="{{$User->PHONE_NUMBER2}}" placeholder="Phone No." >
	              </div>
	 

	 <div class="form-group col-md-4">
	                <label for="name">Email</label>
	                <input type="email" class="form-control" name="email" value="{{$User->EMAIL_ADDRESS}}" placeholder="Email" >
	              </div>

	    	<div class="form-group col-md-4" >
                  <label>Select Gender</label>
                  <select class="form-control select2" name="gender" value="{{old('gender')}}" data-placeholder="Select a gender" id="gender" tabindex="-1" aria-hidden="true">
                  			<option value="">Select Gender</option>
                  			<option value="M"  @if ($User->GENDER_FLAG == 'M')
                        selected
                      @endif>Male</option>
                  			<option value="F"  @if ($User->GENDER_FLAG == 'F')
                        selected
                      @endif>Female</option>
                  
                  </select>
                </div>

	   	
          
      
   		 <div class="form-group col-md-4">
	                <label for="name">State </label>
	                 <select class="form-control select2" name="state"   id="state" data-placeholder="Select State" aria-hidden="true">
	                 		<option value="">Select State </option>
                    @foreach ($States as $State)
                    <option value="{{ $State->STATE_CODE }}" 
                    	@if ($State->STATE_CODE == $User->STATE_CODE)
                        selected
                      @endif
                    	>{{ $State->NAME }}</option>
                    @endforeach
                  </select>
	              </div>
	                    
   	

	       
   		 <div class="form-group col-md-4">
	                <label for="name">LGA</label>
	                 <select class="form-control select2" name="lga" id="LGA"   data-placeholder="Select LGA" aria-hidden="true">
	                 		<option value="">Select LGA</option>
                    @foreach ($LGAS as $LGA)
                    <option value="{{ $LGA->HASC_CODE }}" 
                    	@if ($LGA->HASC_CODE == $User->LGA_HASC)
                        selected
                      @endif
                    	>{{ $LGA->LGA_NAME }}</option>
                    @endforeach
                  </select>
	              </div>
      

	    	 <div class="form-group col-md-4">
	                <label for="name">City</label>
	                 <select class="form-control select2" name="city" id="city" data-placeholder="Select a City" aria-hidden="true">
	                 	<option value="">Select City</option>
                    @foreach ($Cities as $City)
                    <option value="{{ $City->CITY_CODE }}" 
                    	  @if ($City->CITY_CODE == $User->CITY)
                        selected
                      @endif
                    	>{{ $City->CITY_NAME }}</option>
                    @endforeach
                  </select>
	              </div>


   	


				
                <div class="form-group col-md-4">
	                <label for="name">Date Of Birth</label>
	                <input type="text" class="form-control datepicker" name="date_of_birth" value="{{$User->DATE_OF_BIRTH}}" >
	              </div>

             
	            <div class="form-group col-md-4">
       <label>Image</label>
            <input type="file" name="image" value="{{old('image')}}" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
     
    	</div>  

    	  <div class="form-group col-md-2">
      	 @if (!empty($User->IMAGE))
			<img src="{{url('/public/images/users/'.$User->IMAGE)}}" style="width: 70px;">
              @endif
     
    	</div>  
<div class="clearfix"></div>
	    	<div class="form-group col-md-4" >
                  <label>User Type</label>
                  <select class="form-control select2" name="user_type" value="{{old('user_type')}}" data-placeholder="Select a user_type" id="user_type" tabindex="-1" aria-hidden="true">
                  			<option value="">Select User Type</option>
                  			<option value="USER" @if ($User->USER_TYPE_CODE == 'USER')
                        selected
                      @endif>User</option>
                  			<option value="DRIVER" @if ($User->USER_TYPE_CODE == 'DRIVER')
                        selected
                      @endif>Driver</option>
                  
                  </select>
                </div>

    	
    	      <div class="form-group col-md-3">
       <label>Status</label>
            <select class="form-control" name="active"    aria-hidden="true">
	               <option value="Y" @if ($User->ACTIVE_INDICATOR == 'Y')
                        selected
                      @endif>Active</option>
                   <option value="N" @if ($User->ACTIVE_INDICATOR == 'N')
                        selected
                      @endif>Inactive</option>
            
                  </select>
    	</div>  

	    <div class="form-group col-md-4">
       <label>Address</label>
            <textarea class="form-control" name="address" rows="3">{{$User->ADDRESS_LINE_1}}</textarea>
     
    	</div>



				<div class="clearfix"></div>

	            <div class="form-group col-md-4">
	              <button type="submit" class="btn btn-primary">Submit</button>
	              <a href='{{ route('user.index') }}' class="btn btn-warning">Back</a>
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
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script>
updateInformation("{{route('trip.tabInfo')}}", '{{csrf_token()}}');
  $(document).ready(function() {
 
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
      autoclose: true,
    });
        $('.select2').select2();
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