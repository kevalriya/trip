 <header id="main-header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <a class="logoimg" href="{{route('home')}}">
                                <img src="{{url('front/img/tripon_white_logo.png')}}" alt="TripOn" />
                            </a>
                        </div>
                       
            <?php 
              
             if(isset(Auth::guard('web')->user()->USER_ID)){
               
            ?>





                        <div class="col-md-5">
                            <div class="nav top-user-area clearfix">
                                <ul id="slimmenu" class="slimmenu top-user-area-list list list-horizontal list-border">
                                    <li class="top-user-area-avatar">
                                        <a href="{{route('profileSetting')}}">
                                            <img class="origin round" src="{{url('front/img/amaze_40x40.jpg')}}" alt="Image Alternative text" title="AMaze" />Hi, {{Auth::guard('web')->user()->FIRSTNAME}}</a>
                                    </li>
                                    <li> <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                           Log Out
                                        </a>
                                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>   
                                    </li>
                                    <li><a href="{{url('contact-us')}}">Contact Us</a>
                                    </li>
                                 <li><a href="{{route('user.faq')}}">FAQ</a>
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
                                            <img class="origin round" src="{{url('front/img/amaze_40x40.jpg')}}" alt="Image Alternative text" title="AMaze" />Hi, Guest</a>
                                    </li> -->
                                    <li><a href="{{ route('login') }}">Login</a>
                                    </li> 
                                    <li><a href="{{url('about')}}">About Us</a>
                                    </li>
                                    <li><a href="{{url('contact-us')}}">Contact Us</a>
                                    </li>

                                    <li><a href="{{route('user.faq')}}">FAQ</a>
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
