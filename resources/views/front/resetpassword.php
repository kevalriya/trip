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
  

   
    
    <form method="post" id="reset_form">
        <input type="hidden" name="action" value="resetPass">
  <fieldset>
   
         <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" id="resetemail" name="email" aria-describedby="emailHelp" placeholder="Enter email">
      
    </div>
  
    <button class="btn btn-primary sub_btn" type="submit" />Reset <i class="fa fa-undo"> </i> </button>
   
  </fieldset>
</form>
      
                <br>
                      <div id="response" class="alert alert-success" style="display:none;">
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
    $(document).on('submit', "#reset_form", function(e) {

        e.preventDefault;
    
   /*
    $('.sub_btn').find('.fa').removeClass('fa-sign-in').addClass('fa-refresh fa-spin');
      $.ajax({

        url: "cpresponse.php",
        type: 'POST',
        data: $("#reset_form").serialize(),
        dataType: 'json',
        success: function(data){

            $('.sub_btn').find('.fa').removeClass('fa-refresh fa-spin').addClass('fa-sign-in');
           if(data.status=='success'){
            
             $("#response .message").html(data.msg);
          $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#response').offset().top }, 500);
       
    
            }else{

                $("#response").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
            }
               
      }
 
        
        });*/
   
 return false;
   });
  </script>
@endsection




