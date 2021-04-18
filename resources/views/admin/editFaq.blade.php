<?php 
$ActiveSide='faq';
?> 	
@extends('admin.layouts.app')

@section('title','Edit FAQ')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/dist/css/info.css') }}">
@endsection
@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">


	  <!-- Main content -->
	  <section class="content">
   
	  	<div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
	  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
	  <div class="info-box-content">
	    <span class="info-box-number">Edit FAQ</span>
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
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">FAQ</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('updatefaq',$Faq->ID) }}" method="post"  enctype="multipart/form-data" id="insert_faq_frm">
	          {{ csrf_field() }}
	          {{ method_field('PUT') }}
	            <div class="box-body">
	            
	         

	    
   		 <div class="form-group col-md-8">
	                <label for="name">Question</label>
	           
	      <input type="text" class="form-control" name="question" value="{{$Faq->QUE}}"  placeholder="Question" >      
	         
	    </div>
    	
    	 <div class="clearfix"></div>
   		
	    <div class="form-group col-md-8">
       <label>Answer</label>
       <input type="hidden" name="answer" value="{{$Faq->ANS}}" id="answer">
      <textarea class="textarea" id="ans"  placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$Faq->ANS}}</textarea>
    	</div>

				<div class="clearfix"></div>

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
<script src="{{ asset('admin/dist/js/info.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

<script>
	updateInformation("{{route('trip.tabInfo')}}", '{{csrf_token()}}');
  $(document).ready(function() {
  	$('.textarea').wysihtml5();

  	$("#insert_faq_frm").submit(function() {
   // Retrieve the HTML from the plugin
   var html = $('#ans').val();
   // Put this in the hidden field
   $("#answer").val(html);
  });

  });
</script>
@endsection