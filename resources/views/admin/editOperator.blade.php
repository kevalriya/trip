<?php 
$ActiveSide='operator';
?> 
@extends('admin.layouts.app')

@section('title','Update Operator')
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
    $ActiveSub="operator";
    ?>
@include('admin.layouts.userHeader')

	  	    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-number">Update Operator</span>
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
	            <h3 class="box-title">Operator Detail</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->

	         
	          <form role="form" action="{{ route('operator.update',$Operator->OPERATOR_CODE) }}" method="post"  enctype="multipart/form-data">
	          {{ csrf_field() }}
	           {{ method_field('PUT') }}

            <input type="hidden" name="country" value="{{ $Countries->COUNTRY_ID }}" id="country">

          
	            <div class="box-body">
	            
	              <div class="form-group col-md-4">
	                <label for="name">Legal Name</label>
	                <input type="text" class="form-control" name="legalName" value="{{$Operator->OPERATOR_LEGAL_NAME}}" placeholder="Legal Name" >
	              </div>

	              <div class="form-group col-md-4">
	                <label for="name">Short Name</label>
	                <input type="text" class="form-control" name="shortName" value="{{$Operator->OPERATOR_SHORT_NAME}}" placeholder="Short Name" >
	              </div>

   		 <div class="form-group col-md-4">
	                <label for="name">Website</label>
	                <input type="text" class="form-control" name="website" value="{{$Operator->OPERATOR_WEBSITE}}" placeholder="Website" >
	    </div>

	    
   		 <div class="form-group col-md-4">
	                <label for="name">Salutation</label>
	           
	                 <select class="form-control select2" name="salutation"   data-placeholder="Select Salutation" aria-hidden="true">
	                 	<option value="">Select Salutation</option>
                    @foreach ($Salutations as $Salutation)
                    <option value="{{ $Salutation->SALUTATION_LABEL_ID }}" 
                    	    @if ($Salutation->SALUTATION_LABEL_ID == $Operator->MAIN_CONTACT_TITLE)
                        selected
                      @endif
                    	>{{ $Salutation->SALUTATION_LABEL_DESC }}</option>
                    @endforeach
                  </select>
	         
	    </div>

   		 <div class="form-group col-md-4">
	                <label for="name">First Name</label>
	                <input type="text" class="form-control" name="firstName" value="{{$Operator->MAIN_CONTACT_FIRSTNAME}}" placeholder="first Name" >
	              </div>

	    
   		 <div class="form-group col-md-4">
	                <label for="name">Last Name</label>
	                <input type="text" class="form-control" name="lastName" value="{{$Operator->MAIN_CONTACT_LASTNAME}}" placeholder="Last Name" >
	              </div>

   		 <div class="form-group col-md-4">
	                <label for="name">Phone No.</label>
	                <input type="text" class="form-control" name="phone" value="{{$Operator->MAIN_CONTACT_PHONE1}}" placeholder="Phone No." >
	              </div>

	 <div class="form-group col-md-4">
	                <label for="name">Phone No. 2</label>
	                <input type="text" class="form-control" name="phone1" value="{{$Operator->MAIN_CONTACT_PHONE2}}" placeholder="Phone No." >
	              </div>

	 <div class="form-group col-md-4">
	                <label for="name">Email</label>
	                <input type="email" class="form-control" name="email" value="{{$Operator->MAIN_CONTACT_EMAIL}}" placeholder="Email" >
	  </div>

	    
		

          
   		 <div class="form-group col-md-4">
	                <label for="name">State</label>
	                 <select class="form-control select2" name="state"   id="state" data-placeholder="Select State" aria-hidden="true">
	                 		<option value="">Select State</option>
                    @foreach ($States as $State)
                    <option value="{{ $State->STATE_CODE }}" 
                    	@if ($State->STATE_CODE == $Operator->MAIN_CONTACT_STATE)
                        selected
                      @endif
                    	>{{ $State->NAME }}</option>
                    @endforeach
                  </select>
	              </div>
	                    
   	

	       
   		 <div class="form-group col-md-4">
	                <label for="name">LGA</label>
	                 <select class="form-control select2" name="LGA" id="LGA"   data-placeholder="Select LGA" aria-hidden="true">
	                 		<option value="">Select LGA</option>
                    @foreach ($LGAS as $LGA)
                    <option value="{{ $LGA->HASC_CODE }}" 
                    	@if ($LGA->HASC_CODE == $Operator->MAIN_CONTACT_LGA)
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
                    	  @if ($City->CITY_CODE == $Operator->MAIN_CONTACT_CITY)
                        selected
                      @endif
                    	>{{ $City->CITY_NAME }}</option>
                    @endforeach
                  </select>
	              </div>





                <div class="form-group col-md-4">
	                <label for="name">Fleet Size</label>
	                <input type="text" class="form-control" name="fleetSize" value="{{$Operator->FLEET_SIZE}}" placeholder="Fleet Size" >
	              </div>

                <div class="form-group col-md-4">
	                <label for="name">Preferred Routes</label>
	                <input type="text" class="form-control" name="preferredRoute" value="{{$Operator->PREFERRED_ROUTES}}" placeholder="Preferred Routes" >
	            </div>
	            
	      <div class="form-group col-md-3">
       <label>Image</label>
            <input type="file" name="image" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
     
    	</div>  

         <div class="form-group col-md-2">
      	 @if (!empty($Operator->FLEET_PHOTO))
			<img src="{{url('/public/images/operator/'.$Operator->FLEET_PHOTO)}}" style="width: 70px;">
              @endif
     
    	</div>  
       
	      <div class="form-group col-md-3">
       <label>Status</label>
            <select class="form-control" name="active"    aria-hidden="true">
	               <option value="Y" @if ($Operator->ACTIVE_INDICATOR == 'Y')
                        selected
                      @endif>Active</option>
                   <option value="N" @if ($Operator->ACTIVE_INDICATOR == 'N')
                        selected
                      @endif>Inactive</option>
            
                  </select>
    	</div>  

	    <div class="form-group col-md-4">
       <label>Address</label>
            <textarea class="form-control" name="address"  rows="3">{{$Operator->MAIN_CONTACT_ADDRESS}}</textarea>
     
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