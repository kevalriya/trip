<ul class="nav nav-tabs">

  <li <?php echo ($ActiveSub == 'fleettype') ? 'class="active"' : '' ?>> <a href="{{route('opfleetType')}}">Fleet Type</a></li>

  <li <?php echo ($ActiveSub == 'fleet') ? 'class="active"' : '' ?>> <a href="{{route('operator.fleet.index')}}">Fleets</a></li>




</ul>

<br>