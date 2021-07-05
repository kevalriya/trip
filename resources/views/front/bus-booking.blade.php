<?php 

ob_start();

$ActiveSide='home';
?>  
@extends('front.layouts.app')


@section('title','TripOn - Booking')
@section('headSection')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">

.insurancetext{
	font-size: 15px;
	font-weight: 500;
}

.panel {
    box-shadow: rgba(46, 61, 73, 0.15) 12px 15px 20px 0px !important;
    margin-top: 50px !important;
    margin-bottom: 50px !important;
    border: none !important;
}
.panel-heading {
    padding: 10px !important;
    height: 60px !important;
}

</style>
@endsection
@section('main-content')


        <div class="gap"></div>
		<?php 
		if(($_POST['passenger']) <= 0){
			die('Please Select Min one passenger');
		}
	 
	
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
	$Old_Tickets=$DBUSER->getTicketType($Old_from_location_id,$Old_to_location_id,$Old_bus_id);
	}
	else{
		$OldData=array();
	}
	
	$bus_id = $_POST['bus_id'];
	
    $from_location_id = $_POST['from_location_id'] ;
    $to_location_id = $_POST['to_location_id'] ;
    $pickup_text = $_POST['pickup_text'] ;
    $return_text = $_POST['return_text'] ;
    $startimes = $_POST['startimes'] ;
    $endtimes = $_POST['endtimes'] ;
    $passenger = $_POST['passenger'] ;
    $route_id = $_POST['route_id'] ;
    $trip_id = $_POST['trip_id'] ;
    $seat_no = $_POST['seat_no'] ;
    $seat_id = $_POST['seat_id'] ;
    $ticket_price=$TRIP->FARE;
    $startBoard = $_POST['startBoard'];
    $endBoard = $_POST['endBoard'];
	$seat_no_arr =explode(",",$_POST['seat_no']);
	$seat_id_arr =explode(",",$_POST['seat_id']);
	
	$starttime=strtotime($startimes);
	$endtime=strtotime($endtimes);
	$timetodisplay = ($endtime - $starttime);
	$routetxt='From '.$pickup_text.' To '.$return_text;
	
				 
		?>		

        <div class="container">
            <div class="row upperdiv">
                <div class="col-md-8">
                	<input type="hidden" id="insuranceval">
				<?php if(!isset(Auth::guard('web')->user()->EMAIL_ADDRESS)){ ?>
                <!-- <script> window.location.href = "/login"; </script> -->
                    <!-- <h3>Customer</h3>
                    <p>Sign in to your <a href="#">Traveler account</a> for fast booking.</p>
                    <form>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>First Name</label>

                                    <input class="form-control required" id="name-no" type="text" />
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" id="last-name" name="lname" type="text" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control required" id="phn-no" type="text" />
                                </div>
                            </div>
                            <div class="col-md-3">
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
                    </form> -->
				<?php
                    return;
                    }
				    else{
					    $FullName= Auth::guard('web')->user()->FIRSTNAME." ".Auth::guard('web')->user()->MIDDLENAME." ".Auth::guard('web')->user()->SURNAME;
					    echo  '<input class="form-control required" id="email-no" type="hidden" value="'.Auth::guard('web')->user()->EMAIL_ADDRESS.'" />';
					    echo  '<input class="form-control required" id="name-no" type="hidden" value="'.$FullName.'" />';
				    }
	                $startBoard = $_POST['startBoard'];
                    $endBoard = $_POST['endBoard'];	
				?>
                    <div class="gap gap-small"></div>
                  
                    <div class="clearfix"></div>
                    <h3>Passengers</h3>
					<?php 
						if($isback == 'Y'){
					?>
					



                    <ul class="list booking-item-passengers" >
					<form method="post" id="booking_form">
						{{ csrf_field() }}
					<input type="hidden" name="isback" value="<?php echo $isback ?>">
					<input type="hidden" name="trip_id" value="{{$TRIP->TRIP_ID}}" >
					<input type="hidden" name="operator_id" value="<?php echo $operator ?>">
					<input type="hidden" name="ftotalval" class="ftotalval"  >
					<input type="hidden" name="ftaxtotalval" class="ftaxtotalval"  >
                    <input type="hidden" name="ftaxtotalval1" class="ftaxtotalval1"  >
					<input type="hidden" name="ltotalval" class="ltotalval"  >
					<input type="hidden" name="ltaxtotalval" class="ltaxtotalval"  >

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
										    <select class="form-control required" name="passenger[]" required>
										      <option value="">-Select-</option>
										      <option value="M">Male</option>
										      <option value="F">Female</option>
										    </select>
										  </div>
									</div>
									
                         
								
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control required" name="name[]" type="text" required/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control required" name="surname[]" type="text" required/>
                                    </div>
                                </div>
								
						
									
                               <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control required" name="age[]" type="text" style="padding: 6px 7px;" required/>
                                    </div>
                                </div>

                                		<div class="col-md-2">
										<div class="form-group">
						 <label for="exampleFormControlSelect1">Ticket Type</label>
										    <select class="form-control ticket-type required" >
										      <option value="">-Select-</option>
										      <?php 
										      foreach ($Old_Tickets as $Ticket) {
										     
										      ?>
										      <option value="1" data-price="<?php echo $Ticket['price'] ?>"><?php echo  $Ticket['ticket'] ?></option>
										     <?php } ?>
										    </select>
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
										    <select class="form-control required" name="return_passenger[]" required>
										      <option value="">-Select-</option>
										      <option value="M">Male</option>
										      <option value="F">Female</option>
										    </select>
										  </div>
									</div>
									
                         
								
								
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control required" name="return_name[]" type="text" required/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control required" name="return_surname[]" type="text" required/>
                                    </div>
                                </div>
								
						
									
                               <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control required" name="return_age[]" type="number" style="padding: 6px 7px;" required/>
                                    </div>
                                </div>

                                		<div class="col-md-2">
										<div class="form-group">
						 <label for="exampleFormControlSelect1">Ticket Type</label>
										    <select class="form-control return-ticket-type required" >
										      <option value="">-Select-</option>
										      <?php 
										      foreach ($Tickets as $Ticket) {
										     
										      ?>
										      <option value="1" data-price="<?php echo $Ticket['price'] ?>"><?php echo  $Ticket['ticket'] ?></option>
										     <?php } ?>
										    </select>
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
						{{ csrf_field() }}
					<input type="hidden" name="isback" value="N">
					<input type="hidden" name="action" value="bookbus" >
					<input type="hidden" name="operator_id" value="<?php echo $operator ?>">
					<input type="hidden" name="passengertotal" value="<?php echo $passenger ?>">
						<input type="hidden" name="ftotalval" class="ftotalval"  >
					<input type="hidden" name="ftaxtotalval" class="ftaxtotalval"  >
                    <input type="hidden" name="ftaxtotalval1" class="ftaxtotalval1"  >
					
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
								
						
									
                               <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input class="form-control required" name="age[]" type="number" style="padding: 6px 7px;"/>
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
                <div class="col-md-12">
                 <p class="insurancetext">	
                 	<label class="checkbox-inline"><input type="checkbox" class="ins-chk" id="isInsuranceChoose" checked>
 Add Travel Insurance And Secure Your Trip With ICICI Lombard Travel Insurance for ₦ 15/Person
</label>

					</p>
					<p class="text-center">(Upon Selection Travel Insurance,You accept the <a href="#" data-toggle="modal" data-target="#terms">Term and Conditions</a> of the travel policy)</p>
                 </div>
                 <div class="clearfix"></div>

               	
               	      	<div class="col-md-3 col-xs-12">
               				
               				  <div class="panel panel-default select-insurance" data-ins="REPATRIATION OF REMAINS">
						<div class="panel-heading text-center">Repatriation Of Remains</div>
						<div class="panel-body text-center">

						<i class="fa fa-plus-square fa-3x" aria-hidden="true" style="margin-bottom: 20px; color:#ED8325;"></i> <br>

							<i class="fa fa-2x fa-check-circle-o  text-success" aria-hidden="true"></i>
								<p>Deductible: Nil </p>
								<p style="font-size: 13px;font-weight: 600">Insured: ₦60 </p>
						</div>
						</div>
					
					</div>	

					  	<div class="col-md-3 col-xs-12">
               				
               		 <div class="panel panel-default select-insurance" data-ins="HOSPITALIZATION">
						<div class="panel-heading text-center">Hospitalization</div>
						<div class="panel-body text-center">
						<i class="fa fa-bed fa-3x" aria-hidden="true" style="margin-bottom: 20px; color:#ED8325;"></i> <br>	
						<i class="fa fa-2x fa-check-circle-o  text-success" aria-hidden="true"></i>

								<p>Deductible: Nil </p>
								<p style="font-size: 13px;font-weight: 600">Insured: ₦10 </p>
						</div>
						</div>
					
					</div>	 
           	                 	<div class="col-md-3 col-xs-12">
               				
               				  <div class="panel panel-default select-insurance" data-ins="HOSPITALIZATION ALLOWANCE">
      <div class="panel-heading text-center">Hospitalization allowance</div>
      <div class="panel-body text-center">
      	<i class="fa fa-hospital-o fa-3x" aria-hidden="true" style="margin-bottom: 20px; color:#ED8325;"></i> <br>	
      	<i class="fa fa-2x fa-check-circle-o text-success" aria-hidden="true"></i>
      	<p>Deductible: ₦5 </p>
      	<p style="font-size: 13px;font-weight: 600">Insured: ₦20 </p>
      </div>
    </div>
					
					</div>	     	<div class="col-md-3 col-xs-12">
               				
               				  <div class="panel panel-default select-insurance" data-ins="HOSPITALIZATION ALLOWANCE">
      <div class="panel-heading text-center">Medical Evacuation</div>
      <div class="panel-body text-center">
      	 <i class="fa fa-ambulance fa-3x" aria-hidden="true" style="margin-bottom: 20px; color:#ED8325;"></i> <br>	

      	
      	<i class="fa fa-2x fa-check-circle-o text-success" aria-hidden="true"></i>
      	<p>Deductible: ₦10 </p>
      	<p style="font-size: 13px;font-weight: 600">Insured: ₦30 </p>
      </div>
    </div>
					
					</div>	 
       
       <div class="col-md-12 text-center">
           <input type="hidden" id="totalTripAmount" />
        <form>
            <script src="{{env('PAYMENT_API_URL')}}" defer></script>
            <button type="button" onClick="makePayment()" class="btn btn-primary checkformvalidation">Pay Now</button>
        </form>
          <!-- <a href="javascript;" class="btn btn-primary checkformvalidation">Proceed</a>	 -->
      </div>
            </div>
                 	  

					<br>

				
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
                                                <div class="booking-item-departure"><i class="fa fa-bus"></i>
                                                    <h5><?php echo date('H:i', strtotime($Old_startimes)); ?></h5>
                                                    <p><?php echo date('D, M d', strtotime($Old_startimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $Old_pickup_text ?></p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-bus fa-flip-vertical"></i>
                                                    <h5><?php echo date('H:i', strtotime($Old_endtimes)); ?></h5>
                                                    <p><?php echo date('D, M d', strtotime($Old_endtimes)); ?></p>
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
                                                <div class="booking-item-departure"><i class="fa fa-bus"></i>
                                                    <h5><?php echo date('H:i', strtotime($startimes)); ?></h5>
                                                    <p><?php echo date('D, M d', strtotime($startimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $pickup_text ?></p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-bus fa-flip-vertical"></i>
                                                    <h5><?php echo date('H:i', strtotime($endtimes)); ?></h5>
                                                    <p><?php echo date('D, M d', strtotime($endtimes)); ?></p>
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
                                        <p class="booking-item-payment-price-amount"> ₦<span class="ftotal"></span><small></small>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Taxes</p>
                                        <p class="booking-item-payment-price-amount">₦<span class="ftaxtotal"></span><small></small>
                                        </p>
                                    </li>
                                </ul>
                            </li> 
							<li>
                                <h5>Bus (<?php echo $passenger ?> Passengers) - <span style="font-size: 12px;"><?php echo $pickup_text ?> to <?php echo  $return_text ?></span></h5>
                                <ul class="booking-item-payment-price">
                                    <li>
                                        <p class="booking-item-payment-price-title"><?php echo $passenger ?> Passengers</p>
                                        <p class="booking-item-payment-price-amount"> ₦<span class="ltotal"></span></small>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Taxes</p>
                                        <p class="booking-item-payment-price-amount">₦<span class="ltaxtotal"></span>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                     
                        <p class="booking-item-payment-total">Total trip: <span>₦ <span class="btotal"></span></span> 


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
                                <h5 style="text-decoration: underline;">Bus Details</h5>
                                <div class="booking-item-payment-flight">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="booking-item-flight-details">
                                                <div class="booking-item-departure"><i class="fa fa-bus"></i>
                                                    <h5><?php echo date('H:i', strtotime($startimes)); ?></h5>
                                                    <p style="margin:0"><?php echo date('D, M d', strtotime($startimes)); ?></p>
                                                    <p class="booking-item-destination"><?php echo $pickup_text ?></p>
                                                </div>
                                                <div class="booking-item-arrival"><i class="fa fa-bus"></i>
                                                    <h5><?php echo date('H:i', strtotime($endtimes)); ?></h5>
                                                    <p style="margin:0"><?php echo date('D, M d', strtotime($endtimes)); ?></p>
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
                                <h5 style="text-decoration: underline;">Service Details</h5>
                                <div class="booking-item-payment-flight">
                                <ul class="booking-item-payment-price">
                                    <li>
                                        <p class="booking-item-payment-price-title">Trip</p>
                                        <p class="booking-item-payment-price-amount" style="font-weight: 600;"><?php echo $pickup_text ?> => <?php echo $return_text ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Service Provider</p>
                                        <p class="booking-item-payment-price-amount"><?php echo $mOperatorDetail->OPERATOR_LEGAL_NAME ?></p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Boarding Point</p>
                                        <p class="booking-item-payment-price-amount"><?php echo $pickup_text ?></p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Boarding Date/Time</p>
                                        <p class="booking-item-payment-price-amount"><?php echo date('M/d/Y', strtotime($startimes)); ?>@<?php echo date('H:iA', strtotime($startimes)); ?></p>
                                    </li>
                                    <!-- <li>
                                        <p class="booking-item-payment-price-title">Bus Type</p>
                                        <p class="booking-item-payment-price-amount"></p>
                                    </li> -->
                                    <li>
                                        <p class="booking-item-payment-price-title">Bus Seat Capacity</p>
                                        <p class="booking-item-payment-price-amount"><?php echo $TRIP->max_seat ?></p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Selected Seat(s)</p>
                                        <p class="booking-item-payment-price-amount"><?php echo Str::substr($seat_no, 2)?></p>
                                    </li>
                                </ul>
                                 
                                </div>
                            </li>

                            <li>
                                <h5 style="text-decoration: underline;">Fare Details (<?php echo $passenger ?> Passengers)</h5>
                                <ul class="booking-item-payment-price">
                                    <li>
                                        <p class="booking-item-payment-price-title">Base Fare X <?php echo $passenger ?></p>
                                        <p class="booking-item-payment-price-amount"> ₦<span class="ftotal"></span>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Travel Insurance X <?php echo $passenger ?></p>
                                        <p class="booking-item-payment-price-amount">₦<span class="ftaxtotal"></span>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="booking-item-payment-price-title">Taxes(5%)</p>
                                        <p class="booking-item-payment-price-amount">₦<span class="ftaxtotal1"></span>
                                        </p>
                                    </li>
                                </ul>
                            </li>
                        </ul>
						
                        <p class="booking-item-payment-total">Total trip: <span style="float: right;">₦ <span class="btotal"></span></span>
                        </p>
                    </div>

                </div>
              
				<?php } ?>

            </div>
			<div class="row">

							 <div class="col-md-8">
            
      <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>

        </div>
			</div>
            <div class="gap"></div>
        </div>


  @endsection

  @section('footerSection')
	  <script type="text/javascript">

                    function getInsurance() {
                          var insurances;
                          var insuranceId = document.getElementById('isInsuranceChoose');
                            if(insuranceId.checked === true) {
                                var insurances = "CHOSEN";
                            } else {
                                var insurances = "DECLINED";
                            }
                        return insurances;
                    }
      
        
        function uuidv4() {
            return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
                (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
            );
        }
            function makePayment() {
            FlutterwaveCheckout({
            public_key: "{{env('PAYMENT_PUBLIC_KEY')}}",
            tx_ref: "ONTRIP-" + uuidv4(),
            amount: document.getElementById("totalTripAmount").value,
            currency: "NGN",
            country: "NG",
            payment_options: " ",
            // redirect_url: "{{route('searchRes')}}",
            meta: {
                consumer_id: 23,
                consumer_mac: "92a3-912ba-1192a",
            },
            customer: {
                email: "{{Auth::guard('web')->user()->EMAIL_ADDRESS}}",
                phone_number: "{{Auth::guard('web')->user()->PHONE_NUMBER_COUNTRY}} {{Auth::guard('web')->user()->PHONE_NUMBER1}}",
                name: "{{Auth::guard('web')->user()->FIRSTNAME}} {{Auth::guard('web')->user()->SURNAME}}",
            },
            callback: function (data) {
                addData(data);
            },
            onclose: function() {
              //  {{route("home")}}
              location.href = "{{route('home')}}"
            },
            customizations: {
                title: "TripOn",
                description: "Payment for trip ticket.",
                logo: "{{url('images/color_logo.png')}}",
            },
            });
        }

		
	    function addData(paymentData) {
            var errorCounter = validateForm();
            if (errorCounter > 0) {
            $('#clientinfo').slideDown('slow');
                $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();
                $("#response .message").html("<strong>Error</strong>: Please Fill Required Fields");
                $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                $('.upperdiv').show();
                $('.underidiv').hide();
            } else {
                var name= $("#name-no").val(); 
                var phn= paymentData.customer.phone_number; 
                var lname= $("#last-name").val();
                var email= paymentData.customer.email;
                var flwRef = paymentData.flw_ref;
                var status = paymentData.status;
                var txRef = paymentData.tx_ref;
                var transactionId = paymentData.transaction_id;
                var insurance = getInsurance();
            if($('#trvchk').prop("checked") == true){
                var trvchk='T';
            }
            else if($('#trvchk').prop("checked") == false){
                var trvchk='F';
            }
            <?php if($isback == 'Y'){ ?>
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
            <?php } else { ?>
                var pickup_id= '<?php echo $from_location_id ?>';
                var return_id =  '<?php echo $to_location_id ?>';
                var bus_id = '<?php echo $bus_id ?>';
                var trip_id='<?php echo $trip_id ?>';
                var route_id='<?php echo $route_id ?>';
                var startdate= '<?php echo $startimes ?>';
                var routetxt= '<?php echo $routetxt ?>';
                var enddate= '<?php echo $endtimes ?>';
                var rData='';
            <?php } ?>
            if(paymentData.status === "successful" || paymentData.status === "pending") {
                $.ajax({
                    url: "{{route('bookingPayment')}}",
                    type: 'POST',
                    data: $("#booking_form").serialize()+'&fname='+name+'&lname='+lname+'&phone='+phn+'&email='+email+'&regcheck='+trvchk+'&pickup_id='+pickup_id+'&return_id='+return_id+'&bus_id='+bus_id+'&startdate='+startdate+'&enddate='+enddate+'&routetxt='+routetxt+'&trip_id='+trip_id+'&route_id='+route_id+'&flwRef='+flwRef+'&status='+status+'&txRef='+txRef+'&transactionId='+transactionId+'&insurance='+insurance+'&PayMethod=ONLINE'+rData,
                    dataType: 'json',
                    success: function(data){
                if(data.success==1){
                    $('#ccfirstname').val(name);	
                    $('#ccemail').val(email);	
                    $('#ccphonenumber').val(phn);	
                    $('#ref').val(data.data.booking);
                    $('form#paymentForm').submit();
                } else {
                    $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
                    $("#response .message").html(data.msg);
                    $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  
                    $('.upperdiv').show();
                    $('.underidiv').hide();
                    }
                    
                },
                error:function(data){
                    $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
                    $("#response .message").html(data.msg);
                    $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  
                    $('.upperdiv').show();
                    $('.underidiv').hide();
                    }    
                });
                }
            }
        }
		  
		
	    $(".checkformvalidation").click(function (e) {
        e.preventDefault();
      	
    var errorCounter = validateForm();

     $("#response").fadeOut();;
      $("#response .message").html('');

    if (errorCounter > 0) {
      $('#clientinfo').slideDown('slow');
        $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();
        $("#response .message").html("<strong>Error</strong>: Please Fill Required Fields");
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);

        $('.upperdiv').show();
    	$('.underidiv').hide();
        return false;

    }
    else{
    	$('.upperdiv').hide();
    	$('.underidiv').show();
    }

      	 
      	});
/*
	    $(".cashpayment").click(function (e) {
        e.preventDefault();
      

    var errorCounter = validateForm();

    if (errorCounter > 0) {
      $('#clientinfo').slideDown('slow');
        $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();
        $("#response .message").html("<strong>Error</strong>: Please Fill Required Fields");
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
        $('.upperdiv').show();
    	$('.underidiv').hide();
    }

   
     else {
    
		var name= $("#name-no").val(); 
		var lname= $("#last-name").val(); 
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
 var trip_id='<?php echo $trip_id ?>';
 var route_id='<?php echo $route_id ?>';
 var ticket_price='<?php echo $ticket_price ?>';

 var startdate= '<?php echo $startimes ?>';
 var routetxt= '<?php echo $routetxt ?>';
 var enddate= '<?php echo $endtimes ?>';
 var rData='';
	<?php } ?>

    $.ajax({


        url: "{{route('bookingPayment')}}",
        type: 'POST',
        data: $("#booking_form").serialize()+'&fname='+name+'&lname='+lname+'&phone='+phn+'&email='+email+'&regcheck='+trvchk+'&pickup_id='+pickup_id+'&return_id='+return_id+'&bus_id='+bus_id+'&startdate='+startdate+'&enddate='+enddate+'&routetxt='+routetxt+'&trip_id='+trip_id+'&route_id='+route_id+'&PayMethod=cash'+rData,
        dataType: 'json',
        success: function(data){
        
            if(data.success==1){
              $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();;
        $("#response .message").html('Success');
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  
          
           window.setTimeout(function(){window.location.href = "bank-transfer"},1000);
            }
            else{
               $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
        $("#response .message").html(getError(data.errors));
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  

        $('.upperdiv').show();
    	$('.underidiv').hide();
            }
        
        },
        error:function(data){
          
          $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
        $("#response .message").html(data.msg);
        $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);  

        $('.upperdiv').show();
    	$('.underidiv').hide();
        }
        
        });
     }
    });
*/
	
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

  if($('.ins-chk')[0].checked){
        BothTicket(15);
    } else BothTicket(0);
 $(document).on('change', ".ticket-type", function(e) {
    if($('.ins-chk')[0].checked){
        BothTicket(15);
    } else BothTicket(0);
 });
  $(document).on('change', ".return-ticket-type", function(e) {
    if($('.ins-chk')[0].checked){
        BothTicket(15);
    } else BothTicket(0);
 });

 $(document).on('click', ".select-insurance", function(e) {

 	  $('.ins-chk').prop('checked',true);
         $('.select-insurance').find('i').removeClass('fa-check-circle').addClass('fa-check-circle-o');
 		$(this).find('i').removeClass('fa-check-circle-o').addClass('fa-check-circle');
 		$('#insuranceval').val($(this).data('ins')) ;
         if($('.ins-chk')[0].checked){
        BothTicket(15);
    } else BothTicket(0);
 });

 $(document).on('click', ".ins-chk", function(e) {
 	$('.select-insurance').find('i').removeClass('fa-check-circle').addClass('fa-check-circle-o');
 	$('#insuranceval').val('') ;
    if(e.target.checked){
        BothTicket(15);
    } else BothTicket(0);
 });

  function totalTicket() {
  	var total='{{$TRIP->FARE}}';
  
	return parseFloat(total);
  }

  function totalRTTicket() {
  	var total=0;
  	$(".return-ticket-type").each(function() {
   		var psnger= $(this).find('option:selected').val();
   		var ticket= $(this).find('option:selected').attr('data-price');
   		if(isNaN(ticket)){
   			var t=0;
   		}
   		else{
   			var t=ticket;
   		}
   		total+=parseFloat(psnger*t);
	});

	return total;
  }

  function BothTicket(insval) {

  	var fpsnger='<?php echo $passenger ?>';
  	var ftotal=totalTicket()*parseFloat(fpsnger);
  	var ftaxtotal=parseFloat(fpsnger*insval);
      var ftaxtotal1=parseFloat((ftotal+ftaxtotal)*0.05);

  	<?php 
		if($isback == 'Y'){
	?>
	var ltotal=totalRTTicket();
  	var lpsnger='<?php echo $Old_passenger ?>';
  	var ltaxtotal=parseFloat(lpsnger*10);

	<?php } 
	else { ?>
	var ltotal=0;
  	var ltaxtotal=0;
	<?php } ?>

	var bothtax=parseFloat(ftaxtotal+ltaxtotal);
	var bothprice=parseFloat(ftotal+0);
	var btotal=parseFloat(ftotal+ftaxtotal+ftaxtotal1);

    $("#totalTripAmount").val(btotal);

	$('.ftotal').text(ftotal);
	$('.ftaxtotal').text(ftaxtotal);
    $('.ftaxtotal1').text(ftaxtotal1);

	$('.ftotalval').val(ftotal);
	$('.ftaxtotalval').val(ftaxtotal);
    $('.ftaxtotalval1').val(ftaxtotal1);

	$('.ltotal').text(ltotal);
	$('.ltaxtotal').text(ltaxtotal);
	$('.ltotalval').val(ltotal);
	$('.ltaxtotalval').val(ltaxtotal);
	$('.btotal').text(btotal);
	$('.btotalval').val(btotal);
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

<?php 
 function Jsonfoo($seconds) {
  $t = round($seconds);
  return sprintf('%02dh %02dm', ($t/3600),($t/60%60));
}
?>

