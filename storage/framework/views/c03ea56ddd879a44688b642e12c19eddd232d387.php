<?php 
$ActiveSide='dashboard';
?>  

<?php $__env->startSection('title', 'Admin Dashboard'.' - '.config('app.name')); ?>
<?php $__env->startSection('headSection'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/datatables/dataTables.bootstrap.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
        Dashboard
        <small>Tripon</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

     <section class="content">
      <!-- Info boxes -->
      <div class="row">
   
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-bus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Fleet</span>
              <span class="info-box-number"><?php echo e($totalFleet[0]->total); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-list" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Booking</span>
              
                <?php $__currentLoopData = $totalBooking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($booking->STATUS); ?> - <strong> <?php echo e($booking->total); ?></strong></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  <div class="row">
    <div class="col-md-12">
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Recent Booking</h3>


         

              <div class="box-tools pull-right">
              
              
                <div class="btn-group">
                  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-cog"></i> Update Status</button>
                  <ul class="dropdown-menu" role="menu">
                       <li class="update_booking_status" data-value="PAYMENT PENDING" <?php echo e(($Booking->STATUS == 'PAYMENT PENDING' ) ? 'selected' : ''); ?>><a href="#">Payment Pending</a></li>

              <li class="update_booking_status" data-value="CANCELED BY HOST" <?php echo e(($Booking->STATUS == 'CANCELED BY HOST' || $Booking->STATUS == 'CANCELED BY TRAVELER' ) ? 'selected' : ''); ?>><a href="#">Cancel</a></li>

              <li class="update_booking_status" data-value="DECLINED" <?php echo e(($Booking->STATUS == 'DECLINED' ) ? 'selected' : ''); ?>><a href="#">Declined</a></li>

              <li class="update_booking_status" data-value="PAID" <?php echo e(($Booking->STATUS == 'PAID' ) ? 'selected' : ''); ?>><a href="#">Paid</a></li>

              <li class="update_booking_status" data-value="COMPLETED" <?php echo e(($Booking->STATUS == 'COMPLETED' ) ? 'selected' : ''); ?>><a href="#">Completed</a></li>      

                  </ul>
                </div>

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


              <div class="table-responsive">
                
                <table id="dataTables" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                         
                          <th><input type="checkbox" class="all_bookingchk" ></th>
                          <th>Booking ID</th>
                          <th>Processed Date</th>
                          <th>Fleet</th>
                          <th>Trip</th>
                          <th>Route</th>
                          <th>Boarding</th>
                          <th>Drop Off</th>
                          <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                        </tbody>
                      
                      </table>
              </div>
              <!-- /.table-responsive -->
            </div>
           
            <!-- /.box-footer -->
          </div>  
      </div> 
    </div>
      <!-- /.row -->
    </section>



 
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerSection'); ?>
<script src="<?php echo e(asset('admin/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script>
   $(document).ready(function() {
      
      getBooking();

     $(document).on('click', ".update_booking_status", function(e) {
       
    var status=$(this).attr('data-value');

     var booking = []; 
   $("input:checkbox[name=bookingstatus]:checked").each(function(){
    booking.push($(this).val());
    });

   
    if(booking.length <= 0)  
    {  
      mytoastr("error","Please select at least one booking.");  
      return false;
    } 
   

      $.ajax({

         url: '<?php echo e(route("opupdatemultistatus")); ?>',
        type: 'POST',
        data : {status:status,booking:booking,_token: "<?php echo e(csrf_token()); ?>"},
        dataType: 'json',
        success: function(data){
            
         if(data.success == 1){
          mytoastr('success','Status Update Success');
          $(".all_bookingchk").prop('checked',false);
          getBooking();
           }
           else{
           
               mytoastr("error","Error in update status");  
                }
      },
      error: function(xhr, ajaxOptions, thrownError) {
              mytoastr("error","Error in update status");  
        }
 
        
        });

      }); 

function getBooking() {

       $('#dataTables').DataTable().destroy();

       $('#dataTables').DataTable({
        processing: true,
        serverSide: true,
         responsive: true,
        "paging":   false,
         "bInfo" : false,
            "ajax":{
                     "url": "<?php echo e(route('opgetbooking')); ?>",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                   },
        columns: [
            {data: 'check', name: 'check', orderable: false, searchable: false},
            {data: 'booking', name: 'booking'},
            {data: 'processed_date', name: 'processed_date', "visible": false,},
            {data: 'fleet', name: 'fleet'},
            {data: 'trip', name: 'trip'},
            {data: 'route', name: 'route'},
            {data: 'boarding', name: 'boarding'},
            {data: 'drop_off', name: 'drop_off'},
            {data: 'status', name: 'status'},
        ]
    });
    
}

   $(document).on('click','.all_bookingchk', function(e) { 
    e.preventDefault;
   
  
  if($(this).is(':checked',true))  
  {
    $(".booking_chk").prop('checked', true);  
  }  
  else  
  {  
    $(".booking_chk").prop('checked',false);  
  }  
});
    
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('operator.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/trip/resources/views/operator/home.blade.php ENDPATH**/ ?>