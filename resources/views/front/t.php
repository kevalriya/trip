<?php 
$ts1 = strtotime('08:00:00');
$ts2 = strtotime('07:00:00');
 $diff = abs($ts1 - $ts2);
 echo Jsonfoo($diff);

  function Jsonfoo($seconds) {
  $t = round($seconds);
  return sprintf('%02dh %02dm', ($t/3600),($t/60%60));
}
?>