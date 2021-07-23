<?php 
$ActiveSide='booking';
?>  


<?php $__env->startSection('title','TripOn - Profile Setting'); ?>

<?php $__env->startSection('headSection'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/select2/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/datepicker/datepicker3.css')); ?>">
<style type="text/css">
  .select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 0;
    padding-right: 0;
    height: auto;
    margin-top: -4px;
}
.select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0;
    padding: 6px 12px;
    height: 34px;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>

 <div class="container-fluid">
           <div class="gap"></div>
        </div>




        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                   <?php echo $__env->make('front.layouts.useraside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-md-9">
                    <h3>Personal info</h3>
        
        <form  id="change_prfile" role="form">
               <?php echo e(csrf_field()); ?>

                             <input type="hidden" name="country" value="<?php echo e($Countries->COUNTRY_ID); ?>" id="country">

             <div class="form-group col-md-4">
                 
             
                   <select class="form-control select2" name="salutation"   data-placeholder="Select Salutation" aria-hidden="true">
                    <option value="">Select Salutation</option>
                    <?php $__currentLoopData = $Salutations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Salutation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($Salutation->SALUTATION_LABEL_ID); ?>" 
                          <?php if($Salutation->SALUTATION_LABEL_ID == $User->SALUTATION_ID): ?>
                        selected
                      <?php endif; ?>
                      ><?php echo e($Salutation->SALUTATION_LABEL_DESC); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
           
      </div>


                <div class="form-group col-md-4">
                
                  <input type="text" class="form-control"  value="<?php echo e($User->FIRSTNAME); ?>" placeholder="First Name" readonly="">
                </div>

                <div class="form-group col-md-4">
                 
                  <input type="text" class="form-control" name="middleName" value="<?php echo e($User->MIDDLENAME); ?>" placeholder="Middle Name" >
                </div>

                <div class="form-group col-md-4">
               
                  <input type="text" class="form-control"  value="<?php echo e($User->SURNAME); ?>" placeholder="Surname Name" readonly="">
                </div>

      <div class="form-group col-md-4">
                
                  <input type="text" class="form-control" name="phone" value="<?php echo e($User->PHONE_NUMBER1); ?>" placeholder="Phone No." >
                </div>

   <div class="form-group col-md-4">
                 
                  <input type="text" class="form-control" name="phone1" value="<?php echo e($User->PHONE_NUMBER2); ?>" placeholder="Phone No. 2" >
                </div>
   

   <div class="form-group col-md-4">
                
                  <input type="email" class="form-control"  value="<?php echo e($User->EMAIL_ADDRESS); ?>" placeholder="Email" readonly="">
                </div>

        <div class="form-group col-md-4" >
                
                  <select class="form-control select2" name="gender" value="<?php echo e(old('gender')); ?>" data-placeholder="Select a gender" id="gender" tabindex="-1" aria-hidden="true">
                        <option value="">Select Gender</option>
                        <option value="M"  <?php if($User->GENDER_FLAG == 'M'): ?>
                        selected
                      <?php endif; ?>>Male</option>
                        <option value="F"  <?php if($User->GENDER_FLAG == 'F'): ?>
                        selected
                      <?php endif; ?>>Female</option>
                  
                  </select>
                </div>

      
          
      
       <div class="form-group col-md-4">
                
                   <select class="form-control select2" name="state"   id="state" data-placeholder="Select State" aria-hidden="true">
                      <option value="">Select State </option>
                    <?php $__currentLoopData = $States; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $State): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($State->STATE_CODE); ?>" 
                      <?php if($State->STATE_CODE == $User->STATE_CODE): ?>
                        selected
                      <?php endif; ?>
                      ><?php echo e($State->NAME); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                      
    

         
       <div class="form-group col-md-4">
                 
                   <select class="form-control select2" name="lga" id="LGA"   data-placeholder="Select LGA" aria-hidden="true">
                      <option value="">Select LGA</option>
                    <?php $__currentLoopData = $LGAS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $LGA): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($LGA->HASC_CODE); ?>" 
                      <?php if($LGA->HASC_CODE == $User->LGA_HASC): ?>
                        selected
                      <?php endif; ?>
                      ><?php echo e($LGA->LGA_NAME); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
      

         <div class="form-group col-md-4">
                
                   <select class="form-control select2" name="city" id="city" data-placeholder="Select a City" aria-hidden="true">
                    <option value="">Select City</option>
                    <?php $__currentLoopData = $Cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $City): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($City->CITY_CODE); ?>" 
                        <?php if($City->CITY_CODE == $User->CITY): ?>
                        selected
                      <?php endif; ?>
                      ><?php echo e($City->CITY_NAME); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>


    


        
                <div class="form-group col-md-4">
                 
                  <input type="text" class="form-control datepicker" name="date_of_birth" placeholder="Date of birth" value="<?php echo e($User->DATE_OF_BIRTH); ?>" >
                </div>

         

       
      <div class="form-group col-md-6">
       <label>Address</label>
            <textarea class="form-control" name="address" rows="3"><?php echo e($User->ADDRESS_LINE_1); ?></textarea>
     
      </div>

          
              <div class="form-group col-md-4">
       <label>Image</label>
            <input type="file" name="image" value="<?php echo e(old('image')); ?>" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
     
      </div>  

       


        <div class="clearfix"></div>

              <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
                

        </form>
<div class="clearfix"></div>
                     <div id="response" class="alert alert-success" style="display:none;">
      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>
    </div>
    <div class="clearfix"></div>
    <br>
                </div>
            </div>
        </div>



        <div class="gap"></div>
 <?php $__env->stopSection(); ?>

<?php $__env->startSection('footerSection'); ?>   
     

<script src="<?php echo e(asset('admin/plugins/select2/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>

<script type="text/javascript">
      $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip(); 
    

         $(document).on('submit', "#change_prfile", function(e) {

        e.preventDefault;
  

        var getFormData = function(form) {
  var $inputs = $('input[type="file"]:not([disabled])', form)
  $inputs.each(function(_, input) {
    if (input.files.length > 0) return
    $(input).prop('disabled', true)
  })
  var formData = new FormData(form)
  $inputs.prop('disabled', false)
  return formData
}

var formData = getFormData($("#change_prfile")[0]);
      $.ajax({
        url: "<?php echo e(route('userprofile')); ?>",
        type: "POST",
        enctype: 'multipart/form-data',
        data : formData,
        processData: false,
        contentType: false,
        dataType: 'json',

        success: function(data){
            
                if(data.success==1){
            
                 $("#response").removeClass("alert-danger").addClass("alert-success").fadeIn();;
           $("#response .message").html('Update Success');
                }
                else{
                  $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
           $("#response .message").html(getError(data.errors));
                }
      },
        error: function(data){
          var d=data.responseJSON;

           $("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();;
           $("#response .message").html(getError(d.errors));
        }
 
        
        });
  
 return false;
   });
  $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
      autoclose: true,
    });
        $('.select2').select2({ width: '100%' });
        
     $(document).on('change', "#country", function(e) {
      e.preventDefault;
      $('#state').empty();
      $('#LGA').empty();
      $('#city').empty();
      getState();
  });

   $(document).on('change', "#state", function(e) {
      e.preventDefault;
    
      $('#LGA').empty();
      $('#city').empty();
      getLGA();
      getCity();
  }); 

  

  });

   function getState(){
      
   var country=$('#country').val();
  
    if(country != '')
      $.ajax({
        url: "<?php echo e(route('front.getState')); ?>",
        type: "POST",
        data : {id:country, _token: "<?php echo e(csrf_token()); ?>"},
       
        success: function(data){
        $('#state').empty();
        $('#state').html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    }

    function getLGA(){
      
    var country=$('#state :selected').val();
  
    if(country != '')
      $.ajax({
        url: "<?php echo e(route('front.getlga')); ?>",
        type: "POST",
        data : {id:country, _token: "<?php echo e(csrf_token()); ?>"},
       
        success: function(data){
        $('#LGA').empty();
        $('#LGA').html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    } 

    function getCity(){
      
    var country=$('#state :selected').val();
  
    if(country != '')
      $.ajax({
        url: "<?php echo e(route('front.getCity')); ?>",
        type: "POST",
        data : {id:country, _token: "<?php echo e(csrf_token()); ?>"},
       
        success: function(data){
        $('#city').empty();
        $('#city').html(data);
        
        },
        error: function(xhr, ajaxOptions, thrownError) {
           console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
      });
  
 
    }

  function getError(errors){
    var op='';
      for(var i=0;i < errors.length;i++){
        console.log(errors[i]);
        op+=errors[i] +'<br>';
      }
      return op;
   }
 
</script>
  

<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/trip/resources/views/front/user-profile-settings.blade.php ENDPATH**/ ?>