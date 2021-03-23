<?php 
$ActiveSide='about';
?>  
@extends('front.layouts.app')

@section('title','TripOn - Reset Password')

@section('main-content')

        <div class="container">
            <div class="row" data-gutter="60">
              



<div class="col-md-6 col-md-offset-3">
    <br>

      
 <div class="panel panel-success">
  <div class="panel-heading">Reset Password</div>
  <div class="panel-body">
    
     <form method="POST" id="reset_password">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="email" value="{{ $email }}">


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
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



        <div class="gap"></div>
        
  @endsection

  @section('footerSection')
        
  <script type="text/javascript">
    

    $(document).on('submit', "#reset_password", function(e) {

        e.preventDefault;
    $("#rgresponse").removeClass("alert-success").addClass("alert-danger").hide();
           $("#rgresponse .message").empty();
   

    $('.reg_btn').find('.fa').addClass('fa-refresh fa-spin');
    
    
      $.ajax({

        url: "{{route('set_pass')}}",
        type: 'POST',
        data: $("#reset_password").serialize(),
        dataType: 'json',
        success: function(data){

            $('.reg_btn').find('.fa').removeClass('fa-refresh fa-spin');
           if(data.success== 1){
            
             $("#rgresponse .message").html('Password Reset Success');
          $("#rgresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 500);
         
                 window.location.href = "{{route('user.login')}}";

            }else{


         $("#rgresponse").removeClass("alert-success").addClass("alert-danger").fadeIn();

           $("#rgresponse .message").html(getError(data.errors));
            $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 1000);

            }
               
      }
 
        
        });
   
 return false;
   });


  function getError(errors){
    var op='';
      for(var i=0;i < errors.length;i++){
        op+=errors[i] +'<br>';
      }
      return op;
   }


  </script>
@endsection




