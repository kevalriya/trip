 <header id="main-header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <a class="logoimg" href="<?php echo e(route('home')); ?>">
                                <img src="<?php echo e(url('images/front/tripon_white_logo.png')); ?>" alt="TripOn" />
                            </a>
                        </div>
                       
            <?php 
              
             if(isset(Auth::guard('web')->user()->USER_ID)){
               
            ?>





                        <div class="col-md-5">
                            <div class="nav top-user-area clearfix">
                                <ul id="slimmenu" class="slimmenu top-user-area-list list list-horizontal list-border">
                                    <li class="top-user-area-avatar">
                                        <a href="<?php echo e(route('profileSetting')); ?>">

                                        <?php 
                          if(isset(Auth::user()->IMAGE) && !empty(Auth::user()->IMAGE)){
                            $img=url('/images/users/'.Auth::user()->IMAGE);
                          }
                          else{
                            
                             $img=url('images/front/amaze_300x300.jpg');
                          }
                          ?>
                                            <img class="origin round" src="<?php echo e($img); ?>" alt="Image Alternative text" title="AMaze" />Hi, <?php echo e(Auth::guard('web')->user()->FIRSTNAME); ?></a>
                                    </li>
                                    <li> <a href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                           Log Out
                                        </a>
                                           <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>   
                                    </li>
                                    <li><a href="<?php echo e(url('contact-us')); ?>">Contact Us</a>
                                    </li>
                                 <li><a href="<?php echo e(route('user.faq')); ?>">FAQ</a>
                                    </li>

                                     
                                   
                                </ul>
                            </div>
                        </div>
             <?php }
              else{
                ?>
                   <div class="col-md-5">
                            <div class="nav top-user-area clearfix">
                                <ul id="slimmenu" class="slimmenu top-user-area-list list list-horizontal list-border">
                                   <!--  <li class="top-user-area-avatar">
                                        <a href="#">
                                            <img class="origin round" src="<?php echo e(url('images/front/amaze_40x40.jpg')); ?>" alt="Image Alternative text" title="AMaze" />Hi, Guest</a>
                                    </li> -->
                                    <li><a href="<?php echo e(route('login')); ?>">Login</a>
                                    </li> 
                                    <li><a href="<?php echo e(url('about')); ?>">About Us</a>
                                    </li>
                                    <li><a href="<?php echo e(url('contact-us')); ?>">Contact Us</a>
                                    </li>

                                    <li><a href="<?php echo e(route('user.faq')); ?>">FAQ</a>
                                    </li>
                  <!-- <li class="top-user-area-avatar">
                                        <a href="#">
                                            <img class="origin" style="height: 25px; border: 0px;" src="https://d19yo8val8huli.cloudfront.net/hotels/v7/img/flags/naira.svg" alt="Image Alternative text" title="AMaze" />
                                            <span style="font-size: large;vertical-align: middle;">₦</span></a>
                                    </li>  -->
                                   
                                </ul>
                            </div>
                        </div>
              <?php } ?>
                    </div>
                </div>
            </div>
        </header>
<?php /**PATH /Applications/MAMP/htdocs/trip/resources/views/front/layouts/header.blade.php ENDPATH**/ ?>