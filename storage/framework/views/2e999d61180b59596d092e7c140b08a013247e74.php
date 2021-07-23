 <aside class="user-profile-sidebar">
                        <div class="user-profile-avatar text-center">
                          <?php 
                          if(isset(Auth::user()->IMAGE) && !empty(Auth::user()->IMAGE)){
                            $img=url('/public/images/users/'.Auth::user()->IMAGE);
                          }
                          else{
                            
                             $img=url('front/img/amaze_300x300.jpg');
                          }
                          ?>
                        
                            <img src="<?php echo e($img); ?>" />
                           <h4 class="thumb-title" style="color: #d9d9d9">Hi <?php echo e(Auth::user()->FIRSTNAME); ?> <?php echo e(Auth::user()->MIDDLENAME); ?> <?php echo e(Auth::user()->SURNAME); ?> </h4>
                        </div>


                        <ul class="list user-profile-nav">
                           <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Home</a>
                            </li>
                            
                             <li><a href="<?php echo e(route('bookinghistory')); ?>"><i class="fa fa-clock-o"></i>Booking History</a></li>

                              <li><a href=""><i class="fa fa-clock-o"></i>Cancel Booking</a>
                            </li>

                          <li><a href="<?php echo e(route('profileSetting')); ?>"><i class="fa fa-cog"></i>Profile Settings</a>
                            </li> 
                           
                           <li><a href="change-password"><i class="fa fa-lock"></i>Change Password</a>
                            </li>
                          
                           
                            
                        </ul>
                    </aside><?php /**PATH /Applications/MAMP/htdocs/trip/resources/views/front/layouts/useraside.blade.php ENDPATH**/ ?>