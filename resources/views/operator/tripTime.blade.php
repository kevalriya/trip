<?php 
$ActiveSide='trip';
?>  
@extends('operator.layouts.app')

@section('title','Route Detail')
@section('headSection')

<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/timepicker/timePicker.css') }}">
<style type="text/css"> 
  .ui-sortable-handle {
    cursor: move; /* fallback if grab cursor is unsupported */
    cursor: grab;
    cursor: -moz-grab;
    cursor: -webkit-grab;
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
 
  <li ><a  href="{{route('opeditTripschedule',$Trip->TRIP_ID)}}">Schedule</a></li>
  <li  class="active"><a  href="{{route('opeditTripTime',$Trip->TRIP_ID)}}">Itinerary</a></li>
   <li ><a  href="{{route('opeditTripFare',$Trip->TRIP_ID)}}">Fare</a></li>
    <li > <a href="{{route('opstartTrip',$Trip->TRIP_ID)}}">Start Trip</a></li>

    <li> <a href="{{route('opendTrip',$Trip->TRIP_ID)}}">End Trip</a></li>
 
</ul>

      <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
    <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
    <div class="info-box-content">
      <span class="info-box-number">Trip Time</span>
       @foreach ($data as $i)
        <span id="tabInfo" data-id="{{$i->id}}" readonly>{{$i->description}}</span>
        @endforeach
    </div>
    <!-- /.info-box-content -->
  </div>

      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
       


                <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$Trip->TRIP_NAME}}</h3>
          <br><small>Stop Points</small>
        
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
             <div class="col-md-12">
              @include('includes.messages') 
          
          <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>

    <div class="clearfix"></div>
 

    <div class="col-md-2 col-xs-2 col-sm-2">
      <label>Route</label>
    </div>

     <div class="col-md-4 col-xs-8 col-sm-8">
      <input type="text" class="form-control" value="{{ (isset($Route->ROUTE_NAME)) ? $Route->ROUTE_NAME : ''  }}" disabled="">
    </div>

    <div class="clearfix"></div>
    <br>
                <form role="form" action="{{ route('opupdateTripTime',$Trip->TRIP_ID) }}" method="post"  enctype="multipart/form-data">
           
            <table class="table table-responsive unsortable" id="add_route_table">
                   {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" name="route" value="{{$Trip->ROUTE_ID}}">
          
         <thead>
          <tr>
          
          <td>RouteId </td>
          <td>City </td>
          <td>Type </td>
          <td>Arrival Time </td>
          <td>Departure Time </td>
          
          </tr>
        </thead>
        
         <tbody>

            @forelse ($RoutePoint as $Point)
        <?php 
        if($Point['ROUTE_STOPPOINT_TYPE'] == 'START'){
          $arvd="readonly";
          $acls="";
        }
        else{
          $arvd="";
          $acls="timepicker";
        }

    if($Point['ROUTE_STOPPOINT_TYPE'] == 'FINAL'){
    $depd="readonly";
     $dcls="";
        }
        else{
          $depd="";
           $dcls="timepicker";
        }

       $Avtime= (!empty($Times[$Point['CITY_CODE']]['ARRIVAL_TIME'])) ? date('H:i',strtotime($Times[$Point['CITY_CODE']]['ARRIVAL_TIME'])) : '';
       $DPtime=  (!empty($Times[$Point['CITY_CODE']]['DEPARTURE_TIME'])) ? date('H:i',strtotime($Times[$Point['CITY_CODE']]['DEPARTURE_TIME'])) : '';
        ?>
    <tr>
            
            <td><?php echo $Point['ROUTE_ID']; ?></td>
    
              <td>
                <input type="hidden" name="city[]" value="{{$Point['CITY_CODE']}}" >
                {{$Point['CITY_NAME']}}
                
                
             
               </td>
              
              <td>
                <?php echo $Point['ROUTE_STOPPOINT_TYPE'] ?>
              </td>
              <td>
                <input type="text" class="form-control {{$acls}}" name="arr[]" value="{{$Avtime}}"  {{$arvd}}>
              </td>

               
              <td>
                <input type="text" class="form-control {{$dcls}}" name="dep[]" value="{{$DPtime}}" {{$depd}}>
              </td>

             
            </tr>
@empty
   
            <tr >
              <td colspan="5">No Stop point found</td>
            </tr>

@endforelse
          </tbody>


        </table>
  <div class="clearfix"></div>
  <br>

    <div class="col-md-3 col-xs-3 col-sm-3">
      <label>Link To Trip</label>
    </div>

     <div class="col-md-4 col-xs-8 col-sm-8">
      <input type="text" class="form-control" value="{{ (isset($Trip->TRIP_ID)) ? $Trip->TRIP_ID : ''  }}" disabled="">
    </div>

    <div class="clearfix"></div>
    <br>


  <div class="form-group col-md-4">
               <button type="submit" class="btn btn-primary">Submit</button>
               
              </div>

      </form>
             <div class="clearfix"></div>

        </div>
     </div> 


         
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      
      </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col-->
          </section>
      </div>
      <!-- ./row -->
  


  <!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/timepicker/jquery-timepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jQueryUI/jquery-ui.min.js') }}"></script>

<script>
  $(document).ready(function() {



  $(document).on('click', ".delete-route", function(e) {
 
    e.preventDefault;

       var t=this;
    var con = confirm('Are you sure to delete this ?');
            if(con == true) {
              $(t).parent('td').parent('tr').remove();
              
              
          }
   });
      
  
    
   $(".timepicker").hunterTimePicker();

       
  $(document).on('change', ".state", function(e) {
      e.preventDefault;
      var cls=$(this).parent('td').parent('tr').find('.scity');
     
      var country=$(this).find('option:selected').val();

    if(country != '')
      $.ajax({
        url: "{{route('getCity')}}",
        type: "POST",
        data : {id:country, _token: "{{csrf_token()}}"},
       
        success: function(data){
          
        cls.empty();
       cls.html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  

  }); 



    

});


</script>
@endsection