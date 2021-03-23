<?php 
  $ActiveSide=(isset($ActiveSide)) ? $ActiveSide : '';
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
       
       <li  <?php echo ($ActiveSide == 'dashboard') ? 'class="active"' : '' ?>><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

       <li <?php echo ($ActiveSide == 'operator') ? 'class="active"' : '' ?>><a href="{{route('operator.index')}}"><i class="fa fa-users"></i> <span>Manage Users</span></a></li> 

        <li <?php echo ($ActiveSide == 'route') ? 'class="active"' : '' ?>><a href="{{route('route.index')}}"><i class="fa fa-road"></i> <span>Manage Routes</span></a></li>

        <li <?php echo ($ActiveSide == 'fleet') ? 'class="active"' : '' ?>><a href="{{route('amenitie.index')}}"><i class="fa fa-bus"></i> <span>Manage Fleet</span></a></li>

        <li <?php echo ($ActiveSide == 'trip') ? 'class="active"' : '' ?>><a href="{{route('trip.index')}}"><i class="fa fa-tripadvisor"></i> <span>Manage Trip</span></a></li>

        <li <?php echo ($ActiveSide == 'booking') ? 'class="active"' : '' ?>><a href="{{route('booking.index')}}"><i class="fa fa-list"></i> <span>Manage Booking</span></a></li>

        <li <?php echo ($ActiveSide == 'faq') ? 'class="active"' : '' ?>><a href="{{route('admin.faq')}}"><i class="fa fa-question-circle"></i> <span>Manage FAQ</span></a></li>

      

 

     

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>