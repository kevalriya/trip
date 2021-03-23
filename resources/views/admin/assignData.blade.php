<?php
	if(isset($Trip->TRIP_ID)){
	
		if(empty($Trip->fromDate)){
			die("<h3>Missing End Date This trip</h3>");
		}
		if(empty($Trip->toDate)){
		die("<h3>Missing End Date This trip</h3>");
		}

	$fromDate=$Trip->fromDate;
	$toDate=$Trip->toDate;
	$period = new DatePeriod(
     new DateTime($fromDate),
     new DateInterval('P1D'),
     new DateTime($toDate)
	);
	echo "<table class='table'>";
	?>
	<tr>
		<td>Driver</td>
		<td>Operator</td>
		<td>Route</td>
		<td>Date</td>
		<td>Action</td>
	</tr>

	<?php

	 if(isset($Trip->recurring)){
                    $DBRecurring=explode(",",$Trip->recurring);
                  }
                  else{
                    $DBRecurring=array();
                  }
	foreach ($period as  $value) {
		 $times= $value->getTimestamp();
		 $day=date('l', $times);
		 $day=strtolower($day);
		$tripDate=$value->format('Y-m-d');

		if(in_array($day,$DBRecurring)){
		echo "<tr>";
		echo "<td>Demo Name</td>";
		echo "<td>".$Trip->OPERATOR_LEGAL_NAME."</td>";
		echo "<td>".$Trip->ROUTE_NAME."</td>";
		echo "<td>".$tripDate."</td>";
		echo '<td><a href="'.route("assigntrip.edit",$Trip->TRIP_ID).'?t='.$times.'"> <span class="glyphicon glyphicon-edit"></span></a></td>';
		echo "</tr>";
	}

	}

	echo '</table>';
	}
	else{
		echo die("<h3>No Trip Found </h3>");
	}
?>