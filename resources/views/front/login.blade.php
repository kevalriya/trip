<?php 
$ActiveSide='home';
?>  
@extends('front.layouts.app')

@section('title','TripOn - Login')
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
.theme-border {
    -webkit-filter: grayscale(100%);
    background: repeating-linear-gradient( 45deg, #007bff, #007bff 15px, #fff 15px, #fff 25px,#ffcd00 25px, #ffcd00 40px, #fff 40px, #fff 48px );
    width: 100%;
    height: 5px;
}


</style>
@endsection

@section('main-content')
        <div class="container">
            <h1 class="page-title text-center">Welcome To TripOn</h1>
        </div>

        <div class="gap"></div>


        <div class="container">


            <div class="row"  data-gutter="60" style="min-height: 660px">
                
                <div class="col-md-12 nopadding text-right">
                  <button class="btn btn-primary" id="login_btn" style="display: none;" onclick="showFormLogin()">Login</button>
                  <button class="btn btn-primary" id="signup_btn" onclick="showFormSignUp()" >Sign Up</button>
                </div>
                <div class="clearfix"></div>
               <section class="theme-border">&nbsp;</section>
                <div class="col-md-5" id="signup_div" style="right: -100px;display: none;">

                    <h3>Signing Up</h3>
                            <div class="tabbable">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active"><a href="#tab-1" data-toggle="tab">User</a>
                                    </li>
                                   <li><a href="#tab-2" data-toggle="tab" >Operator</a> 
                                    </li>
                                    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane  in active" id="tab-1">
                                        <form method="post" id="simple_user_reg">
                                          {{ csrf_field() }}
                      <input type="hidden" name="type" value="user">

                      <div class="col-md-4 nopadding">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>First Name</label>
                            <input class="form-control" name="first_name" placeholder="e.g. John" type="text" />
                        </div>

                      </div>
                          <div class="col-md-4 nopadding">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Middle Name</label>
                            <input class="form-control" name="middle_name" placeholder="e.g Doe" type="text" />
                        </div>

                      </div>
                          <div class="col-md-4 nopadding">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>SurName</label>
                            <input class="form-control" name="surName" placeholder="e.g. Last" type="text" />
                        </div>

                      </div>
                      <div class="clearfix"></div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-show"></i>
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="e.g. johndoe@gmail.com" type="text" />
                        </div> 
                
        
                      
                     <div class="form-group">
                                                <label>Mobile</label>
                                                <input class="form-control" placeholder="+234" value="+234"  style="width: 18%; float: left; margin-right: 2%;" name="ccode" type="text">

                                                <input class="form-control" style="width:80%;" name="mobile" placeholder="(805) 456 7890" type="text">
                                            </div>
            
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password</label>
                            <input class="form-control" name="password"  type="password" placeholder="my secret password" />
                        </div>
            
              <div class="form-group"><i class="fa fa-lock input-icon input-icon-show"></i>

                                                <div class="checkbox checkbox-small">
                                                    <label>
                                                        <input class="i-check" id="usignchk" type="checkbox" />I agree to the TripOn <a href="#" data-toggle="modal" data-target="#terms">Terms of Use and Privacy Policy</a></label>
                                                    </div>

                                                </div>
                        
                        <button class="btn btn-primary reg_btn" type="submit" >Sign up <i class="fas fa-sign-in-alt"> </i> </button>

                    </form>

                                <br>
                      <div id="rgresponse" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
    <br>
                                    </div>
                                    <div class="tab-pane " id="tab-2">
                                    
                                         <form method="post" id="operator_reg_frm">
                                          {{ csrf_field() }}
                      <input type="hidden" name="type" value="operator">
 <input type="hidden" name="country" value="73" id="country">
                    
 <div class="col-md-6 nopadding">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Legal Name</label>
                            <input class="form-control" name="legalName" placeholder="Legal Name" type="text" />
                        </div>

                      </div>
                          <div class="col-md-6 nopadding">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Short Name</label>
                            <input class="form-control" name="shortName" value="{{old('shortName')}}" placeholder="Short Name" type="text" />
                        </div>

                      </div>
                         <!--  <div class="col-md-4 nopadding">
                        <div class="form-group form-group-icon-left"><i class="fa fa-link input-icon input-icon-show"></i>
                            <label>Website</label>
                            <input class="form-control" name="website" placeholder="Website" type="text" />
                        </div>

                      </div> -->
                      <div class="clearfix"></div>
                       
                
                   <!--  <div class="col-md-4 nopadding">
                        <label>Salutation</label>
                   <select class="form-control select2" name="salutation" value="{{old('salutation')}}"  data-placeholder="Select LGA" aria-hidden="true">
                    <option value="">Select Salutation</option>
                    @foreach ($Salutations as $Salutation)
                    <option value="{{ $Salutation->SALUTATION_LABEL_ID }}">{{ $Salutation->SALUTATION_LABEL_DESC }}</option>
                    @endforeach
                  </select>

                      </div> -->
                      
                       <div class="col-md-6 nopadding">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>First Name</label>
                            <input class="form-control" name="firstName" placeholder="First Name" type="text" />
                        </div>
                      </div>
                       <div class="col-md-6 nopadding">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Last Name</label>
                            <input class="form-control" name="lastName" placeholder="Last Name" type="text" />
                        </div>
                      </div>

                                            <div class="clearfix"></div>


                       <div class="col-md-6 nopadding">
                        <div class="form-group form-group-icon-left"><i class="fa fa-phone input-icon input-icon-show"></i>
                            <label>Phone No.</label>
                            <input class="form-control" name="phone" placeholder="Phone No." type="text" />
                        </div>
                      </div>
                      

                       <div class="col-md-6 nopadding">
                        <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-show"></i>
                            <label>Email</label>
                            <input class="form-control" name="email"  placeholder="Email" type="text" />
                        </div>
                      </div>

                                            <div class="clearfix"></div>


                    <div class="col-md-4 nopadding">
                        <label>State</label>
                  <select class="form-control select2" name="state"  id="state" data-placeholder="Select State" aria-hidden="true">
                      <option value="">Select State</option>
                    
                  </select>
                      </div>

                       <div class="col-md-4 nopadding">
                        <label>LGA</label>
                  <select class="form-control select2" name="LGA"  id="LGA" data-placeholder="Select LGA" aria-hidden="true">
                      <option value="">Select LGA</option>
                    
                  </select>
                      </div>

                       <div class="col-md-4 nopadding">
                        <label>City</label>
                  <select class="form-control select2" name="city"  id="city" data-placeholder="Select city" aria-hidden="true">
                      <option value="">Select City</option>
                    
                  </select>
                      </div>
       
                                            <div class="clearfix"></div>

                  <div class="col-md-4 nopadding">
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password</label>
                            <input class="form-control" name="password"  placeholder="Password" type="password" />
                        </div>
                      </div>
                  <div class="col-md-4 nopadding">
                        <div class="form-group">
                            <label>Fleet Size</label>
                            <input class="form-control" name="fleetSize"  placeholder="Fleet Size" type="text" />
                        </div>
                      </div>
                  <div class="col-md-4 nopadding">
                        <div class="form-group">
                            <label>Preferred Routes</label>
                            <input class="form-control" name="preferredRoute"  placeholder="Preferred Routes" type="text" />
                        </div>
                      </div>
                                            <div class="clearfix"></div>


              <div class="form-group"><i class="fa fa-lock input-icon input-icon-show"></i>

                                                <div class="checkbox checkbox-small">
                                                    <label>
                                                        <input class="i-check" id="osignchk" type="checkbox" />I agree to the TripOn <a href="#" data-toggle="modal" data-target="#terms">Terms of Use and Privacy Policy</a></label>
                                                    </div>

                                                </div>
                      
                        <button class="btn btn-primary oreg_btn" type="submit" >Sign up <i class="fa fa-sign-in-alt"> </i> </button>

                    </form>
                                                                     <br>
                      <div id="oprgresponse" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
    <br>

                                    </div>
                                   
                                </div>
                            </div>
                       


                    




                </div>


                  <div class="col-md-5" id="login_div" style="right: 0px;">
                    <h3>Login</h3>
                    <div class="tabbable">
                                <ul class="nav nav-tabs" id="lmyTab">
                                    <li class="active"><a href="#ltab-1" data-toggle="tab">User</a>
                                    </li>
                                    <li ><a href="#ltab-2" data-toggle="tab">Operator</a>
                                    </li>
                                  
                                    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="ltab-1">

                    <form method="post" id="login_form">
                      {{ csrf_field() }}
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Username or email</label>
                            <input class="form-control" name="EMAIL_ADDRESS" id="uemail"  placeholder="e.g. johndoe@gmail.com" type="text" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password</label>
                            <input class="form-control" name="password" id="upass" type="password" placeholder="my secret password" />
                        </div>
                        <button class="btn btn-primary sub_btn" type="submit" />Sign in <i class="fas fa-sign-in-alt"> </i> </button>
                        <a class="btn btn-link" href="{{url('reset-password')}}">
                                    Forgot Your Password?
                                </a>
                    </form>
          <br>
            <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
  <br>

     @if (session()->has('message'))
  <p class="alert alert-success ssmsg">{{ session('message') }}</p>
@endif
    @if (session()->has('warning'))
  <p class="alert alert-warning ssmsg">{{ session('warning') }}</p>
@endif

    </div>

            <div class="tab-pane fade" id="ltab-2">

                                  <form method="post" id="op_login_form">
                      {{ csrf_field() }}
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Username or email</label>
                            <input class="form-control" name="MAIN_CONTACT_EMAIL" id="oemail"  placeholder="e.g. johndoe@gmail.com" type="text" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password</label>
                            <input class="form-control" name="PASSWORD" id="opass" type="password" placeholder="my secret password" />
                        </div>
                        <button class="btn btn-primary sub_btn" type="submit" />Sign in <i class="fas fa-sign-in-alt"> </i> </button>
                        <a class="btn btn-link" href="{{url('reset-operator-password')}}">
                                    Forgot Your Password?
                                </a>
                    </form>
          <br>
            <div id="loresponse" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
  <br>

     @if (session()->has('message'))
  <p class="alert alert-success ssmsg">{{ session('message') }}</p>
@endif
    @if (session()->has('warning'))
  <p class="alert alert-warning ssmsg">{{ session('warning') }}</p>
@endif
    </div>
</div>
                </div>
              
            </div>

                <div class="col-md-5">
                  <br>
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

            </div>
        </div>



        <div class="gap"></div>
        

 
@endsection

@section('footerSection')    

    
  <script type="text/javascript">

    $(document).on('submit', "#simple_user_reg", function(e) {

        e.preventDefault;
    $("#rgresponse").removeClass("alert-success").addClass("alert-danger").hide();
           $("#rgresponse .message").empty();
           $(".ssmsg").empty().hide();
    if($('#usignchk').is(":checked") === false){


         $("#rgresponse").removeClass("alert-success").addClass("alert-danger").fadeIn();
           $("#rgresponse .message").html('Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy');
            $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 1000);

      return false;
    }

    $('.reg_btn').find('.fa').addClass('fa-refresh fa-spin');
    
    
      $.ajax({

        url: "{{route('reg_response')}}",
        type: 'POST',
        data: $("#simple_user_reg").serialize(),
        dataType: 'json',
        success: function(data){

            $('.reg_btn').find('.fa').removeClass('fa-refresh fa-spin');
           if(data.success== 1){
            
             $("#rgresponse .message").html('Verification link has been sent to your email (Note :-Please check SPAM folder if Link not received in  inbox)');
          $("#rgresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 500);
         $("#simple_user_reg")[0].reset();
  
            }else{


         $("#rgresponse").removeClass("alert-success").addClass("alert-danger").fadeIn();

           $("#rgresponse .message").html(getError(data.errors));
            $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 1000);

            }
               
      }
 
        
        });
   
 return false;
   });
   

     $(document).on('submit', "#operator_reg_frm", function(e) {

        e.preventDefault;
    
       $("#oprgresponse").removeClass("alert-success").addClass("alert-danger").hide();
           $("#oprgresponse .message").empty();
           $(".ssmsg").empty().hide();
    if($('#osignchk').is(":checked") === false){


         $("#oprgresponse").removeClass("alert-success").addClass("alert-danger").fadeIn();
           $("#oprgresponse .message").html('Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy');
            $("html, body").animate({ scrollTop: $('#oprgresponse').offset().top }, 1000);

      return false;
    }

    $('.oreg_btn').find('.fa').removeClass('fa-sign-in-alt').addClass('fa-refresh fa-spin');
    
    
      $.ajax({

        url: "{{route('op_reg_response')}}",
        type: 'POST',
        data: $("#operator_reg_frm").serialize(),
        dataType: 'json',
        success: function(data){
              $('.oreg_btn').find('.fa').removeClass('fa-refresh fa-spin').addClass('fa-sign-in-alt');

           if(data.success == 1){
            
             $("#oprgresponse .message").html('Verification link has been sent to your email (Note :-Please check SPAM folder if Link not received in  inbox)');
          $("#oprgresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#oprgresponse').offset().top }, 500);
         $("#operator_reg_frm")[0].reset();
    
            }else{

                $("#oprgresponse").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#oprgresponse .message").html(getError(data.errors));
        $("html, body").animate({ scrollTop: $('#oprgresponse').offset().top }, 1000);
            }
               
      }
 
        
        });
   
 return false;
   });



         $(document).on('submit', "#login_form", function(e) {


        e.preventDefault;
        $(".ssmsg").empty().hide();
      var uemail=$('#uemail').val();
      var upass=$('#upass').val();
      if(uemail == '' || upass == ''){
         $("#response").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#response .message").html('Please Enter Email And Password');
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
      }
      else{


    $('.sub_btn').find('.fa').removeClass('fa-sign-in').addClass('fa-refresh fa-spin');
      $.ajax({

        url: "{{route('login_response')}}",
        type: 'POST',
        data: $("#login_form").serialize()+'&user=user',
        dataType: 'json',
        success: function(data){

            $('.sub_btn').find('.fa').removeClass('fa-refresh fa-spin').addClass('fa-sign-in');
           if(data.status=='success'){
            
             $("#response .message").html('Login Success');
          $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#response').offset().top }, 500);
         
         
    
             window.location.href = "{{route('bookinghistory')}}";
        
    
            }else{

                $("#response").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#response .message").html(data.message);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
            }
               
      },
      error: function(e){ 

                 console.log(e.responseText);
                $("#response").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#response .message").html(e.responseText.message);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                }
        
        });
   }

 return false;
   });   

         $(document).on('submit', "#op_login_form", function(e) {



        e.preventDefault;
        $(".ssmsg").empty().hide();
      var uemail=$('#oemail').val();
      var upass=$('#opass').val();
      if(uemail == '' || upass == ''){
         $("#loresponse").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#loresponse .message").html('Please Enter Email And Password');
        $("html, body").animate({ scrollTop: $('#loresponse').offset().top }, 1000);
      }
      else{


    $('.sub_btn').find('.fa').removeClass('fa-sign-in').addClass('fa-refresh fa-spin');
      $.ajax({

        url: "{{route('op_login_response')}}",
        type: 'POST',
        data: $("#op_login_form").serialize(),
        dataType: 'json',
        success: function(data){

            $('.sub_btn').find('.fa').removeClass('fa-refresh fa-spin').addClass('fa-sign-in');
           if(data.status=='success'){
            
             $("#loresponse .message").html('Login Success');
          $("#loresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#loresponse').offset().top }, 500);
         
         
    
             window.location.href = "{{route('operator.home')}}";
        
    
            }else{

                $("#loresponse").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#loresponse .message").html(data.message);
        $("html, body").animate({ scrollTop: $('#loresponse').offset().top }, 1000);
            }
               
      },
      error: function(e){ 

                $("#loresponse").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#loresponse .message").html(e.responseText.message);
        $("html, body").animate({ scrollTop: $('#loresponse').offset().top }, 1000);
                }
        
        });
   }

 return false;
   });   

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




 function showFormLogin() {
            $('#login_btn').hide();
            $('#signup_btn').show();
            $("#login_div").show().animate({ right: '0' });
            $("#signup_div").hide().animate({ right: '-100px' });
            
        }

 function showFormSignUp() {
            $('#login_btn').show();
            $('#signup_btn').hide();
            $("#signup_div").show().animate({ right: '0' });
            $("#login_div").hide().animate({ right: '-100px' });
            
        }

  </script>
@endsection
