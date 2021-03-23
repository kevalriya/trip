<?php 
$ActiveSide='booking';
?>  
@extends('front.layouts.app')

@section('title','TripOn - Charge Password')

@section('main-content')



        <div class="container-fluid">
          <div class="gap"></div>
         </div>




        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                  @include('front.layouts.useraside')
                </div>
                <div class="col-md-9">
                    
                    <h3>Change Password</h3>
        
        <form class="form-horizontal" role="form" id="change_password_frm" method="post">
          {{ csrf_field() }}
     
          <div class="form-group">
            <label class="col-lg-3 control-label">Current Password:</label>
            <div class="col-lg-6">
              <input class="form-control" name="old_password" type="password" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">New Password:</label>
            <div class="col-lg-6">
              <input class="form-control" name="new_password" type="password" >
            </div>
          </div>
         
          <div class="form-group">
            <label class="col-lg-3 control-label">Confirm Password:</label>
            <div class="col-lg-6">
              <input class="form-control" name="confirm_password" type="password"  >
            </div>
          </div>
        
        
         
          
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-9">
              <input type="submit" class="btn btn-primary" value="Save Changes">
              <span></span>
            </div>
          </div>
        </form>
                       <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
    <br>
                </div>
            </div>
        </div>



        <div class="gap"></div>
       @endsection

@section('footerSection')  
            <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
    


         $(document).on('submit', "#change_password_frm", function(e) {

        e.preventDefault;
  
      $.ajax({

        url: "{{route('updatePassword')}}",
        type: 'POST',
        data: $("#change_password_frm").serialize(),
        dataType: 'json',
        success: function(data){
            
                if(data.success==1){
            
            $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();;
            $("#response .message").html('Password Change Success');
          
           $('#change_password_frm')[0].reset();
                }
                else{
                  $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
            $("#response .message").html(getError(data.errors));
                }
      }
 
        
        });
  
 return false;
   });
   });

  function getError(errors){
    var op='';
      for(var i=0;i < errors.length;i++){
        console.log(errors[i]);
        op+=errors[i] +'<br>';
      }
      return op;
   }
</script>
  

@endsection



