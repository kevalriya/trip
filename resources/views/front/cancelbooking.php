<?php


  include_once('Lsession.php');
    
 $pagetitle="TripOn - Booking "; 
   
    include_once('lib/header.php'); ?>
<style type="text/css">
    div#booking_table_paginate,#booking_table_filter{
        float: right;
    }
</style>

        <div class="container">
            <h1 class="page-title">Hi <?php echo $usernum ?> <small>Canceled Booking</small> </h1>
            
        </div>




        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <aside class="user-profile-sidebar">
                        <div class="user-profile-avatar text-center">
                            <img src="img/amaze_300x300.jpg" alt="Image Alternative text" title="AMaze" />
                            <h5><?php echo $usernum ?></h5>
                        
                        </div>
                        <ul class="list user-profile-nav">
                             <li><a href="user-profile-booking-history.php"><i class="fa fa-clock-o"></i>Booking History</a></li>

                              <li><a href="cancelbooking.php"><i class="fa fa-clock-o"></i>Cancel Booking</a>
                            </li>

                            <li><a href="user-profile-settings.php"><i class="fa fa-cog"></i>Profile Settings</a>
                            </li> 
                           <li><a href="change-password.php"><i class="fa fa-lock"></i>Change Password</a>
                            </li>
                           
                           
                            
                        </ul>
                    </aside>
                </div>
                <div class="col-md-9">
                   
                    <table class="table table-bordered table-striped table-booking-history" id="booking_table">
                        <thead>
                            <tr>
                                
                                <th>Title</th>
                                <th>Date</th>
                                <th>Cost</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="gap"></div>
        <?php include_once 'lib/footer.php'; ?>

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

  var dataTable = $('#booking_table').DataTable({
   "processing" : true,
   "serverSide" : true,
  
   responsive: true,
    "searching": true,
   
   "bSortable": false ,
   "bInfo" : false,
   "ajax" : {
   url:"cpresponse.php",
    type:"POST",
  
    data:{

     action:'CancelBookingHistory'
    }
   }
  });
 }
</script>
  

</body>

</html>



