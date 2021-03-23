<?php 

ob_start();
session_start();

	if(empty($_POST['bus_id']) || empty($_POST['ticket_id']) || empty($_POST['from_location_id']) || empty($_POST['to_location_id']) ){
		die('<h3> No Direct Allowed</h3>');
	}
	
	
	
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Traveler - Bus payment unregistered</title>


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

<body>

  
    <div class="global-wrap">
       <?php include_once('lib/header.php') ?>

        <div class="gap"></div>
		<?php 
		if(($_POST['passenger']) <= 0){
			die('Please Select Min one passenger');
		}
	   require_once 'config/config.php';

	require_once CLASSPATH.'DB_Functions.php';
	$DBUSER= new DB_Functions();
	
	
	
	$isback = $_POST['isback'];
	
	if(isset($_COOKIE['first_booking']) && $isback == 'Y'){
		$OldData=json_decode($_COOKIE['first_booking']);	
	$Old_bus_id = $OldData->bus_id;
	$Old_ticket_id = $OldData->ticket_id ;
    $Old_from_location_id = $OldData->from_location_id ;
    $Old_to_location_id = $OldData->to_location_id ;
    $Old_pickup_text = $OldData->pickup_text ;
    $Old_return_text = $OldData->return_text ;
    $Old_startimes = $OldData->startimes ;
    $Old_endtimes = $OldData->endtimes ;
    $Old_passenger = $OldData->passenger ;
    $Old_route_id = $OldData->route_id ;
    $Old_seat_no = $OldData->seat_no ;
    $Old_seat_id = $OldData->seat_id ;
    $Old_startBoard = $OldData->startBoard ;
    $Old_endBoard = $OldData->endBoard ;
	
	$Old_seat_no_arr =explode(",",$OldData->seat_no);
	$Old_seat_id_arr =explode(",",$OldData->seat_id);
	
	$Old_starttime=strtotime($Old_startimes);
	$Old_endtime=strtotime($Old_endtimes);
	$Old_timetodisplay = ($Old_endtime - $Old_starttime);
	$Old_routetxt='From '.$Old_pickup_text.' To '.$Old_return_text;
	$Old_Price=$DBUSER->ticketPrice($Old_from_location_id,$Old_to_location_id,$Old_bus_id,$Old_ticket_id);
	}
	else{
		$OldData=array();
	}
	
	$bus_id = $_POST['bus_id'];
	$ticket_id = $_POST['ticket_id'] ;
    $from_location_id = $_POST['from_location_id'] ;
    $to_location_id = $_POST['to_location_id'] ;
    $pickup_text = $_POST['pickup_text'] ;
    $return_text = $_POST['return_text'] ;
    $startimes = $_POST['startimes'] ;
    $endtimes = $_POST['endtimes'] ;
    $passenger = $_POST['passenger'] ;
    $route_id = $_POST['route_id'] ;
    $seat_no = $_POST['seat_no'] ;
    $seat_id = $_POST['seat_id'] ;
	
    $startBoard = $_POST['startBoard'];
    $endBoard = $_POST['endBoard'];
	$seat_no_arr =explode(",",$_POST['seat_no']);
	$seat_id_arr =explode(",",$_POST['seat_id']);
	
	$starttime=strtotime($startimes);
	$endtime=strtotime($endtimes);
	$timetodisplay = ($endtime - $starttime);
	$routetxt='From '.$pickup_text.' To '.$return_text;
	$Price=$DBUSER->ticketPrice($from_location_id,$to_location_id,$bus_id,$ticket_id);
	
	if($Price <= 0 ){
		die('Something get wrong');
	}
	
	
		?>		

        <div class="container">
            <div class="row">
                <div class="col-md-8">
				<?php 
				if(!isset($_SESSION['userId'])){
				?>
                    <h3>Customer</h3>
                    <p>Sign in to your <a href="#">Traveler account</a> for fast booking.</p>
                    <form>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>First & Last Name</label>
                                    <input class="form-control required" id="name-no" type="text" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control required" id="phn-no" type="text" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input class="form-control required" id="email-no" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input class="i-check" id="trvchk" type="checkbox" checked/>Create Traveler account <small>(password will be send to your e-mail)</small>
								
                            </label>
                        </div>
                    </form>
				<?php }
	$startBoard = $_POST['startBoard'];
    $endBoard = $_POST['endBoard'];	
				?>
                    <div class="gap gap-small"></div>
                    <h3>Passengers</h3>
					<?php 
						if($isback == 'Y'){
					?>
                    <ul class="list booking-item-passengers" >
					<form method="post" id="booking_form">
					<input type="hidden" name="isback" value="<?php echo $isback ?>">
					<input type="hidden" name="action" value="bookbus" >
						
					<input type="hidden" name="passengertotal" value="<?php echo $Old_passenger ?>">
					
					<input type="hidden" name="route_id" value="<?php echo $Old_route_id ?>" >
					<input type="hidden" name="ticket_id" value="<?php echo $Old_ticket_id ?>" >
					
					<input type="hidden" name="startBoard" value="<?php echo $Old_startBoard ?>" >
					<input type="hidden" name="endBoard" value="<?php echo $Old_endBoard ?>" >

					<input type="hidden" name="return_passengertotal" value="<?php echo $passenger ?>">
					
					<input type="hidden" name="return_route_id" value="<?php echo $route_id ?>" >
					<input type="hidden" name="return_ticket_id" value="<?php echo $ticket_id ?>" >
					
					<input type="hidden" name="return_startBoard" value="<?php echo $startBoard ?>" >
					<input type="hidden" name="return_endBoard" value="<?php echo $endBoard ?>" >

					<?php
					
					
					for($i=1;$i<count($Old_seat_no_arr);$i++){
					?>
                        <li>
                            <div class="row">
							
							
								 <div class="col-md-1" >
                                    <div class="form-group">
                                        <label>Seat</label>
                                        <input class="form-control" type="text" value="<?php echo $Old_seat_no_arr[$i] ?>" readonly style="padding: 6px 7px;" />
										 <input type="hidden" name="seatno[]" value="<?php echo $Old_seat_no_arr[$i] ?>">
                                   <input type="hidden" name="seatid[]" value="<?php echo $Old_seat_id_arr[$i] ?>">
                                 
                                 
                                    </div>
                                </div>
								
								
								<div class="col-md-2">
										<div class="form-group">
										    <label for="exampleFormControlSelect1">Gender</label>
										    <select class="form-control required" name="passenger[]" >
										      <option value="">-Select-</option>
										      <option value="M">Male</option>
										      <option value="F">Female</option>
										    </select>
										  </div>
									</div>
									
                         
								
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control required" name="name[]" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control required" name="surname[]" type="text" />
                                    </div>
                                </div>
								
						
									
                               <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control required" name="age[]" type="text" style="padding: 6px 7px;"/>
                                    </div>
                                </div>
                            </div>
                        </li>
					<?php 
					
					} ?>
					<h2>Return Tickets </h2>
					
					<?php
					
					
					for($i=1;$i<count($seat_no_arr);$i++){
					?>
                        <li>
                            <div class="row">
							
							
								 <div class="col-md-1" >
                                    <div class="form-group">
                                        <label>Seat</label>
                                        <input class="form-control" type="text" value="<?php echo $seat_no_arr[$i] ?>" readonly style="padding: 6px 7px;" />
										 <input type="hidden" name="return_seatno[]" value="<?php echo $seat_no_arr[$i] ?>">
                                   <input type="hidden" name="return_seatid[]" value="<?php echo $seat_id_arr[$i] ?>">
                                 
                                 
                                    </div>
                                </div>
								
								
								<div class="col-md-2">
										<div class="form-group">
										    <label for="exampleFormControlSelect1">Gender</label>
										    <select class="form-control required" name="return_passenger[]" >
										      <option value="">-Select-</option>
										      <option value="M">Male</option>
										      <option value="F">Female</option>
										    </select>
										  </div>
									</div>
									
                         
								
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control required" name="return_name[]" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control required" name="return_surname[]" type="text" />
                                    </div>
                                </div>
								
						
									
                               <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control required" name="return_age[]" type="text" style="padding: 6px 7px;"/>
                                    </div>
                                </div>
                            </div>
                        </li>
					<?php 
					
					} ?>
					</form>
                    </ul>
						<?php }
					else{
						?>
						 <ul class="list booking-item-passengers" >
					<form method="post" id="booking_form">
					<input type="hidden" name="isback" value="N">
					<input type="hidden" name="action" value="bookbus" >
						
					<input type="hidden" name="passengertotal" value="<?php echo $passenger ?>">
					
					<input type="hidden" name="route_id" value="<?php echo $route_id ?>" >
					<input type="hidden" name="ticket_id" value="<?php echo $ticket_id ?>" >
					<input type="hidden" name="startBoard" value="<?php echo $startBoard ?>" >
					<input type="hidden" name="endBoard" value="<?php echo $endBoard ?>" >

					<?php
					
					
					for($i=1;$i<count($seat_no_arr);$i++){
					?>
                        <li>
                            <div class="row">
							
							
								 <div class="col-md-1" >
                                    <div class="form-group">
                                        <label>Seat</label>
                                        <input class="form-control" type="text" value="<?php echo $seat_no_arr[$i] ?>" readonly style="padding: 6px 7px;" />
										 <input type="hidden" name="seatno[]" value="<?php echo $seat_no_arr[$i] ?>">
                                   <input type="hidden" name="seatid[]" value="<?php echo $seat_id_arr[$i] ?>">
                                 
                                 
                                    </div>
                                </div>
								
								
								<div class="col-md-2">
										<div class="form-group">
										    <label for="exampleFormControlSelect1">Gender</label>
										    <select class="form-control required" name="passenger[]" >
										      <option value="">-Select-</option>
										      <option value="M">Male</option>
										      <option value="F">Female</option>
										    </select>
										  </div>
									</div>
									
                         
								
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control required" name="name[]" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control required" name="surname[]" type="text" />
                                    </div>
                                </div>
								
						
									
                               <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control required" name="age[]" type="text" style="padding: 6px 7px;"/>
                                    </div>
                                </div>
                            </div>
                        </li>
					<?php 
					
					} ?>
					
					</form>
                    </ul>
					<?php } ?>
                    <div class="gap gap-small"></div>
                    <div class="row">
					<div class="col-md-12 text-right">
						<button class="btn btn-primary" id="submit-booking">Submit </button>
						</div>
						<div class="clearfix"> </div>
						 <div class="col-md-12">
            
      <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>

        </div>


                    </div>
                </div>
				<?php 
				if($isback == 'Y'){
					?>
					<div class="col-md-4">
                    <div class="booking-item-payment">
                        <header class="clearfix">
                            <h5 class="mb0">Bus Details</h5>
                        </header>
                        <ul class="booking-item-payment-details">
                            <li>
                                <h5><?php echo $Old_pickup_text ?> - <?php echo  $Old_return_text ?></h5>
                                <div class="booking-item-payment-flight">
                                   <div class="row">
                                        <div class="col-md-8">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5><?php echo date('H:i', strtotime($Old_startimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($Old_startimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $Old_pickup_text ?></p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5><?php echo date('H:i', strtotime($Old_endtimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($Old_endtimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $Old_return_text ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="booking-item-flight-duration">
                                                <p>Duration</p>
                                                <h5><?php echo Jsonfoo($Old_timetodisplay) ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <p><?php echo $pickup_text ?> - <?php echo  $return_text ?></p>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5><?php echo date('H:i', strtotime($startimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($startimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $pickup_text ?></p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5><?php echo date('H:i', strtotime($endtimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($endtimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $return_text ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="booking-item-flight-duration">
                                                <p>Duration</p>
                                                <h5><?php echo Jsonfoo($timetodisplay) ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                           <li>
                                <h5>Bus (<?php echo $Old_passenger ?> Passengers) - <span style="font-size: 12px;"><?php echo $Old_pickup_text ?> to <?php echo  $Old_return_text ?></span></h5>
                                <ul class="booking-item-payment-price">
                                    <li>
                                        <p class="booking-item-payment-price-title"><?php echo $Old_passenger ?> Passengers</p>
                                        <p class="booking-item-payment-price-amount"> ₦<?php echo $Old_Price ?><small>/per passnger</small>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Taxes</p>
                                        <p class="booking-item-payment-price-amount">₦10<small>/per passnger</small>
                                        </p>
                                    </li>
                                </ul>
                            </li> 
							<li>
                                <h5>Bus (<?php echo $passenger ?> Passengers) - <span style="font-size: 12px;"><?php echo $pickup_text ?> to <?php echo  $return_text ?></span></h5>
                                <ul class="booking-item-payment-price">
                                    <li>
                                        <p class="booking-item-payment-price-title"><?php echo $passenger ?> Passengers</p>
                                        <p class="booking-item-payment-price-amount"> ₦<?php echo $Old_Price ?><small>/per passnger</small>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Taxes</p>
                                        <p class="booking-item-payment-price-amount">₦10<small>/per passnger</small>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                       <?php 
						$Old_TotalPrice=$Old_Price*$Old_passenger;
						$Old_TotalTax=10*$Old_passenger;
						$Old_totalTrip=$Old_TotalPrice+$Old_TotalTax;
						
						$TotalPrice=$Price*$passenger;
						$TotalTax=10*$passenger;
						$totalTrip=$TotalPrice+$TotalTax;
						
						$BothTotal=$Old_totalTrip+$totalTrip;
						?>
                        <p class="booking-item-payment-total">Total trip: <span>₦ <?php echo $BothTotal ?></span>
                        </p>
                        </p>
                    </div>
                </div>
					<?php
				}
				else{
				?>
                <div class="col-md-4">
                    <div class="booking-item-payment">
                        <header class="clearfix">
						 
                            <h5 class="mb0"><?php echo $pickup_text ?> - <?php echo  $return_text ?></h5>
                        </header>
                        <ul class="booking-item-payment-details">
                            <li>
                                <h5>Bus Details</h5>
                                <div class="booking-item-payment-flight">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-plane"></i>
                                                    <h5><?php echo date('H:i', strtotime($startimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($startimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $pickup_text ?></p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-plane fa-flip-vertical"></i>
                                                    <h5><?php echo date('H:i', strtotime($endtimes)); ?></h5>
                                                    <p class="booking-item-date"><?php echo date('D, M d', strtotime($endtimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $return_text ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="booking-item-flight-duration">
                                                <p>Duration</p>
                                                <h5><?php echo Jsonfoo($timetodisplay) ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                 
                                </div>
                            </li>
                            <li>
                                <h5>Bus (<?php echo $passenger ?> Passengers)</h5>
                                <ul class="booking-item-payment-price">
                                    <li>
                                        <p class="booking-item-payment-price-title"><?php echo $passenger ?> Passengers</p>
                                        <p class="booking-item-payment-price-amount"> ₦<?php echo $Price ?><small>/per passnger</small>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Taxes</p>
                                        <p class="booking-item-payment-price-amount">₦10<small>/per passnger</small>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
						<?php 
						$TotalPrice=$Price*$passenger;
						$TotalTax=10*$passenger;
						$totalTrip=$TotalPrice+$TotalTax;
						?>
                        <p class="booking-item-payment-total">Total trip: <span>₦ <?php echo $totalTrip ?></span>
                        </p>
                    </div>
                </div>
				<?php } ?>
            </div>
            <div class="gap"></div>
        </div>



        <footer id="main-footer">
            <div class="container">
                <div class="row row-wrap">
                    <div class="col-md-3">
                        <a class="logo" href="index.html">
                            <img src="img/logo-invert.png" alt="Image Alternative text" title="Image Title" />
                        </a>
                        <p class="mb20">Booking, reviews and advices on hotels, resorts, flights, vacation rentals, travel packages, and lots more!</p>
                        <ul class="list list-horizontal list-space">
                            <li>
                                <a class="fa fa-facebook box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-twitter box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-google-plus box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-linkedin box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                            <li>
                                <a class="fa fa-pinterest box-icon-normal round animate-icon-bottom-to-top" href="#"></a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <h4>Newsletter</h4>
                        <form>
                            <label>Enter your E-mail Address</label>
                            <input type="text" class="form-control">
                            <p class="mt5"><small>*We Never Send Spam</small>
                            </p>
                            <input type="submit" class="btn btn-primary" value="Subscribe">
                        </form>
                    </div>
                    <div class="col-md-2">
                        <ul class="list list-footer">
                            <li><a href="#">About US</a>
                            </li>
                            <li><a href="#">Press Centre</a>
                            </li>
                            <li><a href="#">Best Price Guarantee</a>
                            </li>
                            <li><a href="#">Travel News</a>
                            </li>
                            <li><a href="#">Jobs</a>
                            </li>
                            <li><a href="#">Privacy Policy</a>
                            </li>
                            <li><a href="#">Terms of Use</a>
                            </li>
                            <li><a href="#">Feedback</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4>Have Questions?</h4>
                        <h4 class="text-color">+1-202-555-0173</h4>
                        <h4><a href="#" class="text-color">support@traveler.com</a></h4>
                        <p>24/7 Dedicated Customer Support</p>
                    </div>

                </div>
            </div>
        </footer>

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
	  <script type="text/javascript">

	
	    $("#submit-booking").click(function (e) {
        e.preventDefault();
      

    var errorCounter = validateForm();

    if (errorCounter > 0) {
      $('#clientinfo').slideDown('slow');
        $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();
        $("#response .message").html("<strong>Error</strong>: Please Fill Required Fields");
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
    }

   
     else {
    
		var name= $("#name-no").val(); 
		var phn= $("#phn-no").val(); 
		var email= $("#email-no").val(); 
	
	 if($('#trvchk').prop("checked") == true){
              var trvchk='T';
     }
     else if($('#trvchk').prop("checked") == false){
              var trvchk='F';
     }
	
		<?php 
		if($isback == 'Y'){
			?>
 var pickup_id= '<?php echo $Old_from_location_id ?>';
 var return_id =  '<?php echo $Old_to_location_id ?>';
 var bus_id = '<?php echo $Old_bus_id ?>';
 var ticket_id= '<?php echo $Old_ticket_id ?>';
 
 var startdate= '<?php echo $Old_startimes ?>';
 var routetxt= '<?php echo $Old_routetxt ?>';
 var enddate= '<?php echo $Old_endtimes ?>';

 var return_pickup_id= '<?php echo $from_location_id ?>';
 var return_return_id =  '<?php echo $to_location_id ?>';
 var return_bus_id = '<?php echo $bus_id ?>';
 var return_ticket_id= '<?php echo $ticket_id ?>';
 
 var return_startdate= '<?php echo $startimes ?>';
 var return_routetxt= '<?php echo $routetxt ?>';
 var return_enddate= '<?php echo $endtimes ?>';
 
 var rData='&return_pickup_id='+return_pickup_id+'&return_return_id='+return_return_id+'&return_bus_id='+return_bus_id+'&return_ticket_id='+return_ticket_id+'&return_startdate='+return_startdate+'&return_routetxt='+return_routetxt+'&return_enddate='+return_enddate;
		<?php 
		}
	else{		
		?>
 var pickup_id= '<?php echo $from_location_id ?>';
 var return_id =  '<?php echo $to_location_id ?>';
 var bus_id = '<?php echo $bus_id ?>';
 var ticket_id= '<?php echo $ticket_id ?>';
 
 var startdate= '<?php echo $startimes ?>';
 var routetxt= '<?php echo $routetxt ?>';
 var enddate= '<?php echo $endtimes ?>';
 rData='';
	<?php } ?>

    $.ajax({

        url: "cpresponse.php",
        type: 'POST',
        data: $("#booking_form").serialize()+'&fname='+name+'&phone='+phn+'&email='+email+'&regcheck='+trvchk+'&pickup_id='+pickup_id+'&return_id='+return_id+'&bus_id='+bus_id+'&ticket_id='+ticket_id+'&startdate='+startdate+'&enddate='+enddate+'&routetxt='+routetxt+rData,
        dataType: 'json',
        success: function(data){
        
            if(data.status=="success"){
              $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();;
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  
          
           window.setTimeout(function(){window.location.href = "index.php"},1000);
            }
            else{
               $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  
            }
        
        },
        error:function(data){
          
          $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  
        }
        
        });
     }
    });

	
	   function validateForm() {
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
</body>

</html>

<?php 
 function Jsonfoo($seconds) {
  $t = round($seconds);
  return sprintf('%02dh %02dm', ($t/3600),($t/60%60));
}
?>

