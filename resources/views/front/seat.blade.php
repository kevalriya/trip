		<input type="hidden" id="seat-uuid" value="<?php echo $uid ?>">

	<?php

			

				if($Seat->rows > 0 && $Seat->columns > 0){
					?>

					<div class="seatcolrow">

		<div class="row mt-2">
		
		
			<div class="col-md-12">
				<table class="table seattable borderless no-spacing seats_table">
	<?php
					$Latter=range('A', 'Z');
					array_unshift($Latter, "#");


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
									
									echo "<td><span class='steering'  data-id='$seatId' data-name='$inputval' id='$Latter[$i]$j'></span></td>";
								}
								else{
									echo "<td><span class='$cls' data-id='$seatId' data-name='$inputval' id='$inputval'></td>";
								}
								
							}
						echo "</tr>";	
					}
					?>
				</table>
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