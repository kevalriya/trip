<ul class="nav nav-tabs">
<li <?php echo ($ActiveSub == 'assign') ? 'class="active"' : '' ?> ><a href="{{route('assigntrip.edit',$id)}}?t={{$gett}}" >Assign Trip</a></li>
  <li <?php echo ($ActiveSub == 'start') ? 'class="active"' : '' ?>> <a href="{{route('startTrip',$id)}}?t={{$gett}}">Start Trip</a></li>

  <li <?php echo ($ActiveSub == 'end') ? 'class="active"' : '' ?>> <a href="{{route('endTrip',$id)}}?t={{$gett}}">End Trip</a></li>



</ul>

<br>