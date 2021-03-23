<ul class="nav nav-tabs">
	  <li <?php echo ($ActiveSub == 'amenitie') ? 'class="active"' : '' ?>> <a href="{{route('amenitie.index')}}">Amenity Gallery</a></li>
	  
<li <?php echo ($ActiveSub == 'fleetparent') ? 'class="active"' : '' ?> ><a href="{{route('parentType')}}" >Fleet Parent Type</a></li>
  <li <?php echo ($ActiveSub == 'fleettype') ? 'class="active"' : '' ?>> <a href="{{route('fleetType')}}">Fleet Type</a></li>

  <li <?php echo ($ActiveSub == 'fleet') ? 'class="active"' : '' ?>> <a href="{{route('fleet.index')}}">Fleets</a></li>




</ul>

<br>