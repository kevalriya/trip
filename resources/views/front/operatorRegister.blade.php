<?php 
$ActiveSide='home';
?>  
@extends('front.layouts.app')

@section('title','TripOn - Operator Register')
@section('headSection')
<style type="text/css">
  .nopadding {
   padding: 1px !important;
   margin: 0px !important;
}
.nopadding-right {
   padding-right: 1px !important;
   margin-right: 0px !important;
}
.nopadding-left {
   padding-left: 1px !important;
   margin-left: 0px !important;
}
.form-group {
    position: inherit;
}
</style>
@endsection

@section('main-content')
        <div class="container">
            <h1 class="page-title">Operator Register on TripOn</h1>
        </div>

        <div class="gap"></div>


        <div class="container">
            <div class="row" data-gutter="60">
                <div class="col-md-5">
                    <h3>Welcome to TripOn</h3>
                    <p>In today's technology-driven Nigeria, TripOn.ng - an online bus ticket platform - ensures that users can book their bus tickets, select the seats of their choice online, at any time and from anywhere, and head to the bus terminal with peace of mind, knowing that their seats are guaranteed. With TripOn.ng, users:</p>
                   <ul>
                     <li>Shop around(see scheduled trips for all operators) for the best price</li>
                     <li>Book tickets faster and at their convenience</li>
                     <li>Check booking status</li>
                     <li>Manage cancellation and refunds</li>
                     <li>Print eTickets</li>
                     <li>Send tickets through SMS/Email</li>
                   </ul>
                </div>
               
                <div class="col-md-5">

                    <h3>Operator Register </h3>
                            <div class="tabbable">
                              
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab-1">
                                        <form method="post" id="simple_user_reg">
                                          {{ csrf_field() }}
										  <input type="hidden" name="type" value="operator">
 <input type="hidden" name="country" value="{{ $Countries->COUNTRY_ID }}" id="country">
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
              
						
						  <div class="form-group"><i class="fa fa-lock input-icon input-icon-show"></i>

                                                <div class="checkbox checkbox-small">
                                                    <label>
                                                        <input class="i-check" type="checkbox" />I agree to the TripOn <a hreh="">Terms of Use and Privacy Policy</a></label>
                                                    </div>

                                                </div>
												
                        <button class="btn btn-primary reg_btn" type="submit" >Sign up <i class="fa fa-sign-in-alt"> </i> </button>

                    </form>

                                <br>
                      <div id="rgresponse" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
    <br>
                                    </div>
                               
                                   
                                </div>
                            </div>
                       


                    




                </div>
            </div>
        </div>



        <div class="gap"></div>
        

 
@endsection

@section('footerSection')    

		
  <script type="text/javascript">



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

  $(document).on('submit', "#simple_user_reg", function(e) {

        e.preventDefault;
    
   
    $('.reg_btn').find('.fa').removeClass('fa-sign-in-alt').addClass('fa-refresh fa-spin');
    $("#rgresponse").removeClass("alert-success").addClass("alert-danger").hide();
    
      $.ajax({

        url: "{{route('op_reg_response')}}",
        type: 'POST',
        data: $("#simple_user_reg").serialize(),
        dataType: 'json',
        success: function(data){

            $('.reg_btn').find('.fa').removeClass('fa-refresh fa-spin').addClass('fa-sign-in-alt');
           if(data.success== 1){
            
             $("#rgresponse .message").html('Verification link has been sent to your email (Note :-Please check SPAM folder if Link not received in  inbox)');
          $("#rgresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 500);
         
  
            }else{


         $("#rgresponse").removeClass("alert-success").addClass("alert-danger").fadeIn();

           $("#rgresponse .message").html(getError(data.errors));
            $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 1000);

            }
               
      }
 
        
        });
   
 return false;
   });

  });

   function getState(){
      
    var country=$('#country').val();
  
    if(country != '')
      $.ajax({
        url: "{{route('front.getState')}}",
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
        url: "{{route('front.getlga')}}",
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
        url: "{{route('front.getCity')}}",
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
 
    
   
  function getError(errors){
    var op='';
      for(var i=0;i < errors.length;i++){
        op+=errors[i] +'<br>';
      }
      return op;
   }

  </script>
@endsection
