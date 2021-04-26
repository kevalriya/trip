<?php 
$ActiveSide='trip';
?>   
@extends('operator.layouts.app')

@section('title','Edit Trip')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{asset('admin/plugins/iCheck/square/blue.css')}}">

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

    
     <ul class="nav nav-tabs">
 
  <li class="active"><a  href="{{route('opeditTripschedule',$Trip->TRIP_ID)}}">Schedule</a></li>
  <li  ><a  href="{{route('opeditTripTime',$Trip->TRIP_ID)}}">Itinerary</a></li>
   <li ><a  href="{{route('opeditTripFare',$Trip->TRIP_ID)}}">Fare</a></li>
    <li > <a href="{{route('opstartTrip',$Trip->TRIP_ID)}}">Start Trip</a></li>

    <li> <a href="{{route('opendTrip',$Trip->TRIP_ID)}}">End Trip</a></li>
 
</ul>


      <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
    <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
    <div class="info-box-content">
      <span class="info-box-number">Edit Trip</span>
       @foreach ($data as $i)
        <span id="tabInfo" data-id="{{$i->id}}" readonly>{{$i->description}}</span>
        @endforeach
    </div>
    <!-- /.info-box-content -->
  </div>

      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->

      
          <form role="form" action="{{ route('opupdateTripschedule',$Trip->TRIP_ID) }}" method="post"  enctype="multipart/form-data">

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
                  <label for="name">Trip</label>
                  <input type="text" class="form-control" value="{{$Trip->TRIP_NAME}}" disabled="" > 
                  <input type="hidden" name="oldRoute" value="{{$Trip->ROUTE_ID}}">
         </div>

       <div class="form-group col-md-4 pull-right">
             <div class="checkbox icheck">
            <label>Active Trip
              <input type="checkbox" class="mcheck" value="1" name="status" <?php echo ($Trip->STATUS == '1') ? 'checked' : '' ?>> 
            </label>
          </div>

         </div>

       <div class="clearfix"></div>

           <div class="form-group col-md-2" style="margin-top: 10px">
             <label for="name">Frequency</label>
           </div>
           <div class="form-group col-md-3">
                 
                  
                  <div class="radio">
  <label><input type="radio" name="frq" value="Hourly"  <?php echo ($Trip->Frequency == 'Hourly') ? 'checked' : '' ?>>Hourly</label>
</div>
<div class="radio">
  <label><input type="radio" name="frq" value="Daily" <?php echo ($Trip->Frequency == 'Daily') ? 'checked' : '' ?>>Daily</label>
</div>
<div class="radio">
  <label><input type="radio" name="frq" value="Weekly"  <?php echo ($Trip->Frequency == 'Weekly') ? 'checked' : '' ?>>Weekly</label>
</div>
<div class="radio">
  <label><input type="radio" name="frq" value="Monthly"  <?php echo ($Trip->Frequency == 'Monthly') ? 'checked' : '' ?>>Monthly</label>
</div>
         </div>

  <div class="form-group col-md-3" style="margin-right:-60px !important">
                  <?php
                  $Recurrings=array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
                  if(isset($Trip->recurring)){
                    $DBRecurring=explode(",",$Trip->recurring);
                  }
                  else{
                    $DBRecurring=array();
                  }

                  ?>
               
               @foreach ($Recurrings as $Recurring)

                  <div class="radio">
  <label><input type="checkbox" name="recurring[]" value="{{ $Recurring }}" @if (in_array($Recurring,$DBRecurring))
                        checked 
                      @endif>{{ ucfirst($Recurring) }}</label>
    </div>
                    
                    @endforeach    


         </div>
         <div style="margin-top: 50px">
         <div class="col-md-1 col-xs-3 col-sm-3" style="padding: 0px;margin: 0px">
          <label>At</label>
         </div>

         <div class="col-md-1 col-xs-3 col-sm-3" style="padding: 0px;margin: 0px">
          <select class="form-control" name="hour">
            <?php
             for ($i=1; $i <= 12 ; $i++) { 
                if($i<10){
                  $v='0'.$i;
                }
                else{
                   $v=$i;
                }
               if($v == date('h',strtotime($Trip->ACTUAL_DEP_TIME))) {
                $sel="selected";
               }
               else{
                $sel="";
               }
               echo "<option value='$v' $sel> $i </option>";
             }

            ?>
          </select>
         </div>
        
         <div class="col-md-1 col-xs-3 col-sm-3" style="padding: 0px;margin: 0px">
             <select class="form-control" name="min">
            <?php
             for ($i=0; $i <= 60 ; $i++) { 
                if($i<10){
                  $v='0'.$i;
                }
                else{
                   $v=$i;
                }

                 if($v == date('i',strtotime($Trip->ACTUAL_DEP_TIME))) {
                $sel="selected";
               }
               else{
                $sel="";
               }
               echo "<option value='$v' $sel> $v </option>";
             }
            ?>
          </select>
         </div>

         <div class="col-md-1 col-xs-3 col-sm-3" style="padding: 0px;margin: 0px">
             <select class="form-control" name="ampm">
              <option value="AM" <?php echo (date('A',strtotime($Trip->ACTUAL_DEP_TIME)) == 'AM') ? 'selected' : '' ?>>AM</option>
              <option value="PM" <?php echo (date('A',strtotime($Trip->ACTUAL_DEP_TIME)) == 'PM') ? 'selected' : '' ?>>PM</option>
          </select>
         </div>

       </div>

            <div class="clearfix"></div>

      <div class="col-md-2" style="margin-top: 10px;"><label>Period Operating</label></div>
      <div class="col-md-2 text-right" style="margin-top: 10px;width: 100px"><label for="name">From:</label></div>


        <div class="form-group col-md-3">
          
             <input type="text" class="form-control datepicker" name="from_date" value="{{(empty($Trip->fromDate)) ? '' : $Trip->fromDate }}" >
           
      </div>
      <div class="col-md-2 text-right" style="margin-top: 10px;width: 100px"><label for="name">To:</label></div>
         <div class="form-group col-md-3">
         
             <input type="text" class="form-control datepicker" name="to_date" value="{{(empty($Trip->toDate)) ? '' : $Trip->toDate }}" >
           
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
<script src="{{ asset('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>

<script>
  $(document).ready(function() {
         $('.multiple').select2();
          $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
      autoclose: true,
    });
  
  $('.mcheck').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });

  });



</script>
@endsection