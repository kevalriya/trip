<?php 
$ActiveSide='fleet';
?> 
@extends('admin.layouts.app')

@section('title','Amenity Gallery')
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
    $ActiveSub="amenitie";
    ?>
@include('admin.layouts.fleetHeader')

    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Amenity</span>
    <span class="info-box-number"></span>
  </div>
  <!-- /.info-box-content -->
</div>

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Amenity</h3>
        <button class='col-md-2 pull-right btn btn-success add-amenitie' >Add Amenity</a>
     
      </div>
      <div class="box-body">
        <div class="box">
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th>Amenity Name</th>
                          <th>Description</th>
                        
                          <th>Action</th>
                        </tr>
                        </thead>
                            <tbody>
                        @foreach ($Amenities as $Amenitie)
                          <tr id="tr-{{$Amenitie->AMENITY_ID}}">
                        
                            <td class="aname">{{ $Amenitie->AMENITY_NAME }}</td>
                            <td class="ades">{{ $Amenitie->DESCRIPTION }}</td>
                             
                             <td><button class="btn btn-xs btn-info update-amenitie" data-id="{{$Amenitie->AMENITY_ID}}"> <span class="glyphicon glyphicon-edit"></span></button> 
                               <form id="delete-form-{{ $Amenitie->AMENITY_ID }}" method="post" action="{{ route('amenitie.destroy',$Amenitie->AMENITY_ID) }}" style="display: none">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                </form>
                                <button  class="btn btn-xs btn-danger"  onclick="
                                if(confirm('Are you sure, You Want to delete this?'))
                                    {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $Amenitie->AMENITY_ID }}').submit();
                                    }
                                    else{
                                      event.preventDefault();
                                    }" ><span class="glyphicon glyphicon-trash"></span></button>
                             </td>
                            
                          </tr>
                        @endforeach
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

        <div class="modal fade" id="create-amenitie">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Amenitie</h4>
              </div>
              <form method="post" id="amenitie_create_frm">
                 {{ csrf_field() }}
              <div class="modal-body">
                      <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
                
                        <div class="form-group">
                            <label>Amenitie Name</label>

                         <input type="text" class="form-control required" name="amenitieName" id="amenitieName">

                        </div>

        

                <div class="clearfix"> </div>


          <div class="form-group">
                            <label>Description</label>

                         <textarea  class="form-control" name="description" id="description" rows="2"></textarea>

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

        <div class="modal fade" id="update-amenitie-modal">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Amenitie</h4>
              </div>
              <form method="post" id="amenitie_update_frm">
                 {{ csrf_field() }}
              <div class="modal-body">
                      <div id="uresponse" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
                
                        <div class="form-group">
                            <label>Amenitie Name</label>


                           <input type="hidden" name="amenitieId" id="edit-parent-id"> 
                         <input type="text" class="form-control" name="amenitieName" id="edit-aname">

                        </div>

        

                <div class="clearfix"> </div>


          <div class="form-group">
                            <label>Description</label>

                         <textarea  class="form-control" name="description" id="edit-desc" rows="2"></textarea>

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

     

  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
   $(document).ready(function() {
     
        $('#dataTables').DataTable();
  
      $(document).on('click', ".update-amenitie", function(e) {

        e.preventDefault;
        var id=$(this).attr('data-id');
        var pname=$('#tr-'+id).find('.aname').text();
        var desc=$('#tr-'+id).find('.ades').text();
        
        $('#update-amenitie-modal').find('#edit-parent-id').val(id);
        $('#update-amenitie-modal').find('#edit-aname').val(pname);
        $('#update-amenitie-modal').find('#edit-desc').val(desc);
       
        $('#update-amenitie-modal').modal({ backdrop: 'static', keyboard: false });
       
       return false;
       });



   $(document).on('click', ".add-amenitie", function(e) {

        e.preventDefault;
 
      $('#create-amenitie').modal({ backdrop: 'static', keyboard: false });
       return false;
      });
       
        $(document).on('submit', "#amenitie_create_frm", function(e) {

        e.preventDefault;
       var errorCounter = validateForm();

    if (errorCounter > 0) {
      
        $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();
        $("#response .message").html("<strong>Error</strong>: Please Fill Required Fields");
       
    }

    else{
     
  
      $.ajax({

        url: "{{route('addAmenitie')}}",
        type: 'POST',
        data: $("#amenitie_create_frm").serialize(),
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
         



        $(document).on('submit', "#amenitie_update_frm", function(e) {

        e.preventDefault;
    
      $.ajax({

        url: "{{route('editAmenitie')}}",
        type: 'POST',
        data: $("#amenitie_update_frm").serialize(),
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


</script>
@endsection