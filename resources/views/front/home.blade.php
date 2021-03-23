<?php 
$ActiveSide='home';
$url=config('constants.city_url');
$Slideurl=config('constants.operator_slide_url');
?>  
@extends('front.layouts.app')

@section('title','TripOn - Home')

@section('main-content')
@section('headSection')
<style type="text/css">
    .bg-color {
    background: rgb(237, 131, 35,1);
}
.ri-grid{
    min-height: 200px !important;
}
.input-group-btn:last-child > .btn, .input-group-btn:last-child > .btn-group{
    margin-left: 2px;
}
.input-group-btn:first-child > .btn, .input-group-btn:first-child > .btn-group{
     margin-right: 2px;
}
.input-group .form-control:last-child, .input-group-addon:last-child, .input-group-btn:last-child > .btn, .input-group-btn:last-child > .btn-group > .btn, .input-group-btn:last-child > .dropdown-toggle, .input-group-btn:first-child > .btn:not(:first-child), .input-group-btn:first-child > .btn-group:not(:first-child) > .btn{
    border-radius: 20px; 
}
.input-group .form-control:first-child, .input-group-addon:first-child, .input-group-btn:first-child > .btn, .input-group-btn:first-child > .btn-group > .btn, .input-group-btn:first-child > .dropdown-toggle, .input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle), .input-group-btn:last-child > .btn-group:not(:last-child) > .btn{
    border-radius: 20px; 
}
.btn-default.disabled, .btn-default[disabled], fieldset[disabled] .btn-default, .btn-default.disabled:hover, .btn-default[disabled]:hover, fieldset[disabled] .btn-default:hover, .btn-default.disabled:focus, .btn-default[disabled]:focus, fieldset[disabled] .btn-default:focus, .btn-default.disabled:active, .btn-default[disabled]:active, fieldset[disabled] .btn-default:active, .btn-default.disabled.active, .btn-default[disabled].active, fieldset[disabled] .btn-default.active{
    border-color: #cccccc;
}


.embed-responsive {
  position: relative;
  display: block;
  height: 0;
  padding: 0;
  overflow: hidden;
}
.embed-responsive .embed-responsive-item,
.embed-responsive iframe,
.embed-responsive embed,
.embed-responsive object,
.embed-responsive video {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  height: 100%;
  width: 100%;
  border: 0;
}
.embed-responsive-16by9 {
  padding-bottom: 56.25%;
}
.embed-responsive-4by3 {
  padding-bottom: 75%;
}
.embed-responsive.embed-responsive-4by3 > div:hover {transform: scale(1.07);}
.embed-responsive.embed-responsive-4by3 > div{transition: 0.3s;}
</style>

@endsection
        <div class="bg-holder">
            <div class="bg-mask-darken"></div>
            <div class="bg-parallax"></div>
            <!-- START GRIDROTATOR -->
            <div class="ri-grid" id="ri-grid">
                <ul>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/01.jpg')}}" alt="Image Alternative text" title="In the bokeh forest" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/02.jpg')}}" alt="Image Alternative text" title="Our Coffee miss u" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/03.jpg')}}" alt="Image Alternative text" title="hotel PORTO BAY RIO INTERNACIONAL rooftop pool" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/04.jpg')}}" alt="Image Alternative text" title="Playstation controller" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/05.jpg')}}" alt="Image Alternative text" title="Gaviota en el Top" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/06.jpg')}}" alt="Image Alternative text" title="196_365" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/07.jpg')}}" alt="Image Alternative text" title="end of the day" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/08.jpg')}}" alt="Image Alternative text" title="lack of blue depresses me" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/09.jpg')}}" alt="Image Alternative text" title="Working in the Nature" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/10.jpg')}}" alt="Image Alternative text" title="Bekohlicious Flower" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/11.jpg')}}" alt="Image Alternative text" title="people on the beach" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/12.jpg')}}" alt="Image Alternative text" title="Sydney Harbour" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/13.jpg')}}" alt="Image Alternative text" title="sweet escape" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/14.jpg')}}" alt="Image Alternative text" title="Street" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/15.jpg')}}" alt="Image Alternative text" title="Play Ball" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/16.jpg')}}" alt="Image Alternative text" title="El inevitable paso del tiempo" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/17.jpg')}}" alt="Image Alternative text" title="Bekohlicious" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/18.jpg')}}" alt="Image Alternative text" title="Spidy" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/19.jpg')}}" alt="Image Alternative text" title="Sevenly Shirts - June 2012  2" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/20.jpg')}}" alt="Image Alternative text" title="Viva Las Vegas" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/21.jpg')}}" alt="Image Alternative text" title="the best mode of transport here in maldives" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/22.jpg')}}" alt="Image Alternative text" title="The Big Showoff-Take 2" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/23.jpg')}}" alt="Image Alternative text" title="a turn" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/24.jpg')}}" alt="Image Alternative text" title="Rail Road" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/25.jpg')}}" alt="Image Alternative text" title="new york at an angle" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/26.jpg')}}" alt="Image Alternative text" title="waipio valley" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/27.jpg')}}" alt="Image Alternative text" title="pink flowers" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/28.jpg')}}" alt="Image Alternative text" title="cascada" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/29.jpg')}}" alt="Image Alternative text" title="a dreamy jump" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/30.jpg')}}" alt="Image Alternative text" title="Foots and grass" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/31.jpg')}}" alt="Image Alternative text" title="4 Strokes of Fun" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/32.jpg')}}" alt="Image Alternative text" title="Afro" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/33.jpg')}}" alt="Image Alternative text" title="sunny wood" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/34.jpg')}}" alt="Image Alternative text" title="b and w camera" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/35.jpg')}}" alt="Image Alternative text" title="drifting days" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/36.jpg')}}" alt="Image Alternative text" title="AMaze" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/37.jpg')}}" alt="Image Alternative text" title="Pictures at the museum" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/38.jpg')}}" alt="Image Alternative text" title="The Hidden Power of the Heart" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/39.jpg')}}" alt="Image Alternative text" title="Street Yoga" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/40.jpg')}}" alt="Image Alternative text" title="Sorry to Bust Your Bubble" />
                        </a>
                    </li>
                   <!--  <li>
                        <a href="#">
                            <img src="{{url('front/img/41.jpg')}}" alt="Image Alternative text" title="Thyme" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/42.jpg')}}" alt="Image Alternative text" title="Flare lens flare" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/43.jpg')}}" alt="Image Alternative text" title="Cup on red" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/44.jpg')}}" alt="Image Alternative text" title="Old No7" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/45.jpg')}}" alt="Image Alternative text" title="New Year Greetings" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/46.jpg')}}" alt="Image Alternative text" title="Gamer Chick" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/47.jpg')}}" alt="Image Alternative text" title="Bridge" />
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{url('front/img/48.jpg')}}" alt="Image Alternative text" title="Bubbles" />
                        </a>
                    </li> -->
                </ul>
            </div>
            <!-- END GRIDROTATOR -->
            <div class="bg-front full-center">
                <div class="container">
                    <div class="search-tabs search-tabs-bg" >
                        <h3><span style="background-color: #ed8323; color: white;">Transforming Bus Travel in Nigeria.</span></h3>
                        <div class="tabbable">
                          
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab-2">
                                   <!--  <h2>Search for Buses</h2> -->
                                    <form action="{{route('searchResult')}}" id="search_trip_from" onsubmit="return checkform()">
                                    
                                        <div class="tabbable">
                                           <ul class="nav nav-pills nav-sm nav-no-br mb10" id="flightChooseTab">
                                             <li class="hreturn active" data-type="single"><a  data-toggle="tab">One Way</a>
                                                </li>
                                           <li class="hreturn" data-type="round"><a href="#" data-toggle="tab">Round Trip</a>
                                                </li>
                                               
                                               
                                            </ul> 
            
        <div class="tab-content">
            <div class="tab-pane fade in active" id="flight-search-1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="form-group form-group-lg form-group-icon-left"><i class="fas fa-map-marker-alt input-icon"></i>
                                    <label>From</label>
         <input id="search-box" class="form-control clearbk required" placeholder="From City" type="text" name="from" oninput="clientSelOpt(this,'fromid','getFromCity')"  autocomplete="something" />
                                <input type="hidden" class="clearbk" id="fromid"  name="fromid"> 
                               </div>
                            </div>

                            <div class="col-md-6  col-xs-6">
                                <div class="form-group form-group-lg form-group-icon-left"><i class="fas fa-map-marker-alt input-icon"></i>
                                    <label>To</label>
<input id="search-to" class="form-control clearbk required" oninput="clientSelOpt(this,'toid','getToCity')" placeholder="To City" type="text" name="to"  autocomplete="something-new" />

<input type="hidden" id="toid" class="clearbk" name="toid"> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-daterange" data-date-format="yyyy-mm-dd">
                            <div class="row">
                                <div class="col-md-4 col-sm-6  col-xs-6">
                              <div class="form-group form-group-lg form-group-icon-left"><i class="far fa-calendar-alt input-icon input-icon-highlight"></i>
                                        <label>Departing</label>
                         <input class="date-pick form-control required" name="start" type="text" />
                             </div>
                                </div>
                         
                               <div class="col-md-4 col-sm-6  col-xs-6 returndiv" style="display:none">
                                    <div class="form-group form-group-lg form-group-icon-left"><i class="far fa-calendar-alt input-icon input-icon-highlight"></i>
                                        <label>Returning</label>
                                        <input class="form-control required" name="end" type="text" value="" />
                                    </div>
                                </div>
                                


					<div class="col-md-4 col-sm-3  col-xs-6">
					<div class="form-group form-group-xs form-group-select-plus">

					<label>Passenger</label>

					<div class="input-group" style="margin-top: 10px;">
					          <span class="input-group-btn">
					              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="passengers">
					                 -
					              </button>
					          </span>
					          <input type="text" name="passengers" class="form-control text-center input-number" value="1" min="1" max="10">
					          <span class="input-group-btn">
					              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="passengers">
					                  +
					              </button>
					          </span>
					      </div>
					  </div>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                       
                                               <div class="tab-content" style="margin-bottom: 2rem;">
                                                <span style="vertical-align: sub;"><a href="javascript:void(0)" id="flip"><i id="expandCheck" class="fa fa-plus box-icon-border " style="float: left;margin-right: 1rem;"></i>Amenities</a></span>
                                                <br>
                                            </div>

<div class="tab-content" style="margin-bottom: 2rem; min-height: 10rem;display:none; font-size: smaller;" id="panel">
    
     <div class="col-md-2">
                                <?php 
                                $i=1;

                                        
                                            if(count($Amenities)){
                                         
                                            foreach($Amenities as $Amenitie){
                                                if($i % 4 == 0){
                                                    
                                                echo '</div><div class="col-md-2">' ;
                                                }
                                                    
                                            ?>
                            <div class="checkbox checkbox-stroke">
                                <label>
                                    <input class="i-check" value="<?php echo $Amenitie->AMENITY_ID ?>"  name="bustypes[]" type="checkbox" /><?php echo ucfirst($Amenitie->AMENITY_NAME) ?></label>
                            </div>
                           
                                            <?php 
                                                $i++;
                                            } 
                                         }
                                        ?>
                        </div>
                        
                       
</div>
                                           
<input type="hidden" name="isreturn" id="is_return" value="F">
                                        </div>
                                        <button class="btn btn-primary btn-lg" type="submit">Search</button>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="container">
        </div>
        <div class="bg-color text-white">
            <div class="container">
                <div class="gap"></div>
                <div class="row row-wrap" data-gutter="120">
                    <div class="col-md-4">
                        <div class="thumb">

                            <header class="thumb-header"><a href="{{url('about')}}"><i style="float: left;margin-right: 1rem;" class="far fa-clock box-icon-border no-line round box-icon-white "></i></a><h4 class="thumb-title">Real-time Inventory</h4>
                            </header>
                            <div class="thumb-caption">                                
                                <p class="thumb-desc">Seat availability are automatically updated when your booking is processed.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumb">
                            <header class="thumb-header"><a href="{{url('about')}}"><i style="float: left;margin-right: 1rem;" class="fas fa-bus box-icon-border no-line round box-icon-white "></i></a><h4 class="thumb-title">Bus Selection</h4>
                            </header>
                            <div class="thumb-caption">
                                
                                <p class="thumb-desc">Choose a bus with your desired amenities – AC, Wifi, Power Outlets, TV/DVD, Extra Leg Room, etc.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumb">
                            <header class="thumb-header"><a href="{{url('about')}}"><i style="float: left;margin-right: 1rem;" class="fas fa-couch box-icon-border no-line round box-icon-white "></i></a> <h4 class="thumb-title">Seat Selection</h4>
                            </header>
                            <div class="thumb-caption">
                               
                                <p class="thumb-desc">Choose your seat on a specific trip, and that seat will be reserved for you.</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row row-wrap" data-gutter="120">
                    <div class="col-md-4">
                        <div class="thumb">
                            <header class="thumb-header"><a href="{{url('about')}}"><i style="float: left;margin-right: 1rem;" class="fa fa-lock box-icon-border no-line round box-icon-white "></i></a><h4 class="thumb-title">Trust & Safety </h4>
                            </header>
                            <div class="thumb-caption">
                                
                                <p class="thumb-desc">All payments & Personal Information are secured, as they are transmitted using TLS encryption.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumb">
                            <header class="thumb-header"><a href="{{url('about')}}"><i style="float: left;margin-right: 1rem;" class="fas fa-dollar-sign no-line box-icon-border round box-icon-white "></i></a><h4 class="thumb-title">Best Price Guarantee </h4>
                            </header>
                            <div class="thumb-caption">
                                
                                <p class="thumb-desc">See all scheduled trips & fares of all the bus operators that service a chosen route. Then choose the best price available in the market.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thumb">
                            <header class="thumb-header"><a href="{{url('about')}}"><i style="float: left;margin-right: 1rem;" class="fas fa-pencil-alt no-line box-icon-border round box-icon-white "></i></a><h4 class="thumb-title">Ratings & Reviews</h4>
                            </header>
                            <div class="thumb-caption">
                                
                                <p class="thumb-desc">User experiences and their ratings of operators will help you make your travel decisions.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
      

          <div class="container">
        </div>
        <div class="special-area">
            <div class="owl-carousel owl-slider owl-carousel-area" id="owl-carousel-slider">
                            <div class="bg-holder full text-center text-white">
                    <div class="bg-mask"></div>
                    <div class="bg-img" style="background-image:url({{url($Slideurl.'1557458896.jpg')}});"></div>
                    <div class="bg-front full-center">
                        <div class="owl-cap">
                          
                            <h1 class="owl-cap-title">CP Client</h1>
                            <div class="owl-cap-price"><small>from</small>
                                <h5>₦100.00</h5>
                            </div><a class="btn btn-white btn-ghost" href="#"><i class="fa fa-angle-right"></i> Explore</a>
                        </div>
                    </div>
                </div>
                                <div class="bg-holder full text-center text-white">
                    <div class="bg-mask"></div>
                    <div class="bg-img" style="background-image:url({{url($Slideurl.'1557460753.jpg')}});"></div>
                    <div class="bg-front full-center">
                        <div class="owl-cap">
                          
                            <h1 class="owl-cap-title">Test Operator</h1>
                            <div class="owl-cap-price"><small>from</small>
                                <h5>₦100.00</h5>
                            </div><a class="btn btn-white btn-ghost" href="#"><i class="fa fa-angle-right"></i> Explore</a>
                        </div>
                    </div>
                </div>
                                
            </div>
        </div>
        <div class="container">
            <div class="gap"></div>
            <h2 class="text-center mb20">Top Travel Destinations</h2>
            <div class="row row-wrap text-center">
                        
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="thumb">
                        <header class="thumb-header">
                            <a class=" curved" href="#">
                                <div class="embed-responsive embed-responsive-4by3">
                                  <div class="embed-responsive-item" style="background: url('{{url($url.$cityImg['ABJ'])}}');background-position: center;background-size: cover;"></div>
                                </div>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">Abuja (Kubwa), FCT</h4>
                            
                        </div>
                    </div>
                </div>
                        
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="thumb">
                        <header class="thumb-header">
                           <a class=" curved" href="#">
                                <div class="embed-responsive embed-responsive-4by3">
                                  <div class="embed-responsive-item" style="background: url('{{url($url.$cityImg['ONT'])}}');background-position: center;background-size: cover;"></div>
                                </div>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">Onitsha, Anambra</h4>
                            
                        </div>
                    </div>
                </div>
                        
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="thumb">
                        <header class="thumb-header">
                       
                            <a class=" curved" href="#">
                                <div class="embed-responsive embed-responsive-4by3">
                                  <div class="embed-responsive-item" style="background: url('{{url($url.$cityImg['CAL'])}}');background-position: center;background-size: cover;"></div>
                                </div>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">Calabar</h4>
                            
                        </div>
                    </div>
                </div>
                        
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="thumb">
                        <header class="thumb-header">
                            <a class=" curved" href="#">
                                <div class="embed-responsive embed-responsive-4by3">
                                  <div class="embed-responsive-item" style="background: url('{{url($url.$cityImg['BNC'])}}');background-position: center;background-size: cover;"></div>
                                </div>
                            </a>
                        </header>
                        <div class="thumb-caption">
                            <h4 class="thumb-title">Benin City, Edo</h4>
                            
                        </div>
                    </div>
                </div>
                           
               
              
            </div>
            <div class="gap gap-small"></div>
        </div>

       

  @endsection

  @section('footerSection')

   <script> 
$(document).ready(function(){

    $(window).bind("pageshow", function() {
        $('.clearbk').val('');
    });

  $("#flip").click(function(){
    $("#panel").fadeToggle();

      if ($('#expandCheck').hasClass('fa-plus'))
        {
$('#expandCheck').removeClass('fa-plus');
$('#expandCheck').addClass('fa-minus');
        }
        else
        {
$('#expandCheck').removeClass('fa-minus');
$('#expandCheck').addClass('fa-plus');
        }

        
  });
    

 });    
 
    var date = new Date();
date.setDate(date.getDate());

 $(".inputcl").click(function(){
     
    $('select option[value="' + $(this).attr('data-val') +'"]').prop("selected", true);
  });
  
         $(".hreturn").click(function(){
    
   var type=$(this).attr('data-type');

   if(type == 'round'){
    $('input[name="end"]').val($('input[name="start"]').val());
     $('input[name="end"]').datepicker('setStartDate', $('input[name="start"]').val());
       $('.returndiv').fadeIn();
   }
   else{
        

        $('.returndiv').fadeOut();
   }
  });
    

    
$('input.date-pick, .input-daterange input[name="start"]').datepicker({format:'yyyy-mm-dd',autoclose:true,   startDate: date}).datepicker('setDate','today');


$('input.date-pick, .input-daterange input[name="end"]').datepicker({format:'yyyy-mm-dd',autoclose:true,setStartDate:date}).datepicker('setDate','today');

    $('input[name="start"]').datepicker({
        todayBtn:  1,
        autoclose: true,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('input[name="end"]').datepicker('setStartDate', minDate);
        $('input[name="end"]').datepicker('setDate',minDate);
         //$('input[name="end"]').val($('input[name="start"]').val());
    });
    
    $('input[name="end"]').datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
           
        });

    function clientSelOpt(t,main,action) {
    var id='#'+t.id;
    
       $(id).autocomplete({
  source: function( request, response ) {
   // Fetch data
   $.ajax({
    url: "{{route('getCities')}}",
    type: 'post',
    dataType: "json",
    data: {
    _token: "{{csrf_token()}}", search: request.term,action:action
    },
    success: function( data ) {
      response( $.map( data, function( item ) {

                        return {    label: item.label,
                                    value: item.label,
                                    mid: item.value,
                                   

                                    }
                    }));
    }
   });
  },
   change: function(event,ui) {
       console.log('df');
   },
  select: function (event, ui) {
   // Set selection

   $(id).val(ui.item.label); // display the selected text
  $('#'+main).val(ui.item.mid); // save selected id to input
   return false;
  },
      
  
 }).focus(function () {
    
    $(this).autocomplete("search");
  }).autocomplete( "instance" )._renderItem = function( ul, item ) {


      return $( "<li>" )
        .append( "<div class='underline'><i class='fa fa-map-marker' aria-hidden='true'></i> " + item.label + "</div>" )
        .appendTo( ul );
    };


  }
  
    

    function checkform(){
    
    var type=$('#flightChooseTab').find('.active').attr('data-type');
    if(type == 'single'){
        var req='required';
        $('#is_return').val('F');
    }
    else{
        var req='required';
        $('#is_return').val('T');
    }
    
     var errorCounter = validateForm(req);

     if (errorCounter > 0) {
        
        return false;
    }
    else{
        return true;
    }
  }
  
       function validateForm(cls) {
      // error handling
      var errorCounter = 0;
        var cs='.'+cls;
        
      $("."+cls).each(function(i, obj) {
        
          if($(this).val() === ''){
              $(this).parent().addClass("has-error");
              errorCounter++;
          } else{ 
              $(this).parent().removeClass("has-error"); 
          }


      });

      return errorCounter;
  }


 
</script>
@endsection