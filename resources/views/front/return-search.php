<?php 
ob_start();

   require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DB= new DB_Functions();
$extraStyle=array(ROOTURL.'css/admin.css','http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',ROOTURL.'css/fontawesome-stars.css');
 $pagetitle="TripOn - Return Buses"; 
    

	include_once('lib/header.php'); 

	
	
	
    $Data=json_decode($_POST['jsondata']);
	
	unset($_COOKIE['first_booking']);
	
	$Data->bus_id = $_POST['bus_id']; 
    $Data->ticket_id = $_POST['ticket_id']; 
    $Data->seat_no = $_POST['seat_no']; 
    $Data->seat_id = $_POST['seat_id']; 
    $Data->from_location_id = $_POST['from_location_id']; 
    $Data->to_location_id = $_POST['to_location_id']; 
    $Data->pickup_text = $_POST['pickup_text']; 
    $Data->return_text = $_POST['return_text']; 
    $Data->startimes = $_POST['startimes']; 
    $Data->endtimes = $_POST['endtimes']; 
    $Data->route_id = $_POST['route_id']; 
    $Data->passenger = $_POST['passenger']; 
    $Data->startBoard = $_POST['startBoard']; 
    $Data->endBoard = $_POST['endBoard']; 
	 
	
	$Kdata=json_encode($Data);
	$passengers = trim(strip_tags($_POST['passenger']));
	setcookie('first_booking',$Kdata, time() + (86400 * 30), "/");

	
	$from = trim(strip_tags($Data->totxt));


    $fromid = trim(strip_tags($Data->return_id));
    $to = trim(strip_tags($Data->fromtxt));
    $toid = trim(strip_tags($Data->pickup_id));
    $start = trim(strip_tags($Data->returning));
    $isreturn = 'F';
    $end =(isset($Data->end)) ?  trim(strip_tags($Data->end)) : null;
    
	$Gbustypes=(isset($Data->busTypes)) ? $Data->busTypes : array();
    ?>




                    <div class="container">
                      
                        <div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="search-dialog" style="display: none;">
                            <h3>Search for Bus</h3>
                            <form>
                                <div class="tabbable">
                                    <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
                                        <li class="active"><a href="#flight-search-1" data-toggle="tab">Round Trip</a>
                                        </li>
                                        <li><a href="#flight-search-2" data-toggle="tab">One Way</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="flight-search-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                                        <label>From</label>
                                                        <input class="typeahead form-control" placeholder="City, Airport or U.S. Zip Code"  type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                                        <label>To</label>
                                                        <input class="typeahead form-control" placeholder="City, Airport or U.S. Zip Code"   type="text" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-daterange" data-date-format="MM d, D">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                            <label>Departing</label>
                                                            <input class="form-control" name="start" type="text" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                            <label>Returning</label>
                                                            <input class="form-control" name="end" type="text" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-lg form-group-select-plus">
                                                            <label>Passengers</label>
                                                            <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                                <label class="btn btn-primary active">
                                                                    <input type="radio" name="options" />1</label>
                                                                <label class="btn btn-primary">
                                                                    <input type="radio" name="options" />2</label>
                                                                <label class="btn btn-primary">
                                                                    <input type="radio" name="options" />3</label>
                                                                <label class="btn btn-primary">
                                                                    <input type="radio" name="options" />4</label>
                                                                <label class="btn btn-primary">
                                                                    <input type="radio" name="options" />5</label>
                                                                <label class="btn btn-primary">
                                                                    <input type="radio" name="options" />5+</label>
                                                            </div>
                                                            <select class="form-control hidden">
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                                <option selected="selected">6</option>
                                                                <option>7</option>
                                                                <option>8</option>
                                                                <option>9</option>
                                                                <option>10</option>
                                                                <option>11</option>
                                                                <option>12</option>
                                                                <option>13</option>
                                                                <option>14</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="flight-search-2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                                        <label>From</label>
                                                     
														 <input id="search-box-uprs" class="form-control" placeholder="From City" type="text" name="from" oninput="clientSelOpt(this,'fromid-upr','getFromCity')"  autocomplete="something" value="<?php echo $from ?>" />
														 <input type="hidden" id="fromid-upr"  name="fromid" value="<?php echo $fromid ?>"> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                                        <label>To</label>
                                                        <input class="typeahead form-control" placeholder="To City" value="<?php echo $to ?>" type="text" />
													
 <input id="search-to-upr" class="form-control" oninput="clientSelOpt(this,'toid-upr','getToCity')" placeholder="To City" type="text" name="to"  autocomplete="something-new" />
							
							<input type="hidden" id="toid-upr"  name="toid" value="<?php echo $toid ?>"> 													
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                                        <label>Departing</label>
                                                        <input class="date-pick form-control" data-date-format="yyyy-mm-dd" value="<?php echo $start ?>" type="text" />
                                                    </div>
                                                </div> 
																
												
											
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg form-group-select-plus">
                                                        <label>Passengers</label>
                                                        <div class="btn-group btn-group-select-num" data-toggle="buttons">
                                                            <label class="btn btn-primary active">
                                                                <input type="radio" name="options" />1</label>
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="options" />2</label>
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="options" />3</label>
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="options" />4</label>
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="options" />5</label>
                                                            <label class="btn btn-primary">
                                                                <input type="radio" name="options" />5+</label>
                                                        </div>
                                                        <select class="form-control hidden">
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option selected="selected">6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10</option>
                                                            <option>11</option>
                                                            <option>12</option>
                                                            <option>13</option>
                                                            <option>14</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-lg" type="submit">Search for Bus</button>
                            </form>
                        </div>
                        <h3 class="booking-title"> Buses from <?php echo $from ?> to <?php echo $to ?> on <?php echo date('M d',strtotime($start))  ?></h3>
                        <form class="booking-item-dates-change mb30" style="display: none;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-hightlight"></i>
                                        <label>From</label>
                                        <input id="search-box" class="form-control" placeholder="From City" type="text" name="from" oninput="clientSelOpt(this,'fromid','getFromCity')"  autocomplete="something" value="<?php echo $from ?>" />
														 <input type="hidden" id="fromid"  name="fromid" value="<?php echo $fromid ?>"> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-hightlight"></i>
                                        <label>To</label>
                                              
 <input id="search-to" class="form-control" oninput="clientSelOpt(this,'toid','getToCity')" placeholder="To City" type="text" name="to" value="<?php echo $to ?>" autocomplete="something-new" />
							
							<input type="hidden" id="toid"  name="toid" value="<?php echo $toid ?>"> 							
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                        <label>Departing</label>
                                        <input class=" form-control resultchange" id="departing" value="<?php echo $start ?>"  data-date-format="yyyy-mm-dd" type="text" />
										
                                    </div>
                                </div>
								<?php
					if(isset($end)){								
								?>
								<div class="col-md-2">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                        <label>Returning</label>
                                        <input class=" form-control resultchange" id="returning" value="<?php echo $end ?>"  data-date-format="yyyy-mm-dd" type="text" />
										
                                    </div>
                                </div>
								<?php } ?>
                                <div class="col-md-2">
                                    <div class="form-group form-group-select-plus">
									<?php 
										if($passengers <= 4){
											$cls='hidden';
											$ucls='';
										}
										else{
											$cls='';
											$ucls='hidden';
										}
									
										?>
										
                                        <label>Passengers</label>
                                        <div class="btn-group btn-group-select-num <?php echo $ucls ?>" data-toggle="buttons">
										
                                            <label class="btn btn-primary inputcl <?php echo ($passengers == '1') ?  'active' : '' ?>" data-val="1">
											
                                                <input type="radio" name="options" />1</label>
                                            <label class="btn btn-primary inputcl <?php echo ($passengers == '2') ?  'active' : '' ?>" data-val="2">
                                                <input type="radio" name="options" />2</label>
                                            <label class="btn btn-primary inputcl <?php echo ($passengers == '3') ?  'active' : '' ?>" data-val="3">
                                                <input type="radio" name="options" />3</label>
                                            <label class="btn btn-primary inputcl <?php echo ($passengers == '4') ? 'active' : '' ?>" data-val="4">
                                                <input type="radio" name="options" />4</label>
										
                                            <label class="btn btn-primary">
                                                <input type="radio" name="options" />4+</label>
                                        </div>
                                        <select class="form-control <?php echo $cls ?>" id="passengerid">
										
										<?php 
										for($i=0;$i<=14;$i++){
											if($i==$passengers){
												$sel='selected="selected"';
											}
											else{
												$sel="";
											}
										 echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
										}
										
										?>
                                            
                                        </select>
										<input type="hidden" id="mpassid" value="<?php echo $passengers ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-3">
                                <aside class="booking-filters text-white">
                                    <h3>Filter By:</h3>
                                    <ul class="list booking-filters-list">
                                    <?php 
                                        
                                            if(count($DBAmenities)){
                                            ?>
                                        <li>
                                            <h5 class="booking-filters-title">Amenities </h5>
                                            <?php 
                                            foreach($DBAmenities as $Key => $Type){
                                                if (in_array($Key, $Gbustypes))
                                                      {
                                                      $checked= "checked";
                                                      }
                                                    else
                                                      {
                                                      $checked= "";
                                                      }
                                            ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input class="i-check clickresult" type="checkbox" value="<?php echo $Key ?>" name="amenitie[]" <?php echo $checked ?> /><?php echo ucfirst($Type) ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </li>
                                            <?php } ?>
                                        <li>
                                            <h5 class="booking-filters-title">Price </h5>
                                            <input type="text" id="price-sliderz" value="5;1000" >
                                        </li>
                                        

                                            <?php 
                                            $busTypes=$DB->busType();
                                            if($busTypes != false){
                                            ?>
                                        <li class="scroll-li">
                                            <h5 class="booking-filters-title">Bus Type </h5>
                                            <?php 
                                            foreach($busTypes as $Type){
                                               
                                            ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input class="i-check clickresult" type="checkbox" value="<?php echo $Type['id'] ?>" name="bustypes[]" /><?php echo ucfirst($Type['name']) ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </li>
                                            <?php } 


                                            $busOperators=$DB->getOperator();
                                            if($busOperators != false){
                                            ?>


                                            <li>
                                                <h5 class="booking-filters-title">Operators <small>Price from</small></h5>
                                            <?php 
                                            
                                            foreach($busOperators as $OP){
                                               if($OP['id'] == $operatorId)
                                                   {
                                                    $ch= "checked";
                                                   }
                                                   else
                                                   {
                                                    $ch= "";
                                                   }
                                            ?>
                                            <div class="checkbox">
                                                    <label>
                                                        <input class="i-check" type="checkbox" value="<?php echo $OP['id']?>"  name="operator[]" <?php echo $ch ?> /><?php echo $OP['name'] ?><span class="pull-right"><?php echo (isset($OP['minprice'])) ? '₦'.$OP['minprice'] : '' ?></span>
                                                    </label>
                                                </div>
                                         <?php } ?>
                                            </li>
                                        <?php } ?>
                                      
                                        <li>
                                            <h5 class="booking-filters-title">Departure Time</h5>
                                            <div class="checkbox">
                                                <label>
                                                    <input class="i-check" type="checkbox" value="05:00:00-11:59:00" name="dptime[]" />Morning (05:00 - 11:59)</label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input class="i-check" type="checkbox" value="12:00:00-17:59:00" name="dptime[]" />Afternoon (12:00 - 17:59)</label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input class="i-check" type="checkbox" value="18:00:00-23:59:00" name="dptime[]" />Evening (18:00 - 23:59)</label>
                                            </div>
                                        </li>
                                    </ul>
                                </aside>
                            </div>
                            <div class="col-md-9">
                                <div class="nav-drop booking-sort">
                                    <h5 class="booking-sort-title"><a href="#">Sort: Sort: Price (low to high)<i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a></h5>
                                    <ul class="nav-drop-menu">
                                        <li><a href="#">Price (high to low)</a>
                                        </li>
                                        <li><a href="#">Duration</a>
                                        </li>
                                        <li><a href="#">Stops</a>
                                        </li>
                                        <li><a href="#">Arrival</a>
                                        </li>
                                        <li><a href="#">Departure</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="booking-list">


                                <li>
                                        <div class="booking-item-container">
                                            <div class="booking-item">
                                                <div class="row">

                                                    <div class="col-md-2">
                                                        <div class="booking-item-airline-logo">
														<h5>Operator</h5>
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="col-md-4">
                                                        <div class="booking-item-flight-details">
                                                            <div class="booking-item-departure">
                                                                <h5>Departure</h5>
                                                                
                                                            </div>
                                                            <div class="booking-item-arrival">
                                                                <h5>Arrival</h5>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                 

                                                     <div class="col-md-2">
                                                        <h5>Rating</h5>                                                  
                                                    </div>

                                                    <div class="col-md-2">
                                                        <h5>Fare</h5>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>




                                    
                                  
                                </ul>
                                <p class="text-right">Not what you're looking for? <a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">Try your search again</a>
                                </p>
                            </div>
                        </div>
                        <div class="gap"></div>
                    </div>



                   <?php include_once 'lib/footer.php'; ?>
					
		 <div id="insert_seat" class="modal fade">
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
              
              <h4 class="modal-title ">Select Seat</h4>
            
		      </div>
                <div class="modal-body">

					</div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
     </div>
    </div>

    <div id="rating_route" class="modal fade" >
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">×</button>
              <h4 class="modal-title ">Rating</h4>
            
              </div>
                <div class="modal-body">

                </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
     </div>
    </div>
             <span class="fa fa-filter __filter_hook"></span>

<script src="js/jquery.barrating.min.js" type="text/javascript"></script>
        <script type="text/javascript">

              $('.__filter_hook').click(function(){
                $('aside.booking-filters.text-white').toggleClass('open');
            });

         var locData=[];
        getBusResult();
	
		$('#departing').datepicker({
			autoclose:true,
		}).on('change',function(e){
			$('#departing').val($(this).val());
		getBusResult();

		});
		
		$('#returning').datepicker({
			autoclose:true,
		}).on('change',function(e){
			$('#returning').val($(this).val());
		getBusResult();

		});
		
		$('input').on('ifChanged', function(event){

			getBusResult();
		});
		


		$(document).on('change','#passengerid', function(event){

			$('.passengersel').val($(this).val());
		});
	
	$(document).on('click', '.yes-available', function(event) {
	var uid=$('#insert_seat').find('#seat-uuid').val();
	var oldval=$('#'+uid).val();
	var oldvalsid=$('#'+uid+'-main').val();
	var array = oldval.split(',');
	var totalPass=$('#mpassid').val();  
	if(array.length <= totalPass ){
		var seatno=$(this).attr('data-name');
		var seatid=$(this).attr('data-id');
		$(this).addClass('bs-selected');
		$(this).removeClass('yes-available');
		
		$('#'+uid).val(oldval+','+seatno);
		$('#'+uid+'-main').val(oldvalsid+','+seatid);
		var str=oldval+','+seatno;
		 var res =str.replace("X,", "");
		$('#'+uid+'-text').text('- Seat #'+res + ' selected');
		
		
		}
		
	});
		
		 $(".inputcl").click(function(){
	
    $('select option[value="' + $(this).attr('data-val') +'"]').prop("selected", true);
	$('.passengersel').val($(this).attr('data-val'));
	$('#mpassid').val($(this).attr('data-val'));
  });
	

    $(document).on('click', '.submit-review', function(event) {
      var rating=  $('#rating_route').find('#ratingm').val();
      var review=  $('#rating_route').find('#reviewtxt').val();
      var router=  $('#rating_route').find('#router').val();
         $.ajax({
    url: "cpresponse.php",
    type: 'post',
    data: {
     action: 'routeRating',rating:rating,review,review,route:router
    },
    success: function( data ) {
     
       $('#rating_route').modal('hide');
    }
   });
  });
    
	
			$(document).on('click', '.booking-item-container .booking-item', function(event) {
	
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $(this).parent().removeClass('active');
    } else {
        $(this).addClass('active');
        $(this).parent().addClass('active');
        $(this).delay(1500).queue(function() {
            $(this).addClass('viewed')
        });
    }
});
	
	$(document).on('click', ".confirm-seat", function(e) {
	
	$('#insert_seat').modal('hide');
	});
		
	$(document).on('click', ".close-seat", function(e) {
		
	var uid=$(this).attr('data-id');
	console.log(uid);
	var oldval=$('#'+uid).val('X');
	var oldvalsid=$('#'+uid+'-main').val('X');
	var oldvalsid=$('#'+uid+'-text').text('');
	$('#insert_seat').modal('hide');
	});
	
	
	$(document).on('click', ".seatmodal", function(e) {

	   		e.preventDefault;
	   		
	   	
	   	$('#insert_seat').find('.modal-body').empty();
       	var bustype=$(this).attr('data-type');
       	var uid=$(this).attr('data-uid');
	
		var route_id=$(this).attr('data-route');
		var pickup_id=$(this).attr('data-pic');
		var return_id=$(this).attr('data-ret');
		var bus_id=$(this).attr('data-bus');
		var startDate=$(this).attr('data-start');
		var endDate=$(this).attr('data-end');
		var seat=$(this).attr('data-seat');
		
		
     var oldval=$('#'+uid).val('X');
	var oldvalsid=$('#'+uid+'-main').val('X');
	
	
       $('#insert_seat').find('.modal-body').load('seat.php',{bustype:bustype,uid:uid,route_id:route_id,pickup_id:pickup_id,return_id:return_id,bus_id:bus_id,seat:seat,startDate:startDate,endDate:endDate},function(){
       $('#insert_seat').modal({ backdrop: 'static', keyboard: false });
       
     
    });
	$(this).find('.i-check').addClass('checked');
	   	 return true;
       });
	

        $(document).on('click', ".rating-user", function(e) {

            e.preventDefault;
            
        
        $('#rating_route').find('.modal-body').empty();
     
        var route_id=$(this).attr('data-route');
        
       $('#rating_route').find('.modal-body').load('rating.php',{route:route_id},function(){
        $('#rating_route').modal({ backdrop: 'static', keyboard: false });

           $(function() {
            if($('#rating_route').find('#ratingread').val() == '0'){
            var readon=true;
            var host=false;
        }
        else{
             var readon=false;
             var host=true;
        }
   
            $('.rating').barrating({
                theme: 'fontawesome-stars',
                hoverState: host,
                readonly: readon,
                onSelect: function(value, text, event) {

                 $('#rating_route').find('#ratingm').val(value);
                }
            });
        });
     
    });

         return true;
       });
		//pricefrom:pricefrom,priceto:priceto
		  $("#price-sliderz").ionRangeSlider({
        type: "double",
		 grid: true,
        min: 130,
        max: 1000,
        from: 130,
        to: 1000,
		skin: "flat",
        prefix: " ₦",
        prettify: false,
        hasGrid: true,
        onFinish: function(data){
            
           getBusResult();
        }
    });
		

	$('.route-details').magnificPopup({
    removalDelay: 500,
    closeBtnInside: true,
    callbacks: {
        beforeOpen: function() {
            this.st.mainClass = this.st.el.attr('data-effect');
        }
    },
    midClick: true
});

	// Lightbox iframe
	$('.popup-iframe').magnificPopup({
		dispableOn: 700,
		type: 'iframe',
		removalDelay: 160,
		mainClass: 'mfp-fade',
		preloader: false
	});

	
      function getBusResult(){
		
		var from=$('#fromid').val();    
        var to=$('#toid').val();   
        var startdate=$('#departing').val();
        //var startdate='2019-03-29';
		var isreturn='F';
        var fromtxt=$('#search-box').val(); 
        var totxt=$('#search-to').val(); 
        var passengerid=$('#passengerid :selected').val(); 
      
	  var busTypes = [];
$("input[name='bustypes[]']:checked").each(function(){busTypes.push($(this).val());});
	 var classtype = [];
	$("input[name='classtype[]']:checked").each(function(){classtype.push($(this).val());});
		 var dptime = [];
	$("input[name='dptime[]']:checked").each(function(){dptime.push($(this).val());});
	
	var price=$("#price-sliderz").val();
	
    if(from != '' || to !='' || startdate !=''){
   
    $.ajax({
        url: "searchres.php",
        type: "POST",
        data : {fromtxt:fromtxt,totxt:totxt,pickup_id:from,return_id:to,passengerid:passengerid,isreturn:isreturn,dpdate:startdate,busTypes:busTypes,classtype:classtype,dptime:dptime,price:price,isback:'yes'},
       success: function(data){
        $('.booking-list').empty();
        $('.booking-list').html(data);
        	 $('[data-toggle="tooltip"]').tooltip();   
	$('.route-details').magnificPopup({
    removalDelay: 500,
    closeBtnInside: true,
 
	 callbacks : {
		 
		  beforeOpen: function() {
            this.st.mainClass = this.st.el.attr('data-effect');
        },
		
        open : function(){
			
			     var mpz = $.magnificPopup.instance,
          tz = $(mpz.currItem.el[0]);
		
			var busid=tz.attr('data-bus');
			var routeid=tz.attr('data-route');
		var fromtxt=$('#search-box').val(); 
        var totxt=$('#search-to').val(); 
           $.ajax({
              type: "POST",
			  data:{busid:busid,routeid:routeid,fromtxt:fromtxt,totxt:totxt},
              url: "route-detail.php",
              success: function(html) {
				
               var mp = $.magnificPopup.instance,
          t = $(mp.currItem.el[0]);

			var did=t.attr('href');
			$(did).empty();
			$(did).html(html);
			

	
			initMap();
			
              }  
           });
        }
      },
    midClick: true
});

	
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
    }
 
    }
	
	    function clientSelOpt(t,main,action) {
    var id='#'+t.id;
	
       $(id).autocomplete({
  source: function( request, response ) {
   // Fetch data
   $.ajax({
    url: "cpresponse.php",
    type: 'post',
    dataType: "json",
    data: {
     search: request.term,action:action
    },
    success: function( data ) {
          response( $.map( data, function( item ) {

                        return {    label: item.label,
                                    value: item.label,
                                    mid: item.value,
                                   

                                    }
                    }));
    }
   });
  },
  select: function (event, ui) {
   // Set selection
   $(id).val(ui.item.label); // display the selected text
   $('#'+main).val(ui.item.mid); // save selected id to input
   getBusResult();
   return false;
  }
 }).focus(function () {
    $(this).autocomplete("search");
  }).autocomplete( "instance" )._renderItem = function( ul, item ) {


      return $( "<li>" )
        .append( "<div class='underline'><i class='fa fa-map-marker' aria-hidden='true'></i> " + item.label + "</div>" )
        .appendTo( ul );
    };


  }

  function checkbooking(id){
	  
	  var oldval=$('#'+id).val();
	  var str=oldval;
	var res =str.replace("X", "");
	
	
	if(res == ''){
		alert('Please Select Seat first');
		return false;
	}
	else{
		return true;
	}
  }
        </script>        

		<script>
		    function initMap(){
    directionsService = new google.maps.DirectionsService();

    var myOptions = {
        zoom: 15,
        
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
	
	
    map = new google.maps.Map(document.getElementById('map'), myOptions);
    directionsDisplay = new google.maps.DirectionsRenderer({map: map, suppressMarkers: true});
	
	 var waypts = [];
           var checkboxArray = document.getElementById('waypoints');
        for (var i = 0; i < checkboxArray.length; i++) {
          if (checkboxArray.options[i].selected) {
            waypts.push({
              location: checkboxArray[i].value,
              stopover: true
            });
          }
        }

		
    directionsService.route({
        origin:  document.getElementById('search-box').value,
        destination: document.getElementById('search-to').value,
        waypoints: waypts, //other duration points
        optimizeWaypoints: true,
        travelMode: google.maps.TravelMode.DRIVING
    }, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
			var my_route = response.routes[0];
            for (var i = 0; i < my_route.legs.length; i++) {
                var marker = new google.maps.Marker({
                    position: my_route.legs[i].start_location,
                    label: ""+(i+1),
                    map: map
                });
            }
            var marker = new google.maps.Marker({
                position: my_route.legs[i-1].end_location,
                label: ""+(i+1),
                map: map
            });
        } else {
            vts.alertDialog( window.localization.error,
                window.localization.error_direction_calculate + ": " + status,
                BootstrapDialog.TYPE_DANGER);
        }
    });

}    
		</script>
		
		 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi6mRd9VA96WNfQAz3JWbF3-WK-sLFIZY">
    </script>
            </body>

            </html>



