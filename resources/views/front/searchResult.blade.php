<?php 
$ActiveSide='home';
?>  
@extends('front.layouts.app')


@section('title','TripOn - Buses search results')
@section('headSection')

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('front/css/fontawesome-stars.css') }}">

    <style>
    .seat_layout td{
        text-decoration: none;
        display: inline;
        padding: 8px;
    }
    .pos{
        background-color: #fff;
        padding: 1px 10px;
    }
    .seat{
        background: url("{{url('images/seatk.png')}}");
        background-size: contain;
        padding: 1px 10px;
    }

    .steering{
        background: url("{{url('images/steering.png')}}");
        background-size: contain;
        padding: 1px 10px;
    }
    .bookseat{
    
        background: url("{{url('images/bookseat.png')}}");
        background-size: contain;
        padding: 1px 10px;
        border-radius: 5px;
    
    }
    .selectseat{
    
        background: url("{{url('images/selectseat.png')}}");
        background-size: contain;
        padding: 1px 10px;
        border-radius: 5px;
    
    }
    .door{
        background: url("{{url('images/door.png')}}");
        background-size: contain;
        padding: 1px 10px;
    }
    .legends li{
        text-decoration: none;
        padding: 10px;
    }
    .borderless td, .borderless th {
    border: none;
    
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        border-top: 1px solid transparent;  
    }


    .table.seats_table {
        width: 100%;
        max-width: 350px;
        text-align: center;
       
    }

    .seats_table td span {
        background-size: contain;
        padding: 7px 16px;
        background-repeat: no-repeat !important;
        background-position: center;
        height: 43px;
        display: inline-block;
    }

    .booking-filters{
        width: 100%;
    }
    .irs-line,.irs {
        overflow: hidden;
    }

   @media(max-width:425px){ 
          .table.seats_table {
       
        margin: 30px auto;
    }

    }

</style>


@endsection
@section('main-content')

<?php 


$From=trim(strip_tags($_GET['from']));
$To=trim(strip_tags($_GET['to']));
$fdate=trim(strip_tags($_GET['start']));


    
	$from = trim(strip_tags($_GET['from']));
    $fromid = trim(strip_tags($_GET['fromid']));
    $to = trim(strip_tags($_GET['to']));
    $toid = trim(strip_tags($_GET['toid']));
    $start = trim(strip_tags($_GET['start']));
    $isreturn = trim(strip_tags($_GET['isreturn']));
    $end =(isset($_GET['end'])) ?  trim(strip_tags($_GET['end'])) : null;
    $operatorId =(isset($_GET['op'])) ?  trim(strip_tags($_GET['op'])) : null;
    $passengers = trim(strip_tags($_GET['passengers']));
	$Gbustypes=(isset($_GET['bustypes'])) ? $_GET['bustypes'] : array();
    ?>




                    <div class="container">
                      
                        <div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="search-dialog">
                            <h3>Search for Bus</h3>
                          
                                <div class="tabbable">
                                    <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
										 <li class="active" data-type="single"><a href="#flight-search-2" data-toggle="tab">One Way</a>
                                        </li>
									   <li data-type="round"><a href="#flight-search-1" data-toggle="tab">Round Trip</a>
                                        </li>
                                       
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="flight-search-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                                        <label>From</label>
                                                     <input id="rdsearch-box-uprs" class="form-control" placeholder="From City" type="text"  oninput="clientSelOpt(this,'rdfrom-upr-hide','getFromCity')"  autocomplete="something" value="<?php echo $from ?>" />
										<input type="hidden" id="rdfrom-upr-hide" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                                        <label>To</label>
                                               												
	<input id="rdsearch-to-uprs" class="form-control" oninput="clientSelOpt(this,'rdto-upr-hide','getToCity')" placeholder="To City" type="text"  value="<?php echo $to ?>" autocomplete="something-new">
				<input type="hidden" id="rdto-upr-hide" >	
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-daterange" data-date-format="yyyy-mm-dd">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                            <label>Departing</label>
                                                            <input class="form-control" id="rdeptime" name="start" type="text" />
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-md-3">
                                                        <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                                            <label>Returning</label>
                                                            <input class="form-control" id="rrettime" name="end" type="text" />
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
                                        <div class="tab-pane fade active in" id="flight-search-2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                                        <label>From</label>
                                                     
														 <input id="search-box-uprs" class="form-control" placeholder="From City" type="text"  oninput="clientSelOpt(this,'from-upr-hide','getFromCity')"  autocomplete="something" value="<?php echo $from ?>" />
										<input type="hidden" id="from-upr-hide" >				 
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-highlight"></i>
                                                        <label>To</label>
                                                        
													
	<input id="search-to-uprs" class="form-control" oninput="clientSelOpt(this,'to-upr-hide','getToCity')" placeholder="To City" type="text"  value="<?php echo $to ?>" autocomplete="something-new">
				<input type="hidden" id="to-upr-hide" >			
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group form-group-lg form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                                        <label>Departing</label>
                                                        <input class="date-pick form-control" data-date-format="yyyy-mm-dd" value="<?php echo $start ?>" id="sideptime" type="text" />
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
                                <button class="btn btn-primary btn-lg" id="modalbtnsubmit" >Search for Bus</button>
                         
                        </div>

<h4 style="margin-top: 15px;"><?php echo date('D, M d Y',strtotime($fdate))?></h4>
                        <h4 class="booking-title" style="margin-top: 0px;"> 
                      
                        <?php if($isreturn){ ?><strong>One-Way</strong>
                        <?php } else {?><strong>Round Trip</strong>
                        <?php }?> <?php echo $From ?> -> <?php echo $To ?> </h4>
                        <form class="booking-item-dates-change mb30" style="display: none;">
						<input type="hidden" value="<?php echo $isreturn ?>" id="misreturn">
                            <div class="row" >
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
                                              
 <input id="search-to" class="form-control" oninput="clientSelOpt(this,'toid','getToCity')" placeholder="To City" type="text" name="to" value="<?php echo $To ?>" autocomplete="something-new" />
							
							<input type="hidden" id="toid"  name="toid" value="<?php echo $toid ?>"> 							
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                        <label>Departing</label>
                                        <input class=" form-control resultchange" id="departing" value="<?php echo $start ?>"  data-date-format="yyyy-mm-dd" type="text" />
										
                                    </div>
                                </div>
																
								
								<div class="col-md-2" id="isreturndiv" <?php  echo ($isreturn == 'T') ? '' : 'style="display:none"' ; ?>>
                                    <div class="form-group form-group-icon-left"><i class="fa fa-calendar input-icon input-icon-hightlight"></i>
                                        <label>Returning</label>
                                        <input class=" form-control resultchange" id="returning" value="<?php echo $end ?>"  data-date-format="yyyy-mm-dd" type="text" />
										
                                    </div>
                                </div>
							
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

                                          <li>
                                            <h5 class="booking-filters-title">Price </h5>
                                            <input type="text" id="price-sliderz" value="0;999000" >
                                        </li>


									<?php 
										
											if(count($Amenities)){
											?>
                                        <li>
                                            <h5 class="booking-filters-title">Amenities </h5>
                                            <?php 
                                            foreach($Amenities as  $Amenitie){
                                                if (in_array($Amenitie->AMENITY_ID, $Gbustypes))
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
                                                    <input class="i-check clickresult" type="checkbox" value="<?php echo $Amenitie->AMENITY_ID ?>" name="amenitie[]" <?php echo $checked ?> /><?php echo ucfirst($Amenitie->AMENITY_NAME) ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </li>
											<?php } ?>

                                           
                                          
                                       
										
                                        <?php

                                           
                                            if(count($Operators) > 0 ){
                                            ?>


                                            <li class="scroll-liz">
                                                <h5 class="booking-filters-title">Operators </h5>
                                            <?php 
                                            
                                            foreach($Operators as $OP){
                                               if($OP->OPERATOR_CODE == $operatorId)
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
                                                        <input class="i-check" type="checkbox" value="<?php echo $OP->OPERATOR_CODE ?>"  name="operator[]" <?php echo $ch ?> /><?php echo $OP->OPERATOR_LEGAL_NAME ?>
                                                    </label>
                                                </div>
                                         <?php } ?>
                                            </li>
                                        <?php } ?>
                                      
                                       
                                    </ul>
                                </aside>
                            </div>
                            <div class="col-md-9">
                               <!--  <div class="nav-drop booking-sort">
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
                                </div> -->
                                <ul class="booking-list">


                               <li class="hidden-xs">
                                        <div class="booking-item-container" data-spy="affix" data-offset-top="175" style="text-align: center;">
                                            <div class="booking-item">
                                                <div class="row">

                                                    <div class="col-md-2">
                                                        <div class="booking-item-airline-logo">
                                                        <h5>Bus</h5>
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="col-md-3">
                                                        <div class="booking-item-flight-details">
                                                            <div class="booking-item-departure">
                                                                <h5>Departure</h5>
                                                                
                                                            </div>
                                                            <div class="booking-item-arrival">
                                                                <h5>Arrival</h5>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                   <!--  <div class="col-md-2">
                                                        <h5>Duration</h5>                                                  
                                                    </div> -->
                                                     <div class="col-md-1">
                                                        <h5>Rating</h5>                                                  
                                                    </div>

                                                      <div class="col-md-1">
                                                        <h5>Route</h5>                                                  
                                                    </div>

                                                    <div class="col-md-1">
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




                                    
                                  
                                </ul>
                                <p class="text-right">Not what you're looking for? <a href="{{route('home')}}" >Try your search again</a>
                                </p>
                            </div>
                        </div>
                        <div class="gap"></div>
                    </div>



    <div id="cancel_policy" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cancel Policy</h4>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
            <tr>
                <th>Cancellation time</th>
                <th>Cancellation Charges</th>
            </tr>
            <tr>
                <td>Between 24hours and 0 hours before journey time</td>
                <td>100 %</td>
            </tr>
            <tr>
                <td> Between 72hours and 24 hours before journey time </td>
                <td>50 %</td>
            </tr>
              <tr>
                <td>Between 168hours and 72 hours before journey time</td>
                <td>25 %</td>
            </tr>
              <tr>
                <td>168 hours before journey time</td>
                <td>10 %</td>
            </tr>
            
           


        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

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
                   
  @endsection

  @section('footerSection')

<script src="{{ asset('front/js/jquery.barrating.min.js') }}" type="text/javascript"></script>

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
		
		$(document).on('click','#modalbtnsubmit', function(event){
		var from=$('#search-box-uprs').val();
		var to=$('#search-to-uprs').val();
		//km
		
		var type=$('#flightChooseTab').find('.active').attr('data-type');
			
			if(type == 'round'){
				
				var start=$('#rdsearch-box-uprs').val();
				var to=	$('#rdsearch-to-uprs').val();
				var startid=$('#rdfrom-upr-hide').val();
				var toid=$('#rdto-upr-hide').val();
				var dpdate=$('#rdeptime').val();
				var enddate=$('#rrettime').val();
				var isreturn='T';
				$('#isreturndiv').show();
			}
			else{
				var start=$('#search-box-uprs').val();
				var to=	$('#search-to-uprs').val();
				var startid=$('#from-upr-hide').val();
				var toid=$('#to-upr-hide').val();
				var dpdate=$('#sideptime').val();
				var enddate=$('#returning').val();
				var isreturn='F';
				$('#isreturndiv').hide();
				
			}
			$('#misreturn').val(isreturn);
			$('#search-box').val(start);
			$('#search-to').val(to);
			$('#fromid').val(startid);
			$('#toid').val(toid);
			$('#departing').val(dpdate);
			$('#returning').val(enddate);
			
			$('#search-dialog').magnificPopup('close');
			getBusResult();
		});
	
	$('input.date-pick, .input-daterange input[name="start"]').datepicker('setDate', 'today');
$('.input-daterange input[name="end"]').datepicker('setDate', '+7d');

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
	   
    
    $(document).on('click', '.inputcl', function(event) {
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
	
	
			$(document).on('click', '.view-seat-ng', function(event) {
	var parent=$(this).closest('.booking-item');
  
    if ($(parent).hasClass('active')) {
        $(parent).removeClass('active');
        $(parent).parent().removeClass('active');
    } else {
        $(parent).addClass('active');
        $(parent).parent().addClass('active');
        $(parent).delay(1500).queue(function() {
            $(parent).addClass('viewed')
        });
    }
});
	
	// $(document).on('click', ".confirm-seat", function(e) {
	
	// $('#insert_seat').modal('hide');
	// });
		
	// $(document).on('click', ".close-seat", function(e) {
		
	// var uid=$(this).attr('data-id');
	
	// var oldval=$('#'+uid).val('X');
	// var oldvalsid=$('#'+uid+'-main').val('X');
	// var oldvalsid=$('#'+uid+'-text').text('');
	// $('#insert_seat').modal('hide');
	// });

    $(window).load(function() {
        $(".seatmodal").click()
    })
    
    $(document).on('click', ".seatmodal", function(e) {

            e.preventDefault;
            
        
        $('#insert_seat').empty();
        var bustype=$(this).attr('data-type');
        var uid=$(this).attr('data-uid');
    
        var route_id=$(this).attr('data-route');
        var trip_id=$(this).attr('data-trip');
        var pickup_id=$(this).attr('data-pic');
        var return_id=$(this).attr('data-ret');
        var bus_id=$(this).attr('data-bus');
        var startDate=$(this).attr('data-start');
        var endDate=$(this).attr('data-end');
        var seat=$(this).attr('data-seat');
        
        
     var oldval=$('#'+uid).val('X');
    var oldvalsid=$('#'+uid+'-main').val('X');
    
    
       $('#insert_seat').load("{{route('seatmap')}}",{ _token: "{{csrf_token()}}",bustype:bustype,uid:uid,route_id:route_id,pickup_id:pickup_id,return_id:return_id,bus_id:bus_id,seat:seat,startDate:startDate,trip_id:trip_id,endDate:endDate},function(){
     //   $('#insert_seat').modal({ backdrop: 'static', keyboard: false });
       
     
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
        min: 5,
        max: 25000,
        from: 5,
        to: 25000,
		skin: "flat",
        prefix: " ₦",
        prettify: false,
        hasGrid: true,
        onFinish: function(data){
            
           getBusResult();
        }
    });
		
        
      $(document).on('click','.seattable span', function(e){
        var currentType = $(this).attr("class");
        if(currentType=="seat"){
           
            
      var uid=$('#insert_seat').find('#seat-uuid').val();
    var oldval=$('#'+uid).val();
    var oldvalsid=$('#'+uid+'-main').val();
    var array = oldval.split(',');
    var totalPass=$('#mpassid').val();  
    if(array.length <= totalPass ){
        var seatno=$(this).attr('data-name');
        var seatid=$(this).attr('data-id');
         $(this).removeClass("seat");
         $(this).addClass("selectseat");
        
        $('#'+uid).val(oldval+','+seatno);
        $('#'+uid+'-main').val(oldvalsid+','+seatid);
        var str=oldval+','+seatno;
         var res =str.replace("X,", "");
        $('#'+uid+'-text').text('- Seat #'+res + ' selected');
        
        
        }
        
        
           
            
        }
        
    });

	$(document).on('click','.route-details', function(e){
		e.preventDefault();
		e.stopPropagation();
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
		var isreturn=$('#misreturn').val();
        var fromtxt=$('#search-box').val(); 
        var totxt=$('#search-to').val(); 
        var returning=$('#returning').val(); 
        var passengerid=$('#passengerid :selected').val(); 
     
	  var busTypes = [];
$("input[name='bustypes[]']:checked").each(function(){busTypes.push($(this).val());});
	 var classtype = [];
    $("input[name='classtype[]']:checked").each(function(){classtype.push($(this).val());});

     var operator = [];
	$("input[name='operator[]']:checked").each(function(){operator.push($(this).val());});
		 var dptime = [];
	$("input[name='dptime[]']:checked").each(function(){dptime.push($(this).val());});
	    var amenitie = [];
    $("input[name='amenitie[]']:checked").each(function(){amenitie.push($(this).val());});
    
	var price=$("#price-sliderz").val();
	
    if(from != '' || to !='' || startdate !=''){
   
    $.ajax({
        url: "{{route('searchRes')}}",
        type: "POST",
        data : { _token: "{{csrf_token()}}",fromtxt:fromtxt,totxt:totxt,pickup_id:from,return_id:to,passengerid:passengerid,isreturn:isreturn,dpdate:startdate,busTypes:busTypes,operator:operator,classtype:classtype,dptime:dptime,amenitie:amenitie,price:price,returning:returning},
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
        var toid=$('#toid').val(); 
        var trip=tz.attr('data-trip');
           $.ajax({
              type: "POST",
			  data:{ _token: "{{csrf_token()}}",busid:busid,routeid:routeid,fromtxt:fromtxt,totxt:totxt,toid:toid,trip:trip},
              url: "{{route('routeDetail')}}",
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

		console.log(document.getElementById('search-box').value);
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
           
        }
    });

}    
		</script>
		
		 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxtH7uIB-sE5pzeSCTIWCIBRK3JiKLYS8">
    </script> 

@endsection

            
       


