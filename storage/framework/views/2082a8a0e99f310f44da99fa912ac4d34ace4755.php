<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo e(route('admin.home')); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>TR</b>IP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Trip</b> On</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo e(url('/images/icons/user.png')); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo e(Auth::user()->FIRSTNAME); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo e(url('/images/icons/user.png')); ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo e(Auth::user()->FIRSTNAME); ?>

                
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="btn btn-default pull-right">
                      <a href="<?php echo e(route('admin.logout')); ?>"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                          Logout
                      </a>

                      <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: none;">
                          <?php echo e(csrf_field()); ?>

                      </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header><?php /**PATH /Applications/MAMP/htdocs/trip/resources/views/operator/layouts/header.blade.php ENDPATH**/ ?>