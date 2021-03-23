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
  

   
    
    <form method="post" id="reset_password">
        <input type="hidden" name="action" value="operator_reset" >
        @csrf

  <fieldset>
   
    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
         <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
     <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
      
         @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    </div>
  
    <button class="btn btn-primary reg_btn" type="submit" />Reset <i class="fa fa-undo"> </i> </button>
   
  </fieldset>
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

        url: "{{route('reset_pass')}}",
        type: 'POST',
        data: $("#reset_password").serialize(),
        dataType: 'json',
        success: function(data){

            $('.reg_btn').find('.fa').removeClass('fa-refresh fa-spin');
           if(data.success== 1){
            
             $("#rgresponse .message").html('Reset link has been send to your registered email address');
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


  function getError(errors){
    var op='';
      for(var i=0;i < errors.length;i++){
        op+=errors[i] +'<br>';
      }
      return op;
   }


  </script>
@endsection




