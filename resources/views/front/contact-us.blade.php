
<?php 
$ActiveSide='contact';
?>  
@extends('front.layouts.app')

@section('title','TripOn - Contact Us')

@section('main-content')
        <div class="container">
            <h1 class="page-title">Contact Us</h1>
        </div>




            <div class="container">
            <div class="gap"></div>
            <div class="row">
                <div class="col-md-7">
                   
                    <form class="mt30" id="contact_form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control required" name="name" type="text" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input class="form-control required" name="email" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control required" name="message" rows="3"></textarea>
                        </div>
                       
                        <button class="btn btn-primary conbtn" type="submit">Send Message <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </form>

                         <br>
                      <div id="rgresponse" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
    <br>

                </div>
                <div class="col-md-4">
                    <aside class="sidebar-left">
                                <div class="col-md-12 col-sm-4 col-xs-4">
                                <h5>Email <br> <a href="#">info@tripon.ng</a></h5>
                                <br>
                               </div>
                                <div class="col-md-12 col-sm-4 col-xs-4">
                                <h5>Phone Number<br> <a href="#">+1 (286) 929-1739</a></h5>
                                <br>
                                 </div>
                                 <div class="col-md-12 col-sm-4 col-xs-4">
                                <h5>Address <br><address>TripOn.ng<br />1 Akhere Ugbesia Avenue<br />Abuja Quarters, GRA,<br />Benin City, Edo State<br /></address> </h5>
                                <br>
                              </div>
                       
                    </aside>


                </div>
            </div>
            <div class="gap"></div>
        </div>



  @endsection

  @section('footerSection')   
    <script type="text/javascript">
        
          $(document).on('submit', "#contact_form", function(e) {
            $('.conbtn').find('.fa').removeClass('fa-paper-plane').addClass('fa-refresh fa-spin');
        e.preventDefault;
      
       var errorCounter = chkcValidateForm();
        if (errorCounter > 0) {
          $('.conbtn').find('.fa').removeClass('fa-refresh fa-spin').addClass('fa-paper-plane');
          return false;
        }

     else {
      $.ajax({

        url: "{{route('sendContact')}}",
        type: 'POST',
        data: $("#contact_form").serialize(),
        dataType: 'json',
        success: function(data){

              $('.conbtn').find('.fa').removeClass('fa-refresh fa-spin').addClass('fa-paper-plane');
           if(data.success== 1){
            
             $("#rgresponse .message").html('Thank you for contacting us. We will be in touch with you very soon.');
          $("#rgresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 500);
             $('#contact_form')[0].reset();
    
            }else{


         $("#rgresponse").removeClass("alert-success").addClass("alert-danger").fadeIn();

           $("#rgresponse .message").html(getError(data.errors));
            $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 1000);

            }
               
      }
 
        
        });
    }
 return false;
   });
   
     function getError(errors){
    var op='';
      for(var i=0;i < errors.length;i++){
        op+=errors[i] +'<br>';
      }
      return op;
   }


    function chkcValidateForm() {
      // error handling
      var errorCounter = 0;

      $(".required").each(function(i, obj) {

          if($(this).val() === ''){
              $(this).parent().addClass("has-error");
          
              errorCounter++;
          } else{
              $(this).parent().removeClass("has-error");
          }


      });


      return errorCounter;
  }

    </script>
  @endsection

