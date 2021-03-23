<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DBUSER= new DB_Functions();

$Ticketdata=$_POST['Ticketdata'];
$from_location_id=$_POST['pickup_id'];
$to_location_id=$_POST['return_id'];
$bus_id=$_POST['bus_id'];

/* if($isback == 'Y'){
		$Old_TotalPrice=$Old_Price*$Old_passenger;
		$Old_TotalTax=10*$Old_passenger;
		$Old_totalTrip=$Old_TotalPrice+$Old_TotalTax;
						
		$TotalPrice=$Price*$passenger;
		$TotalTax=10*$passenger;
		$totalTrip=$TotalPrice+$TotalTax;
						
		$BothTotal=$Old_totalTrip+$totalTrip;
	}
	else{
		$TotalPrice=$Price*$passenger;
		$TotalTax=10*$passenger;
		$BothTotal=$TotalPrice+$TotalTax;
	} */

	$Person=0;
	$CPrice=0;
	foreach($Ticketdata as $Ticket){
		if(isset($Ticket['type'])){
			$Person=$Ticket['selctick'];
			$Price=$DBUSER->ticketPrice($from_location_id,$to_location_id,$bus_id,$Ticket['type']);
			$CPrice+=$Price;
		}
		
	}
	echo $CPrice;
}