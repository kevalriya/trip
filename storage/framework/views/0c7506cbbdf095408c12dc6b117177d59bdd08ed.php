<?php 
$ActiveSide='booking';
?>  


<?php $__env->startSection('title','TripOn - Booking History'); ?>

<?php $__env->startSection('main-content'); ?>



<style type="text/css">
    div#booking_table_paginate,#booking_table_filter{
        float: right;
    }

</style>

        <div class="container-fluid">
           <div class="gap"></div>
        </div>




        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                   <?php echo $__env->make('front.layouts.useraside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-md-9">
                   
                    <table class="table table-bordered table-striped table-booking-history" id="booking_table">
                        <thead>
                            <tr>
                                
                          <th>Booking ID</th>
                          <th>Fleet</th>
                          <th>Trip</th>
                          <th>Route</th>
                          <th>Boarding</th>
                          <th>Drop Off</th>
                          <th>Status</th>
                          <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="gap"></div>
      
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerSection'); ?>    

            <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip(); 
     fetch_data();



    $(document).on('click', ".cancel-booking", function(e) {
      e.preventDefault;
         var t=this;

        var id=$(this).attr('data-id');
        var uid=$(this).attr('data-uid');
            $.ajax({
                url: 'cpresponse.php',
                data: {action:'cancelBooking',uid:uid,id:id},
                type: 'POST',
                dataType: 'json',
                success: function(response){
                

                },
                error: function(e){
                  alert('Error processing your request: '+e.responseText);
                }
              });
          

   });

   });

 function fetch_data()
 {

    $('#booking_table').DataTable({
        processing: true,
        serverSide: true,
         responsive: true,
      
            "ajax":{
                     "url": "<?php echo e(route('bookingData')); ?>",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                   },
        columns: [
            {data: 'booking', name: 'booking'},
            {data: 'fleet', name: 'fleet'},
            {data: 'trip', name: 'trip'},
            {data: 'route', name: 'route'},
            {data: 'boarding', name: 'boarding'},
            {data: 'drop_off', name: 'drop_off'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });


 }
 
</script>
  
<?php $__env->stopSection(); ?>





<?php echo $__env->make('front.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/trip/resources/views/front/user-profile-booking-history.blade.php ENDPATH**/ ?>