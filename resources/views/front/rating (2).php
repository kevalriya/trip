 <?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   require_once 'config/config.php';
   
   require_once CLASSPATH.'DB_Functions.php';
$DB= new DB_Functions();
$busId=trim(strip_tags($_POST['busid']));
$routeid=trim(strip_tags($_POST['routeid']));
$toId=trim(strip_tags($_POST['toid']));
$fromtxt=trim(strip_tags($_POST['fromtxt']));
$totxt=trim(strip_tags($_POST['totxt']));
$getRouteDetail=$DB->getRouteDetail($busId,$routeid);
$Cityarr=array();
?> 
<div class="row">
                  
   <div class="col-md-4">

                                                       
        <p>Route Details: <?php echo $fromtxt ?> To <?php echo $totxt ?> </p>
														
														<?php 
													foreach($getRouteDetail as $Route){
														$Cityarr[]=$Route['name'];
														?>
                                                        <h5 class="list-title"><?php echo $Route['name'] ?></h5>
                                                        <ul class="list">
                                                           
                                                        <?php 
														if(!empty($Route['departure_time'])){
														?>
														<li>Depart <?php echo $Route['departure_time'] ?> </li>
														<?php } ?>
														 <?php 
														if(!empty($Route['arrival_time'])){
														?>
                                                            <li>Arrive  <?php echo $Route['arrival_time'] ?></li>
														<?php } ?>
                                                        </ul>
                                                     <br>
														
													<?php 
													if($Route['city_id'] == $toId){
														break;
													}
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
<?php }
	else{
		echo "<h3>Direct Not Allowed </h3>";
	}
 ?>
