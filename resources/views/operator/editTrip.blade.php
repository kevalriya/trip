<?php 
$ActiveSide='trip';
?>   
@extends('operator.layouts.app')

@section('title','Edit Trip')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/timepicker/timePicker.css') }}">
<style type="text/css">
  .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #337ab7 !important;}
</style>
@endsection
@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">


      <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
    <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Edit Trip</span>
      <span class="info-box-number"></span>
    </div>
    <!-- /.info-box-content -->
  </div>

      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->

      
          <form role="form" action="{{ route('operator.trip.update',$Trip->TRIP_ID) }}" method="post"  enctype="multipart/form-data">

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
                  <label for="name">Trip ID</label>
                  <input type="text" class="form-control" name="trip_name" value="{{$Trip->ROUTE_ID}}" placeholder="Trip Name" readonly="">
                  <input type="hidden" name="oldRoute" value="{{$Trip->ROUTE_ID}}">
         </div>
         <div class="clearfix"></div>

       <div class="form-group col-md-6">
                  <label for="name">Trip Name</label>
                  <input type="text" class="form-control" name="trip_name" value="{{$Trip->TRIP_NAME}}" placeholder="Trip Name" >
                  <input type="hidden" name="oldRoute" value="{{$Trip->ROUTE_ID}}">
         </div>

         <div class="clearfix"></div>

       <div class="form-group col-md-6">
                  <label for="name">Route</label>
             
                   <select class="form-control select2" name="route"  data-placeholder="Select Fleet Type" id="route"  aria-hidden="true">
                    <option value="">Select Route</option>
                    @foreach ($Routes as $Route)
                    <option value="{{ $Route->ROUTE_ID }}"
                       @if ($Route->ROUTE_ID == $Trip->ROUTE_ID)
                        selected
                      @endif
                      >{{ $Route->ROUTE_NAME }} </option>
                    @endforeach
        </select>
           
      </div> 
       <div class="clearfix"></div>

       <div class="form-group col-md-6">
                  <label for="name">Fleet Id</label>
             
                   <select class="form-control select2" name="fleet" id="fleet" data-placeholder="Select Operator" aria-hidden="true">
                    <option value="">Select Fleet</option>
                    @foreach ($Fleets as $Fleet)
                    <option value="{{ $Fleet->FLEET_ID }}"
                       @if ($Fleet->FLEET_ID == $Trip->FLEET_REG_ID)
                        selected
                      @endif
                       data-type="{{$Fleet->FLEET_TYPE_CODE}}">{{ $Fleet->FLEET_NAME }}</option>
                    @endforeach
                  </select>
           
      </div>
 <div class="clearfix"></div>


   <div class="form-group col-md-6">
                  <label for="name">Driver</label>
             
                   <select class="form-control select2" name="driver"  data-placeholder="Select Operator" aria-hidden="true">
                   @foreach ($Drivers as $Driver)
                    <option value="{{ $Driver->USER_ID }}"  @if ($Driver->USER_ID == $Trip->DRIVER_ID)
                        selected
                      @endif>{{ $Driver->FIRSTNAME  }} {{ $Driver->SURNAME }}</option>
                    @endforeach
                  </select>
           
    </div>


  <div class="clearfix"></div>


      <div class="form-group col-md-6">
          <label for="name">Fare</label>
             <input type="text" class="form-control" name="fare" value="{{$Trip->FARE}}" >
           
      </div>
<div class="clearfix"></div>

      <div class="form-group col-md-6">
          <label for="name">Max Seat</label>
             <input type="text" class="form-control" name="max_seat" value="{{$Trip->max_seat}}" >
           
      </div>
<div class="clearfix"></div>

           <div class="form-group col-md-6">
                  <label for="name">Add Seat</label>
             
                   <select class="form-control select2" name="seat" id="seat"  data-placeholder="Select Seat" aria-hidden="true">
                    <option value="">Select Seat</option>
                    <?php
                    if(isset($Seat->SEATMAP_LIB_CODE)){
                    ?>
                    <option value="{{$Seat->SEATMAP_LIB_CODE}}" selected>{{$Seat->SEAT_MAP_NAME}}</option>
                  <?php } ?>
                  </select>
           
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
<script src="{{ asset('admin/plugins/timepicker/jquery-timepicker.js') }}"></script>

<script>
  $(document).ready(function() {
         $('.multiple').select2();
      
      $(".timepicker").hunterTimePicker();

       $(document).on('change', "#fleet", function(e) {
      e.preventDefault;
      $('#seat').empty();
      getSeat();
  });
      
      

       
  });

  
   function getSeat(){
      
    var type=$('#fleet :selected').attr('data-type');
  
    if(type != '')
      $.ajax({
        url: "{{route('opgetSeat')}}",
        type: "POST",
        data : {id:type, _token: "{{csrf_token()}}"},
       
        success: function(data){
        $('#seat').empty();
        $('#seat').html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    }


</script>
@endsection