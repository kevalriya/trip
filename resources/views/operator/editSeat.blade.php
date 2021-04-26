<?php 
$ActiveSide='fleet';
?> 	
@extends('operator.layouts.app')

@section('title','Update Seat Map')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">

     <link type="text/css" rel="stylesheet" href="{{ asset('admin/plugins/seat/mseat.css') }}">
    <style>
.seat_layout td{
		text-decoration: none;
		display: inline;
		padding: 8px;
	}
.pos{
		background-color: #e4e4e4;
		
	}
	.seat{
		background: url({{URL::to('images/seatk.png')}});
		background-size: contain;
		padding: 1px 10px;
	}

	.steering{
		background: url({{URL::to('images/steering.png')}});
		background-size: contain;
		padding: 1px 10px;
	}
	.bookseat{
	
		background: url({{URL::to('images/bookseat.png')}});
		background-size: contain;
		padding: 1px 10px;
		border-radius: 5px;
	
	}
	.selectseat{
	
		background: url({{URL::to('images/selectseat.png')}});
		background-size: contain;
		padding: 1px 10px;
		border-radius: 5px;
	
	}
	.door{
		background: url({{URL::to('images/door.png')}});
		background-size: contain;
		padding: 1px 10px;
	}
	.legends li{
		text-decoration: none;
		padding: 10px;
	}
		.borderless td, .borderless th {
    border: none;
    
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
		border-top: 1px solid transparent;	
	}

	

	.table.seats_table {
	    width: 100%;
	    max-width: 350px;
	    text-align: center;
	    margin: 30px auto;
	}

	.seats_table td span {
	    background-size: contain;
	    padding: 7px 16px;
	    background-repeat: no-repeat !important;
	    background-position: center;
	    height: 43px;
	    display: inline-block;
	}
</style>
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
    $ActiveSub="fleettype";
    ?>
@include('operator.layouts.fleetHeader')
	  	    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-number">Update Seat</span>
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
	            <h3 class="box-title">Update Seat Map</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('operator.seat.update',$Seat->SEATMAP_LIB_CODE) }}" method="post"  enctype="multipart/form-data">
	          {{ csrf_field() }}
	          {{ method_field('PUT') }}
	            <div class="box-body">

    	
    	 <div class="form-group col-md-6">
	                <label for="name">Map Name</label>
	                <input type="text" class="form-control" name="map_name" value="{{$Seat->SEAT_MAP_NAME}}" placeholder="Map Name" >
	       </div>

	       <?php 
	       if($default=='yes'){
	       	?>
	       	 <div class="form-group col-md-6">
	                <label for="name">Fleet Type</label>
	           <input type="hidden" name="fleet_type" value="{{$FleetTypes->FLEET_TYPE_CODE}}" >
	           <input type="text" class="form-control" value="{{$FleetTypes->FLEET_TYPE_NAME}}" readonly="">
	         
	    </div>
	       	<?php
	       }
	       else{


	       ?>
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
	<?php } ?>
	         <div class="form-group col-md-3">
       <label>No of Column</label>
    
     <input type="number" class="form-control" max="26" min="1" value="{{$Seat->columns}}" name="column">
    	</div>  
	 <div class="form-group col-md-3">
       <label>No of rows</label>
    
     <input type="number" class="form-control" max="26" min="1" value="{{$Seat->rows}}" name="row">
    	</div>  


	    <div class="form-group col-md-6">
       <label>Description</label>
            <textarea class="form-control" name="description" rows="3">{{$Seat->SEAT_MAP_DESC}}</textarea>
     
    	</div>

    	<div class="clearfix"></div>
				
			
	            <div class="form-group col-md-2" style="margin-top: -50px;">
	             <button type="submit" class="btn btn-xs btn-primary">Update</button>
	             
	            </div>

    	<div class="clearfix"></div>
				<br>
				

				<?php

			

				if($Seat->rows > 0 && $Seat->columns > 0){
					?>

					<div class="seatcolrow">
	<div class="row mt-2">
	
			<div class="col-md-2">Rows: {{$Seat->rows}}</div>
			<div class="col-md-2">Columns: {{$Seat->columns}}</div>
		
	</div>
		<div class="row mt-2">
		
		
			<div class="col-md-3">
				<table class="table borderless no-spacing seats_table">
	<?php
					$Latter=range('A', 'Z');
					array_unshift($Latter, "#");


					$Rows=$Seat->rows;
					$Columns=$Seat->columns;
					
					for ($i=0; $i <= $Rows ; $i++) { 
						echo "<tr>";
						
						echo "<td>".$Latter[$i]."</td>";
							for ($j=1; $j <= $Columns ; $j++) { 
								$inputval=$Latter[$i].$j;
								if(isset($SeatArr[$inputval]) ){
									$SeatVal=$SeatArr[$inputval];
								}
								else{
									$SeatVal=0;
								}
								
								if($SeatVal==1){
									$cls='seat';
								}
								else if($SeatVal==2){
									$cls='door';
								}
								else{
									$cls='pos';
								}

								if($i==0){
									echo "<td>".$j."</td>";
								}
								else if($i==1 && $j==1 ){
									
									echo "<td><input type='hidden' value='3' name='$Latter[$i]$j' ><span class='steering' id='$Latter[$i]$j'></span></td>";
								}
								else{
									echo "<td><input type='hidden' value='$SeatVal' id='input-$inputval' name='seat[$inputval]' ><span class='$cls' id='$inputval'></td>";
								}
								
							}
						echo "</tr>";	
					}
					?>
				</table>
			</div>
				<div class="col-md-3">
				<ul class="legends">
					<li><span class="steering"></span>&nbsp;Driver Seat</li>
					<li><span class="seat"></span>&nbsp;Seats</li>
					<li><span class="door"></span>&nbsp;Door</li>
				</ul>
			</div>

		</div>
	</div>
					<?php
				}
			 ?>



				<div class="clearfix"></div>
				<br>
			
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
  		$('table span').click(function(){
		var currentType = $(this).attr("class");
		var id=$(this).attr("id");
		if(currentType=="pos"){
			$(this).removeClass("pos");
			$(this).removeClass("door");
			$(this).addClass("seat");
			$('#input-'+id).val('1');
		}
		else if(currentType=="seat"){
			$(this).removeClass("seat");
			$(this).removeClass("pos");
			$(this).addClass("door");
			$('#input-'+id).val('2');
		}
		else{
			$(this).removeClass("seat");
			$(this).removeClass("door");
			$(this).addClass("pos");
			$('#input-'+id).val('0');
		}
	});
  });
</script>
@endsection