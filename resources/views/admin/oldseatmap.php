	
@extends('admin.layouts.app')

@section('title','Update Seat Map')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">

     <link type="text/css" rel="stylesheet" href="{{ asset('admin/plugins/seat/mseat.css') }}">
    <style>
.empty {
    background-color: #135E8D;
    color: #FFFFFF;
}
</style>


      <script src="{{ asset('admin/plugins/seat/jquery-ui.custom.min.js') }}"></script>
      <script src="{{ asset('admin/plugins/seat/pjAdminBusTypes.js') }}"></script>

@endsection
@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	
	  <!-- Main content -->
	  <section class="content">
	  	    <?php
    $ActiveSub="seat";
    ?>
@include('admin.layouts.fleetHeader')
	  	    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Update Seat</span>
    <span class="info-box-number"></span>
  </div>
  <!-- /.info-box-content -->
</div>
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Update Seat Map</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('seat.update',$Seat->SEATMAP_LIB_CODE) }}" method="post"  enctype="multipart/form-data">
	          {{ csrf_field() }}
	          {{ method_field('PUT') }}
	            <div class="box-body">

    	
    	 <div class="form-group col-md-6">
	                <label for="name">Map Name</label>
	                <input type="text" class="form-control" name="map_name" value="{{$Seat->SEAT_MAP_NAME}}" placeholder="Map Name" >
	       </div>

	       <br>
	       <div class="clearfix"></div>
   		
    	 <div class="form-group col-md-6">
	                <label for="name">Fleet Type</label>
	           
	                 <select class="form-control select2" name="fleet_type"  data-placeholder="Select Fleet Type" aria-hidden="true">
	                 	<option value="">Select Fleet Type</option>
                    @foreach ($FleetTypes as $FleetType)
                    <option value="{{ $FleetType->FLEET_TYPE_CODE }}"
                    	 @if ($FleetType->FLEET_TYPE_CODE == $Seat->FLEET_TYPE_CODE)
                        selected
                      @endif
                      
                      >{{ $FleetType->FLEET_TYPE_NAME }}</option>
                    @endforeach
                  </select>
	         
	    </div>

	       <br>
	       <div class="clearfix"></div>
   		
	    <div class="form-group col-md-6">
       <label>Description</label>
            <textarea class="form-control" name="description" rows="3">{{$Seat->SEAT_MAP_DESC}}</textarea>
     
    	</div>

				<div class="clearfix"></div>
				<br>
				<?php 
				if(empty($Seat->seat_img)){
				?>
			<div class="form-group col-md-4">
       <label>Image</label>
            <input type="file" name="image"  class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
     
    	</div>  
    <?php } 
    else{
    	?>

    	  	<div id="frmUpdateBusType" class="pull-left">

         <div class="bsMapHolder">
             <div id="mapHolder" style="position: relative; overflow: hidden; width: 300px; height: 700px; margin: 0 auto;">
              <img id="map" src="{{url('/public/images/seat/'.$Seat->seat_img)}}" >
                <?php
							if(count($SeatLib) > 0){
		   	  	 foreach ($SeatLib as $seat) {
								?><span rel="hi_<?php echo $seat['SEAT_NAME']; ?>" title="<?php echo $seat['SEAT_NAME']; ?>" class="rect empty" style="width: <?php echo $seat['WIDTH']; ?>px; height: <?php echo $seat['HEIGHT']; ?>px; left: <?php echo $seat['LEFT']; ?>px; top: <?php echo $seat['TOP']; ?>px; line-height: <?php echo $seat['HEIGHT']; ?>px"><span class="bsInnerRect" data-name="hi_<?php echo $seat['SEAT_ID']; ?>"><?php echo stripslashes($seat['SEAT_NAME']); ?></span></span><?php
							}
						}
							?>                 
          </div>
                           
							  
						
           </div>
		   	  <div id="hiddenHolder">
		   	  	<?php 
		   	  	//  echo '<input type="hidden" name="seats_new[]" id="hidden_1" value=" '.join("|", array($Lib['SEAT_ID'],$Lib['WIDTH'], $Lib['HEIGHT'], $Lib['LEFT'], $Lib['TOP'], $Lib['SEAT_NAME'])).'">';
		   	  	if(count($SeatLib) > 0){
		   	  	 foreach ($SeatLib as $Lib) {
		   	  	
            
      
        ?>
       <input id="hi_<?php echo $Lib['SEAT_NAME']; ?>" type="hidden" name="seats_new[]" value="<?php echo join("|", array($Lib['id'], $Lib['WIDTH'], $Lib['HEIGHT'], $Lib['LEFT'], $Lib['TOP'], $Lib['SEAT_NAME'])); ?>" />
       <?php
        }
       }
       ?>
					</div>
   	</div>
   
    	<?php
    }
     ?>
				<div class="clearfix"></div>
				<br>
				<i class="fa fa-chair"></i>f
	            <div class="form-group col-md-6">
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
  
  });
</script>
@endsection