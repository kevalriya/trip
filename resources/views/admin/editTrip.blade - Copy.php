  
@extends('admin.layouts.app')

@section('title','Update Trip')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
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
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Trip
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->

          <form role="form" action="{{ route('trip.update',$Trip->TRIP_ID) }}" method="post"  enctype="multipart/form-data">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Trip Detail</h3>
            </div>
          @include('includes.messages')      
            <!-- /.box-header -->
            <!-- form start -->
            
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="box-body">
              
           

     
      
       <div class="form-group col-md-6">
                  <label for="name">Trip Name</label>
                  <input type="text" class="form-control" name="trip_name" value="{{$Trip->TRIP_NAME}}" placeholder="Trip Name" >
                  <input type="hidden" name="oldRoute" value="{{$Trip->ROUTE_ID}}">
         </div>

       <div class="form-group col-md-6">
                  <label for="name">Route</label>
             
                   <select class="form-control select2" name="route"  data-placeholder="Select Fleet Type" id="route-point" aria-hidden="true">
                    <option value="">Select Route</option>
                    @foreach ($Routes as $Route)
                    <option value="{{ $Route->ROUTE_ID }}"
                       @if ($Route->ROUTE_ID == $Trip->ROUTE_ID)
                        selected
                      @endif
                      >{{ $Route->ROUTE_NAME }} -- {{$Route->operator->OPERATOR_LEGAL_NAME}}</option>
                    @endforeach
        </select>
           
      </div>  
       <div class="form-group col-md-6">
                  <label for="name">Fleet</label>
             
                   <select class="form-control select2" name="fleet"  data-placeholder="Select Operator" aria-hidden="true">
                    <option value="">Select Fleet</option>
                    @foreach ($Fleets as $Fleet)
                    <option value="{{ $Fleet->FLEET_ID }}"
                       @if ($Fleet->FLEET_ID == $Trip->FLEET_REG_ID)
                        selected
                      @endif
                      >{{ $Fleet->FLEET_NAME }}</option>
                    @endforeach
                  </select>
           
      </div>

   <div class="form-group col-md-6">
                  <label for="name">Driver</label>
             
                   <select class="form-control select2" name="driver"  data-placeholder="Select Operator" aria-hidden="true">
                    
                    <option value="1" selected>Demo1</option>
                    <option value="2">Demo2</option>
                  
                  </select>
           
      </div>


      

      

      
      
     

                <hr>

            <div class="clearfix"></div>
         <div id="routepoints-result"> 


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
                        $adultValue=$Fares[$row['CITY_CODE']][$col['CITY_CODE']]['fareAdult'] ;
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
                        $adultValue=$Fares[$row['CITY_CODE']][$col['CITY_CODE']]['fareChild'] ;
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
                        $adultValue=$Fares[$row['CITY_CODE']][$col['CITY_CODE']]['fareSpecial'] ;
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

    <?php
  } 
 
  ?>
            
    

         </div>


        <div class="clearfix"></div>

              <div class="form-group col-md-4">
               <button type="submit" class="btn btn-primary">Submit</button>
               
              </div>
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

<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>


<script>
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