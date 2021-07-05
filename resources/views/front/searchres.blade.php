   <style>
   @media only screen and (max-width: 600px) {
  .top-10 {
    margin-top: 10px;
}
}
   </style>

   <li class="hidden-xs">
                                        <div class="booking-item-container" data-spy="affix" data-offset-top="175">
                                            <div class="booking-item">
                                                <div class="row text-center">

                                                    <div class="col-md-1">
                                                        <div class="booking-item-airline-logo">
														<h5>Bus</h5>
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="col-md-3">
                                                        <div class="booking-item-flight-details">
                                                            <div class="booking-item-departure">
                                                                <h5>Depart</h5>
                                                                
                                                            </div>
                                                            <div class="booking-item-arrival">
                                                                <h5>Arrive</h5>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- <div class="col-md-2">
                                                        <h5>Duration</h5>                                                  
                                                    </div> -->
                                                     <div class="col-md-1">
                                                        <h5>Rating</h5>                                                  
                                                    </div>

                                                      <div class="col-md-1">
                                                        <h5>Route</h5>                                                  
                                                    </div>

                                                    <div class="col-md-2">
                                                        <h5>Seats</h5>                                                  
                                                    </div>

                                                    <div class="col-md-2">
                                                        <h5>Fare</h5>
                                                       
                                                    </div>

                                                    <div class="col-md-2">
                                                        
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
<?php
    
	if(count($BusesRoutes) > 0 ){
		foreach ($BusesRoutes as $Route) {
		$Dtime=	$Times[$Route->TRIP_ID][$Route->ROUTE_ID][0]['DEPARTURE_TIME'];
        $Atime= $Times[$Route->TRIP_ID][$Route->ROUTE_ID] ? end($Times[$Route->TRIP_ID][$Route->ROUTE_ID])['ARRIVAL_TIME'] : "";
        $sDtime=date('h:i',strtotime($Dtime));
        $sAtime=date('h:i',strtotime($Atime));
		$startimes=$date.' '.$Dtime;
        $endtimes=$date.' '.$Atime;
        $starttime=strtotime($startimes);
        $endtime=strtotime($endtimes);
        $status = $Route->STATUS;
        if($status !== 0) {
	?>

				<li>
                                        <div class="booking-item-container">
                                            <div class="booking-item viewed">
                                                <div class="row text-center">
                                                    <div class="col-md-1 col-xs-3 text-center" style="margin-bottom: 10px">
                                                        <div class="booking-item-airline-logo">
                                                            <?php
                                                            if(isset($Route->FLEET_PHOTO)){
                                                            ?>
                                                            <img src="images/operator/{{$Route->FLEET_PHOTO}}" alt="Image Alternative text" title="Image Title">
                                                        <?php } ?>
                                                            <p>{{ $Route->OPERATOR_LEGAL_NAME }}</p>
                                                        </div>


                                                        <div class="hidden-xl hidden-lg hidden-md hidden-sm col-xs-12" style="margin-top: 10px;">
                                                            <h5><span class="visible-xs">Route</span><a class="popup-text route-details" href="#small-dialog{{$Route->TRIP_ID}}" data-effect="mfp-zoom-out" data-bus="{{$Route->FLEET_REG_ID}}" data-trip="{{$Route->TRIP_ID}}" data-route="{{$Route->ROUTE_ID}}" ><i class="fa  fa-road"></i></a></h5>

                                                            <div id="small-dialog{{$Route->TRIP_ID}}" class="mfp-with-anim mfp-hide mfp-dialog" style="max-width: 850px; max-height: auto; "></div>                                                  
                                                        </div>


                                                    </div>
                                                    <div class="col-md-3 col-xs-9">
                                                        <div class="booking-item-flight-details">
                                                            <div class="booking-item-departure">
                                                                <!-- <i class="fa fa-arrow-circle-up" style="font-size: 3rem; float: left; padding: 1px;"></i> -->
                                                                <h5><span class="visible-xs">Departure</span>{{$sDtime}}</h5>
                                                               <!--  <p class="booking-item-date"></p>
                                                                <p class="booking-item-destination"></p> -->
                                                            </div>
                                                            <div class="booking-item-arrival">
                                                               <!--  <i class="fa fa-arrow-circle-down" style="font-size: 3rem; float: left; padding: 1px;"></i> -->

                                                                <h5><span class="visible-xs">Arrival</span>{{$sAtime}}</h5>
                                                                
																	<!-- <p class="booking-item-date">																</p>
                                                                <p class="booking-item-destination"></p> -->
                                                            </div>
                                                        </div>
              


                                                    </div>
                                                 
											<!-- <div class="col-md-2 col-xs-4">
                                                        <h5><span class="visible-xs">Duration</span>02h 00m</h5>
                                                    </div> -->

    <div class="col-md-1 hidden-xs">
         <div class="booking-item-rating" style="border: 0px;">
         	            <span class="booking-item-rating-number " data-route="13"><span class="visible-xs">Rating</span>4.7 </span>


                                </div>
    </div>

    											<div class="col-md-1 hidden-xs">
                                                        <h5><span class="visible-xs">Route</span><a class="popup-text route-details" href="#small-dialog{{$Route->TRIP_ID}}" data-effect="mfp-zoom-out" data-bus="{{$Route->FLEET_REG_ID}}" data-trip="{{$Route->TRIP_ID}}" data-route="{{$Route->ROUTE_ID}}" ><i class="fa  fa-road"></i></a></h5>

                                                        <div id="small-dialog{{$Route->TRIP_ID}}" class="mfp-with-anim mfp-hide mfp-dialog" style="max-width: 850px; max-height: auto; "></div>                                                  
                                                    </div>


<div class="col-md-2 hidden-xs">
<h5><span class="visible-xs">Seats</span>{{$Route->seat_left}} left</h5>                                                  
</div>

<div class="col-md-2 col-xs-5 top-10">
<span class="visible-xs">Fare</span>
<span class="booking-item-price">  <?php echo ( isset($Route->FARE)) ? '₦'.$Route->FARE : '' ?> </span> 


</div>



<div class="col-md-2 col-xs-4 pull-right top-10">
<button class="btn btn-primary view-seat-ng seatmodal" data-type="6" data-uid="uuidinput{{$Route->TRIP_ID}}" data-bus="{{$Route->FLEET_REG_ID}}" data-trip="{{$Route->TRIP_ID}}" data-pic="{{$Route->ROUTE_ID}}" data-start="{{$startimes}}" data-end="{{$endtimes}}"	data-ret="10" data-seat="{{$Route->SEATMAP_LIB_CODE}}" data-route="{{$Route->ROUTE_ID}}">Select Seat</button>

													<a style="font-size: smaller;" href="#"  data-toggle="modal" data-target="#cancel_policy" >Cancel Policy </a>	
														
													</div>
                                                </div>

                                            </div>
                                            <div class="booking-item-details">
                                                <div class="row">

                <div class="row" style="margin: 0px;">

                
                    
                    <div class="col-md-12 originalSeatMapHere">

                      <div class="col-md-4">
                        <p>
						<form method="post" action="<?php echo $Url ?>" onsubmit="return checkbooking('uuidinput{{$Route->TRIP_ID}}')">
						 {{ csrf_field() }}
						 <h4>Boarding Points</h4>
                        <select class="form-control" name="startBoard" id="startBoard">
                        	<option value="">Select</option>
                        	<?php 
                        	if(is_countable($RoutepointData[$Route->ROUTE_ID]) && count($RoutepointData[$Route->ROUTE_ID]) > 0){
                        	foreach ($RoutepointData[$Route->ROUTE_ID] as $Point) {
                        		 if(!in_array($Point['ROUTE_STOPPOINT_TYPE'], ['DROP-OFF','FINAL'])) {
                        		 	echo "<option value='".$Point['CITY_NAME']."'>".$Point['CITY_NAME']."</option>";
                        		 }
                        	}
                        }
                        	?>
						</select>
                        <div class="gap gap-small"></div>
                        <h4>Drop-off Points</h4>
                        <select class="form-control" name="endBoard" id="endBoard">
                                    <option value="">Select</option>
                            <?php    
                            if(is_countable($RoutepointData[$Route->ROUTE_ID]) && count($RoutepointData[$Route->ROUTE_ID]) > 0){
                        	foreach ($RoutepointData[$Route->ROUTE_ID] as $Point) {
                        		 if(!in_array($Point['ROUTE_STOPPOINT_TYPE'], ['START','PICK-UP'])) {
                        		 	echo "<option value='".$Point['CITY_NAME']."'>".$Point['CITY_NAME']."</option>";
                        		 }
                        	}
                         }
                        ?>      
						</select>
			  
                       

					   <input type="hidden" name="jsondata" value='<?php echo json_encode($_POST); ?>' >
                        <input type="hidden" name="isback" value='<?php echo $isback ?>' >
                        <input type="hidden" name="bus_id" value="<?php echo $Route->FLEET_REG_ID ?>" >
                        <input type="hidden" name="operator_id" value="<?php echo $Route->OPERATOR_CODE ?>" >
                           

                        <input type="hidden" name="seat_no" value="X" id="uuidinput{{$Route->TRIP_ID}}">  

                       <input type="hidden" name="seat_id" value="X" id="uuidinput{{$Route->TRIP_ID}}-main">      
                        <input type="hidden" name="from_location_id" value="<?php echo $pickup_id ?>" >
                        <input type="hidden" name="to_location_id" value="<?php echo $return_id ?>" >
                        
                        <input type="hidden" name="to_location_id" value="<?php echo $return_id ?>" >
                        <input type="hidden" name="pickup_text" value="<?php echo $pickup_text ?>" >
                        <input type="hidden" name="return_text" value="<?php echo $return_text ?>" >
                        
                        <input type="hidden" name="startimes" value="<?php echo $startimes ?>" >
                        <input type="hidden" name="endtimes" value="<?php echo $endtimes ?>" >
                
                        <input type="hidden" name="return_text" value="<?php echo $return_text ?>" >
                        <input type="hidden" name="route_id" value="<?php echo $Route->ROUTE_ID ?>" >
                          <input type="hidden" name="trip_id" value="<?php echo $Route->TRIP_ID ?>" >
                        
                        <input type="hidden" name="passenger" class="passengersel" value="<?php echo $passengerid ?>" >

                            <br><button type="submit" class="btn btn-primary book-tripc" data-from="{{$startimes}}">Book your trip</button>
                        
						</form>
						 
						</p>
                      </div>
                    </div>
                </div>
                
                                        
           
                                                </div>
                                            </div>
                                        </div>
                                    </li>
		
	<?php
	 }
	}
}
	 else{
		 echo "<h5 class='text-danger'>No Bus Found </h5>";
	 }
	


   function Jsonfoo($seconds) {
  $t = round($seconds);
  return sprintf('%02dh %02dm', ($t/3600),($t/60%60));
}

 ?>
