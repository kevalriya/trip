 <?php 

$Cityarr=array();
?> 
<div class="row">
                  
   <div class="col-md-4">

                                                       
        <p>Route Details: <?php echo $fromtxt ?> To <?php echo $totxt ?> </p>
														
	<?php 
		
		foreach($Routepoints as $Route){
		$Cityarr[]=$Route->CITY_NAME;
		 $Avtime= (!empty($Times[$Route['CITY_CODE']]['ARRIVAL_TIME'])) ? date('H:i',strtotime($Times[$Route['CITY_CODE']]['ARRIVAL_TIME'])) : '';
       $DPtime=  (!empty($Times[$Route['CITY_CODE']]['DEPARTURE_TIME'])) ? date('H:i',strtotime($Times[$Route['CITY_CODE']]['DEPARTURE_TIME'])) : '';
      
		?>
                                                        <h5 class="list-title"><?php echo $Route->CITY_NAME ?></h5>
                                                        <ul class="list">
                                                           
                                                        
														<li>Depart <?php echo $DPtime ?> </li>
														
														
														
                                                            <li>Arrive  <?php echo $Avtime ?></li>
														
                                                        </ul>
                                                     <br>
														
													<?php 
													
													} ?>
                                                      
                        </div>

                        <div class="col-md-8">
						
						<div style="display:none">
					 <select multiple id="waypoints">
						<?php 
						$c=count($Cityarr)-1;
						for($i=1;$i<$c;$i++){
							echo '<option value="'.$Cityarr[$i].'" selected>'.$Cityarr[$i].'</option>';
						}
						?>
						  </select>
						</div>
						
						  <div id="map" style="height: 425px;"></div>
						     &nbsp;
    <div id="warnings-panel"></div>
                        </div>
                        <div class="clreafix"> </div>
						</div>

