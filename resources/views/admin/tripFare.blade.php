<?php 
$ActiveSide='trip';
?>  
@extends('admin.layouts.app')

@section('title','Trip Fare')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/dist/css/info.css') }}">
<style type="text/css">
  .pj-location-grid{
  overflow: hidden;
}
.pj-location-grid table.display th, 
.pj-location-grid table.display td {
    border: 1px solid #CCCCCC;
    padding-left: 10px;
    padding-right: 10px;
}
.pj-location-grid .pj-first-column table.display td{
  color: #21201f;
  font-size: 13px;
  
}
.pj-location-grid .pj-location-column table.display td{
  padding-right: 0px;
  padding-left: 0px;
}
.pj-location-grid .pj-first-column table.display td,
.pj-location-grid .pj-first-column table.display th{
  border-right: none;
  background-color: #f4f4f4;
}
.pj-location-grid .pj-first-column table.display th{
  background-color: #f4f4f4;
  color: #acacab;
  font-weight: bold;
  font-size: 14px;
}
.pj-location-grid .pj-location-column table.display th{
  color: #21201F;
    font-size: 13px;
  background-color: #f4f4f4;
}
.pj-location-grid .pj-location-column table.display th a{
  color: #369bcf;
}
.pj-first-column{
  margin-top: 24px;
  border-right: 1px solid #CCCCCC;
    float: left;
    overflow: hidden;
}
.pj-first-column table th,.pj-first-column table td {
  width: 80px;
  border-right: none;
}
.pj-first-column table td{
  color: #474646;
  font-size: 12px;
}

.pj-location-column table th.first-col, .pj-location-column table td.first-col {
  border-left: none;
}
.pj-location-column table td{
  color: #827f7f;
}
.pj-location-column table th .break{
  height: 8px;
}
table#compare_table tr {
  
}

#compare_table {
  margin-bottom: 4px;
}
table#compare_table td{
  text-align: center;
}

.wrapper1,.wrapper2 {
  overflow: auto; 
  -ms-overflow-y: hidden;
  overflow-y:hidden;
}

.wrapper1 {
  height: 17px;
  margin-bottom: 7px;
}
.wrapper2{
  margin-top: 4px;
}
.div1-compare{
  height: 20px;
}

.div2-compare{
  overflow: auto;
}

</style>
@endsection
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

  
    <ul class="nav nav-tabs">
 
  <li><a  href="{{route('editTripschedule',$Trip->TRIP_ID)}}">Schedule</a></li>
  <li  ><a  href="{{route('editTripTime',$Trip->TRIP_ID)}}">Itinerary</a></li>
   <li class="active"><a  href="{{route('editTripFare',$Trip->TRIP_ID)}}">Fare</a></li>
    <li > <a href="{{route('startTrip',$Trip->TRIP_ID)}}">Start Trip</a></li>

    <li> <a href="{{route('endTrip',$Trip->TRIP_ID)}}">End Trip</a></li>
 
</ul>
      <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
    <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
    <div class="info-box-content">
      <span class="info-box-number">Trip Fare</span>
      @foreach ($data as $i)
        <textarea id="tabInfo" data-id="{{$i->id}}" readonly>{{$i->description}}</textarea>
        @endforeach
      <button class="btn-aqua" id="infoUpdate"><i class="fa fa-check fa-2x"></i></button>
    </div>
    <!-- /.info-box-content -->
  </div>

      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->

      
          <form role="form" action="{{ route('updateTripFare',$Trip->TRIP_ID) }}" method="post"  enctype="multipart/form-data">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Trip Fare</h3>
            </div>
          @include('includes.messages')      
            <!-- /.box-header -->
            <!-- form start -->
            
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="box-body">
              
           

     
             <div id="routepoints-result"> 
              <input type="hidden" name="route" value="{{$Trip->ROUTE_ID}}">


           <?php
       
$number_of_locations = count($RoutePoint); 
$CityPost=array();
            if($number_of_locations > 0)
          {
    ?>
    <h4>Adult Ticket Fare </h4>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <table cellpadding="0" cellspacing="0" border="0" class="table">
        <thead>
          <tr class="title-head-row">
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($RoutePoint as $k => $v)
          {
            if($k <= ($number_of_locations - 2))
            {
              ?>
              <tr class="title-row" lang="<?php echo $v['CITY_CODE']; ?>">
                <td><?php echo $v['CITY_NAME'] ?></td>
              </tr>
              <?php
            }
          } 
          ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-10 col-sm-10 col-xs-10">
      
      
        
          <table cellpadding="0" cellspacing="0" border="0" class="table" id="compare_table" >
              <thead>
              <tr class="content-head-row">
                <?php
                $j = 1;
                foreach($RoutePoint as $v)
                {
                  if($j > 1)
                  {
                    ?>
                    <th class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                      <?php echo $v['CITY_NAME'] ?>
                    </th>
                    <?php
                  }
                  $j++;
                } 
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($RoutePoint as $k => $row)
              {
                if($k <= ($number_of_locations - 2))
                {
                  ?>
                  <tr class="content_row_<?php echo $row['CITY_CODE']; ?>">
                    <?php
                    $j = 1;
                    foreach($RoutePoint as $col)
                    {
                      if($j > 1)
                      {
                        $pair_id = $row['CITY_CODE'] . '_' . $col['CITY_CODE'];

                        if(isset($Fares[$row['CITY_CODE']][$col['CITY_CODE']]) ){
                        $adultValue=$Fares[$row['CITY_CODE']][$col['CITY_CODE']]['FAREADULT'] ;
                        }
                        else{
                          $adultValue='' ;
                        }
                        ?>
                        <td class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                          <?php
                          if($col['ROUTE_STOPPOINT_SEQNO'] > $row['ROUTE_STOPPOINT_SEQNO'])
                          { 
                            ?>
                              <span class="pj-form-field-custom pj-form-field-custom-before">
                                <span class="pj-form-field-before"><abbr class="pj-form-field-icon-text">
                                  
                                </abbr></span>
                                <input type="text" name="adult[<?php echo $row['CITY_CODE'] ?>_<?php echo $col['CITY_CODE'] ?>]" class="form-control" value="<?php echo $adultValue ?>" />
                              </span>
                            <?php
                          }else{
                            echo '&nbsp;';
                          } 
                          ?>
                        </td>
                        <?php
                      }
                      $j++;
                    } 
                    ?>
                  </tr>
                  <?php
                }
              } 
              ?>
            </tbody>
          </table>
       
      </div>
  <hr>

    <h4>Child Ticket Fare </h4>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <table cellpadding="0" cellspacing="0" border="0" class="table">
        <thead>
          <tr class="title-head-row">
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($RoutePoint as $k => $v)
          {
            if($k <= ($number_of_locations - 2))
            {
              ?>
              <tr class="title-row" lang="<?php echo $v['CITY_CODE']; ?>">
                <td><?php echo $v['CITY_NAME'] ?></td>
              </tr>
              <?php
            }
          } 
          ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-10 col-sm-10 col-xs-10">
      
      
        
          <table cellpadding="0" cellspacing="0" border="0" class="table" id="compare_table" >
              <thead>
              <tr class="content-head-row">
                <?php
                $j = 1;
                foreach($RoutePoint as $v)
                {
                  if($j > 1)
                  {
                    ?>
                    <th class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                      <?php echo $v['CITY_NAME'] ?>
                    </th>
                    <?php
                  }
                  $j++;
                } 
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($RoutePoint as $k => $row)
              {
                if($k <= ($number_of_locations - 2))
                {
                  ?>
                  <tr class="content_row_<?php echo $row['CITY_CODE']; ?>">
                    <?php
                    $j = 1;
                    foreach($RoutePoint as $col)
                    {
                      if($j > 1)
                      {
                        $pair_id = $row['CITY_CODE'] . '_' . $col['CITY_CODE'];
                          if(isset($Fares[$row['CITY_CODE']][$col['CITY_CODE']]) ){
                        $adultValue=$Fares[$row['CITY_CODE']][$col['CITY_CODE']]['FARECHILD'] ;
                        }
                        else{
                          $adultValue='' ;
                        }
                        ?>
                        <td class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                          <?php
                          if($col['ROUTE_STOPPOINT_SEQNO'] > $row['ROUTE_STOPPOINT_SEQNO'])
                          { 
                            ?>
                              <span class="pj-form-field-custom pj-form-field-custom-before">
                                <span class="pj-form-field-before"><abbr class="pj-form-field-icon-text">
                                  
                                </abbr></span>
                                <input type="text" name="child[<?php echo $row['CITY_CODE'] ?>_<?php echo $col['CITY_CODE'] ?>]" class="form-control" value="<?php echo $adultValue ?>" />
                              </span>
                            <?php
                          }else{
                            echo '&nbsp;';
                          } 
                          ?>
                        </td>
                        <?php
                      }
                      $j++;
                    } 
                    ?>
                  </tr>
                  <?php
                }
              } 
              ?>
            </tbody>
          </table>
        
      </div>
  <hr> 

    <h4>Special Ticket Fare </h4>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <table cellpadding="0" cellspacing="0" border="0" class="table">
        <thead>
          <tr class="title-head-row">
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($RoutePoint as $k => $v)
          {
            if($k <= ($number_of_locations - 2))
            {
              ?>
              <tr class="title-row" lang="<?php echo $v['CITY_CODE']; ?>">
                <td><?php echo $v['CITY_NAME'] ?></td>
              </tr>
              <?php
            }
          } 
          ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-10 col-sm-10 col-xs-10">
      
      
        
          <table cellpadding="0" cellspacing="0" border="0" class="table" id="compare_table" >
              <thead>
              <tr class="content-head-row">
                <?php
                $j = 1;
                foreach($RoutePoint as $v)
                {
                  if($j > 1)
                  {
                    ?>
                    <th class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                      <?php echo $v['CITY_NAME'] ?>
                    </th>
                    <?php
                  }
                  $j++;
                } 
                ?>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($RoutePoint as $k => $row)
              {
                if($k <= ($number_of_locations - 2))
                {
                  ?>
                  <tr class="content_row_<?php echo $row['CITY_CODE']; ?>">
                    <?php
                    $j = 1;
                    foreach($RoutePoint as $col)
                    {
                      if($j > 1)
                      {
                        $pair_id = $row['CITY_CODE'] . '_' . $col['CITY_CODE'];
                        if(isset($Fares[$row['CITY_CODE']][$col['CITY_CODE']]) ){
                        $adultValue=$Fares[$row['CITY_CODE']][$col['CITY_CODE']]['FARESPECIAL'] ;
                        }
                        else{
                          $adultValue='' ;
                        }
                        ?>
                        <td class="<?php echo $j == 2 ? 'first-col' : null;?>" >
                          <?php
                          if($col['ROUTE_STOPPOINT_SEQNO'] > $row['ROUTE_STOPPOINT_SEQNO'])
                          { 
                            ?>
                              <span class="pj-form-field-custom pj-form-field-custom-before">
                                <span class="pj-form-field-before"><abbr class="pj-form-field-icon-text">
                                  
                                </abbr></span>
                                <input type="text"  name="special[<?php echo $row['CITY_CODE'] ?>_<?php echo $col['CITY_CODE'] ?>]" class="form-control" value="<?php echo $adultValue ?>" />
                              </span>
                            <?php
                          }else{
                            echo '&nbsp;';
                          } 
                          ?>
                        </td>
                        <?php
                      }
                      $j++;
                    } 
                    ?>
                  </tr>
                  <?php
                }
              } 
              ?>
            </tbody>
          </table>
        
      </div>
  <hr>

  </div>

         
      <div class="form-group col-md-4">
               <button type="submit" class="btn btn-primary">Submit</button>
               
              </div>
    <?php
  }
  else{

    
   echo "<h5 class='text-danger'>No Stop point found </h5>";
    echo '<h6> <a href="'.route("routepoint",$Trip->ROUTE_ID).'" target="_blank"> Please Add Stop point here </a> </h6>';
    echo "</div>";
  } 
 
  ?>
            
    

       
                   </div>
              </div>
            </form>


          </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/dist/js/info.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>

<script>
updateInformation("{{route('trip.tabInfo')}}", '{{csrf_token()}}');
  $(document).ready(function() {
        
      $(document).on('change', "#route-point", function(e) {
        getRoutePoint();
      });
  });

     function getRoutePoint(){
      
    var route=$('#route-point :selected').val();
  
    if(route != '')
      $.ajax({
        url: "{{route('getPoints')}}",
        type: "POST",
        data : {route:route, _token: "{{csrf_token()}}"},
       
        success: function(data){
        $('#routepoints-result').empty();
        $('#routepoints-result').html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    }

</script>
@endsection