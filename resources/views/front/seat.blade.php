		<input type="hidden" id="seat-uuid" value="<?php echo $uid ?>">

	<?php

			

				if($Seat->rows > 0 && $Seat->columns > 0){
					?>

					<div class="seatcolrow" style="
    padding-bottom: 30px;
">

					<div style="bottom: 0;
    position: absolute; margin: 20px; display: flex; font-size: 15px;
    align-items: center;
    right: 0;" class="row">
		
        <div class="seat" style="height: 30px; width: 30px; margin-left: 20px"></div> Available
        <div class="selectseat" style="height: 30px; width: 30px; margin-left: 20px"></div> Selected
        <div class="bookseat" style="height: 30px; width: 30px; margin-left: 20px"></div> Booked
        

		</div>

		<div class="row mt-2">
		
		
			<div class="col-md-12">
			<div class="exit exit--front fuselage" style="width: min-content; margin: 40px; box-shadow: 0px 0px 20px 5px grey; padding:15px;border-radius:20px;">
				<table class="table seattable borderless no-spacing seats_table">
	<?php
					$Latter=range('A', 'Z');
					array_unshift($Latter, "#");

					// array_unshift($BookArr, 203);
					// array_unshift($BookArr, 204);

					$Rows=$Seat->rows;
					$Columns=$Seat->columns;

					for ($i=0; $i <= $Rows ; $i++) { 
						echo "<tr>";
						
						//echo "<td>".$Latter[$i]."</td>";
							for ($j=1; $j <= $Columns ; $j++) { 
								$inputval=$Latter[$i].$j;

								if(isset($SeatArr[$inputval]['type']) ){
									$SeatVal=$SeatArr[$inputval]['type'];
								}
								else{
									$SeatVal=0;
								}

								if(isset($SeatArr[$inputval]['id']) ){
									$seatId=$SeatArr[$inputval]['id'];
								}
								else{
									$seatId=0;
								}
								
								if(in_array($seatId, $BookArr)){
									$cls='bookseat';
								}
								else{
								if($SeatVal==1){
									$cls='seat';
								}
								else if($SeatVal==2){
									$cls='door';
								}

								else{
									$cls='pos';
								}
							}
								if($i==0){
									//echo "<td>".$j."</td>";
								}
								else if($i==1 && $j==1 ){
									
									echo "<td style='padding:5px 1px; width: 20px'><span class='steering'  data-id='$seatId' data-name='$inputval' id='$Latter[$i]$j'></span></td>";
								}
								else{
									echo "<td style='padding:5px 1px; width:20px'><span class='$cls' data-id='$seatId' data-name='$inputval' id='$inputval'>";
									if($SeatVal==1) echo "$inputval";
									echo "</td>";
								}
								
							}
						echo "</tr>";	
					}
					?>
				</table>
				</div>
			</div>
			

		</div>
	</div>
					<?php
				}
			 ?>

<div class="clearfix"> </div>

<!-- <button  class="btn btn-primary confirm-seat" data-id="<?php echo $uid ?>">Confirm</button>
<button  class="btn btn-danger pull-right close-seat"  data-id="<?php echo $uid ?>">Close</button> -->
<div class="clearfix"> </div>