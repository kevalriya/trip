
<!DOCTYPE HTML>
<html class="full">


<!-- Mirrored from remtsoy.com/tf_templates/traveler/demo_v1_7/login-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Mar 2019 19:46:49 GMT -->
<head>
    <title>Traveler - Login register</title>


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="keywords" content="Template, html, premium, themeforest" />
    <meta name="description" content="Traveler - Premium template for travel companies">
    <meta name="author" content="Tsoy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/mystyles.css">
    <script src="js/modernizr.js"></script>

    <link rel="stylesheet" href="css/switcher.css" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/bright-turquoise.css" title="bright-turquoise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/turkish-rose.css" title="turkish-rose" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/salem.css" title="salem" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/hippie-blue.css" title="hippie-blue" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/mandy.css" title="mandy" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/green-smoke.css" title="green-smoke" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/horizon.css" title="horizon" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/cerise.css" title="cerise" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/brick-red.css" title="brick-red" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/de-york.css" title="de-york" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/shamrock.css" title="shamrock" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/studio.css" title="studio" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/leather.css" title="leather" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/denim.css" title="denim" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="css/schemes/scarlet.css" title="scarlet" media="all" />
</head>

<body class="full">

    <div class="global-wrap">
        
        <div class="full-page">
            <div class="bg-holder full">
                <div class="bg-mask"></div>
                <div class="bg-img" style="background-image:url(img/viva_las_vegas_2048x1365.jpg);"></div>
                <div class="bg-holder-content full text-white">
                    <a class="logo-holder" href="index.php">
                        <img src="img/logo-white.png" alt="Image Alternative text" title="Image Title" />
                    </a>
                    <div class="" style="top:15%; position: relative;">
                        <div class="container">
                            <div class="row row-wrap" data-gutter="60">
                                <div class="col-md-4">
                                    <div class="">
                                        <h3 class="mb15">Welcome to Traveler - Operator Portal</h3>
                                        <p>Est nisl facilisis consectetur eget fermentum rutrum suscipit penatibus ultrices eu bibendum mi volutpat mattis cum facilisis nunc platea tincidunt vehicula laoreet montes parturient urna magnis eu etiam eget integer</p>
                                        <p>Nullam consectetur fames erat scelerisque ac conubia orci mauris facilisi</p>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <h3 class="mb15">Login</h3>
                                    <form>
                                        <div class="form-group form-group-ghost form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                                            <label>Username or email</label>
                                            <input class="form-control" placeholder="e.g. johndoe@gmail.com" type="text" />
                                        </div>
                                        <div class="form-group form-group-ghost form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                                            <label>Password</label>
                                            <input class="form-control" type="password" placeholder="my secret password" />
                                        </div>
                                        <input class="btn btn-primary" type="submit" value="Sign in" />
                                    </form>
                                </div> -->
                                <div class="col-md-4">
                                    <h3 >Sign-up as Bus Operator.</h3>
                                              <form method="post" id="operator_user_reg">
									  <input type="hidden" name="type" value="op">
                        <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                            <label>Full Name</label>
                            <input class="form-control" name="name" placeholder="e.g. John Doe" type="text" />
                        </div>
                        <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-show"></i>
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="e.g. johndoe@gmail.com" type="text" />
                        </div>
						
						 <div class="form-group">
                                                <label>Mobile</label>
                                                <input class="form-control" placeholder="+234" value="+234" readonly  style="width: 18%; float: left; margin-right: 2%;" name="ccode" type="text">

                                                <input class="form-control" style="width:80%;" name="mobile" placeholder="XXXXXXXXXX" type="text">
                                            </div>
						
                        <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" placeholder="my secret password" />
                        </div>
                       
						<button class="btn btn-primary oreg_btn" type="submit" > Sign up for Operator <i class="fa"> </i> </button>
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
					<div class="clearfix"></div>
					<br>
                 
                </div>
				
				  
            </div>
        </div>



        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/slimmenu.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/bootstrap-timepicker.js"></script>
        <script src="js/nicescroll.js"></script>
        <script src="js/dropit.js"></script>
        <script src="js/ionrangeslider.js"></script>
        <script src="js/icheck.js"></script>
        <script src="js/fotorama.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
        <script src="js/typeahead.js"></script>
        <script src="js/card-payment.js"></script>
        <script src="js/magnific.js"></script>
        <script src="js/owl-carousel.js"></script>
        <script src="js/fitvids.js"></script>
        <script src="js/tweet.js"></script>
        <script src="js/countdown.js"></script>
        <script src="js/gridrotator.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/switcher.js"></script>
    </div>
	
	<script>
		
		    $(document).on('submit', "#operator_user_reg", function(e) {

        e.preventDefault;
    
   
    $('.oreg_btn').find('.fa').addClass('fa-refresh fa-spin');
    
    
      $.ajax({

        url: "reg_response.php",
        type: 'POST',
        data: $("#operator_user_reg").serialize(),
        dataType: 'json',
        success: function(data){

            $('.oreg_btn').find('.fa').removeClass('fa-refresh fa-spin');
           if(data.status=='success'){
            
             $("#rgresponse .message").html("<strong>" + data.status + "</strong>: " + data.msg);
          $("#rgresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
          
          $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 500);
         
	
            }else{

                $("#rgresponse").removeClass("alert-danger").addClass("alert-danger").fadeIn();
        $("#rgresponse .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#rgresponse').offset().top }, 1000);
            }
               
      }
 
        
        });
   
 return false;
   });

	</script>
</body>


<!-- Mirrored from remtsoy.com/tf_templates/traveler/demo_v1_7/login-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Mar 2019 19:46:49 GMT -->
</html>



