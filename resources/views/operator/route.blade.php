<?php 
$ActiveSide='route';
?>  
@extends('operator.layouts.app')

@section('title','Routes')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->


  <!-- Main content -->
  <section class="content">

    <?php
    $ActiveSub="route";
    ?>
@include('operator.layouts.routeHeader')

    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-number">Routes</span>
    @foreach ($data as $i)
        <span id="tabInfo" data-id="{{$i->id}}" readonly>{{$i->description}}</span>
        @endforeach
  </div>
  <!-- /.info-box-content -->
</div>

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Routes</h3>
        <button class='col-md-2 pull-right btn btn-success add-route' >Add Route</a>
     
      </div>
      <div class="box-body">
        <div class="box">
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th>Route Name</th>
                          <th>Origin City</th>
                          <th>Destination City</th>
                          <th>Distance</th>
                          <th>Travel Time</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
                      
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->


  </section>

        <div class="modal fade" id="create-route">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Route</h4>
              </div>
              <form method="post" id="route_create_frm">
                 {{ csrf_field() }}
              <div class="modal-body">
                      <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
                
                        <div class="form-group col-md-6">
                            <label>Route Name</label>

                         <input type="text" class="form-control required" name="routeName" id="routeName">

                        </div>


                <div class="clearfix"> </div>


       <div class="form-group col-md-6">
                  <label for="name">Origin State</label>
                   <select class="form-control state" data-cls="ocity" id="ostate" name="ostate"  data-placeholder="Select State" aria-hidden="true">
                      <option value="">Select State</option>
              

                   @foreach ($States as $State)
                    <option value="{{ $State->STATE_CODE }}">{{ $State->NAME }}</option>
                    @endforeach
                  </select>
                </div>


                  <div class="form-group col-md-6">
                   <label> Origin City </label>
                   <select class="form-control ocity required" name="orcity" id="orcity"  data-placeholder="Select a City" aria-hidden="true">
                    <option value="">Select Origin</option>
               
                  </select>
                </div>
<div class="clearfix"></div>


       <div class="form-group col-md-6">
                  <label for="name">Destination State</label>
                   <select class="form-control state" data-cls="dcity"  id="dstate" data-placeholder="Select State" aria-hidden="true">
                      <option value="">Select State</option>
              

                   @foreach ($States as $State)
                    <option value="{{ $State->STATE_CODE }}">{{ $State->NAME }}</option>
                    @endforeach
                  </select>
                </div>

                  <div class="form-group col-md-6">
                  <label>Destination City</label>
                   <select class="form-control dcity required" name="descity" id="descity"  data-placeholder="Select a City" aria-hidden="true">
                    <option value="">Select Destination</option>
                    
                  </select>
                </div>

           
                  <div class="clearfix"> </div>
      
              </div>
              <div class="clearfix"> </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
                </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div> 

         <div class="modal fade" id="update-route">
          <div class="modal-dialog">
            <div class="modal-content">
             
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
   $(document).ready(function() {
     
      
    
    $('#dataTables').DataTable({
        processing: true,
        serverSide: true,
         responsive: true,
            "ajax":{
                     "url": "{{ route('oproutesData') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },

        columns: [
            {data: 'route_name', name: 'route_name'},
            {data: 'origin_city', name: 'origin_city'},
            {data: 'dest_city', name: 'dest_city'},
            {data: 'distance', name: 'distance'},
            {data: 'travel_time', name: 'travel_time'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

        $(document).on('click', ".update-route-name", function(e) {

        e.preventDefault;
        
      
        $('#update-route').find('.modal-content').empty();
        var route=$(this).attr('data-id');
        var url="routedetail/"+route;
      
       $('#update-route').find('.modal-content').load(url,function(){
        $('#update-route').modal({ backdrop: 'static', keyboard: false });
       
     
    });
       return false;
       });


   $(document).on('click', ".add-route", function(e) {

        e.preventDefault;
 
      $('#create-route').modal({ backdrop: 'static', keyboard: false });
       return false;
      });
       
        $(document).on('submit', "#route_create_frm", function(e) {

        e.preventDefault;
       var errorCounter = validateForm();

    if (errorCounter > 0) {
      
        $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();
        $("#response .message").html("<strong>Error</strong>: Please Fill Required Fields");
       
    }

    else{
     
     var from=$('#orcity :selected').text();
     var to=$('#descity :selected').text();
    var ostate = $('#ostate :selected').text();
    var dstate = $('#dstate :selected').text();
      $.ajax({

        url: "{{route('opaddRoute')}}",
        type: 'POST',
        data: $("#route_create_frm").serialize()+'&from='+from+'&to='+to+'&ostate='+ostate+'&dstate='+dstate,
        dataType: 'json',
        success: function(data){
           
                if(data.success == 1){
            
                 $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();
           $("#response .message").html('add success');
          location.reload();
           
                }
                else{
                  $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();

           $("#response .message").html(getError(data.errors));
                }
      }
 
        
        });
    }
 return false;
   }); 
         

   $(document).on('change', ".state", function(e) {
      e.preventDefault;
      var cls=$(this).attr('data-cls');
      var id =$(this).attr('id');
      $('.'+cls).empty();
      getCity(id,cls);
  }); 


        $(document).on('submit', "#route_update_frm", function(e) {

        e.preventDefault;
      var from=$('#uorcity :selected').text();
     var to=$('#udescity :selected').text();
    var ostate = $('#uostate :selected').text();
    var dstate = $('#udstate :selected').text();

      $.ajax({

        url: "{{route('opeditRoute')}}",
        type: 'POST',
        data: $("#route_update_frm").serialize()+'&from='+from+'&to='+to+'&ostate='+ostate+'&dstate='+dstate,
        dataType: 'json',
        success: function(data){
          
                if(data.success == 1){
            
                 $("#uresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
           $("#uresponse .message").html('update');
           $('#update-route').modal('hide');
           location.reload();
                }
                else{
                  $("#uresponse").removeClass("alert-success").addClass("alert-danger").fadeIn();

           $("#uresponse .message").html(getError(data.errors));
                }
      }
 
        
        });
   
 return false;
   }); 
    
    });

  function getError(errors){
    var op='';
      for(var i=0;i < errors.length;i++){
        op+=errors[i] +'<br>';
      }
      return op;
   }

     function getCity(id,dsid){
      
    var country=$('#'+id+' :selected').val();
  
    if(country != '')
      $.ajax({
        url: "{{route('front.getCity')}}",
        type: "POST",
        data : {id:country, _token: "{{csrf_token()}}"},
       
        success: function(data){
          console.log(dsid);
        $('.'+dsid).empty();
       $('.'+dsid).html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    }
</script>
@endsection