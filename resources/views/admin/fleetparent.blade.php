<?php 
$ActiveSide='fleet';
?>  
@extends('admin.layouts.app')

@section('title','Fleet Parent Type')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">
    <?php
    $ActiveSub="fleetparent";
    ?>
@include('admin.layouts.fleetHeader')
    <div class="info-box">
  <!-- Apply any bg-* class to to the icon to color it -->
  <span class="info-box-icon bg-blue"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">Fleet Parent Type</span>
    <span class="info-box-number"></span>
  </div>
  <!-- /.info-box-content -->
</div>
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Fleet Parent Type</h3>
        <button class='col-md-2 pull-right btn btn-success add-parent-type' >Add New</a>
     
      </div>
      <div class="box-body">
        <div class="box">
                    
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th>Type Name</th>
                          <th>Description</th>
                          <th>Action</th>
                         
                        </tr>
                        </thead>
                        <tbody>
                         @foreach ($parentTypes as $Type)
                          <tr id="tr-{{$Type->PARENT_TYPE_CODE}}">
                           
                            <td class="pname">{{ $Type->PARENT_TYPE_NAME }}</td>
                            <td class="pdes">{{ $Type->DESCRIPTION }}</td>
                            <td><button class="btn btn-xs btn-info update-fleet-parent" data-id="{{$Type->PARENT_TYPE_CODE}}"> <span class="glyphicon glyphicon-edit"></span></button>
                               <form id="delete-form-{{ $Type->PARENT_TYPE_CODE }}" method="post" action="{{ route('fleetparent.destroy',$Type->PARENT_TYPE_CODE) }}" style="display: none">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                </form>
                                <button  class="btn btn-xs btn-danger"  onclick="
                                if(confirm('Are you sure, You Want to delete this?'))
                                    {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $Type->PARENT_TYPE_CODE }}').submit();
                                    }
                                    else{
                                      event.preventDefault();
                                    }" ><span class="glyphicon glyphicon-trash"></span></button>
                            </td>
                              
                            </tr>
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

    
     <div class="modal fade" id="create-ptype">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Type</h4>
              </div>
              <form method="post" id="ptype_create_frm">
                 {{ csrf_field() }}
              <div class="modal-body">
                      <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
                
                        <div class="form-group">
                            <label>Parent Type Name</label>

                         <input type="text" class="form-control required" name="parent_type_name" id="name">

                        </div>

       

                  <div class="form-group">
                   <label> Description </label>
                   <textarea class="form-control" name="description" rows="3"></textarea>
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
 
        </div> 

            <div class="modal fade" id="update-ptype">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Type</h4>
              </div>
              <form method="post" id="ptype_update_frm">
                 {{ csrf_field() }}
              <div class="modal-body">
                      <div id="uresponse" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
                


                        <div class="form-group">
                            <label>Parent Type Name</label>
                           <input type="hidden" name="parent_id" id="edit-parent-id"> 
                         <input type="text" class="form-control" name="parent_type_name" id="edit-pname">

                        </div>

       

                  <div class="form-group">
                   <label> Description </label>
                   <textarea class="form-control" name="description" id="edit-desc" rows="3"></textarea>
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
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
   $(document).ready(function() {
     
  

        $(document).on('click', ".update-fleet-parent", function(e) {

        e.preventDefault;
        var id=$(this).attr('data-id');
        var pname=$('#tr-'+id).find('.pname').text();
        var desc=$('#tr-'+id).find('.pdes').text();
        
        $('#update-ptype').find('#edit-parent-id').val(id);
        $('#update-ptype').find('#edit-pname').val(pname);
        $('#update-ptype').find('#edit-desc').val(desc);
       
        $('#update-ptype').modal({ backdrop: 'static', keyboard: false });
       
       return false;
       });


   $(document).on('click', ".add-parent-type", function(e) {

        e.preventDefault;
 
      $('#create-ptype').modal({ backdrop: 'static', keyboard: false });
       return false;
      });
       
        $(document).on('submit', "#ptype_create_frm", function(e) {

        e.preventDefault;
       var errorCounter = validateForm();

    if (errorCounter > 0) {
      
        $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();
        $("#response .message").html("<strong>Error</strong>: Please Fill Required Fields");
       
    }

    else{
     
      $.ajax({

        url: "{{route('addFleetParent')}}",
        type: 'POST',
        data: $("#ptype_create_frm").serialize(),
        dataType: 'json',
        success: function(data){
            console.log(data.errors);
                if(data.success == 1){
            
                 $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();
           $("#response .message").html('success');
           $('#create-ptype').modal('hide');
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
          
        $(document).on('submit', "#ptype_update_frm", function(e) {

        e.preventDefault;
    
      $.ajax({

        url: "{{route('editFleetParent')}}",
        type: 'POST',
        data: $("#ptype_update_frm").serialize(),
        dataType: 'json',
        success: function(data){
            console.log(data.errors);
                if(data.success == 1){
            
                 $("#uresponse").removeClass("alert-danger").addClass("alert-success").fadeIn();
           $("#uresponse .message").html('update success');
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