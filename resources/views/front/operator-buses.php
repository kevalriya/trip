<?php 
ob_start();
session_start();
 
 require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DB= new DB_Functions();

 $pagetitle="TripOn - Operator Buses"; 
    
  include_once('lib/header.php'); 
       $operator=urlencode($_GET['op']);
		$operatorBuses=$DB->operatorBuses($operator);
		$getSlidesOp=$DB->getSlidesOp();
		
	   ?>


        <div class="container">
            <h1 class="page-title">Search for Buses</h1>
        </div>


        <div class="container">
            <div class="row">
              
                <div class="col-md-12">
                    <h3 class="mb20">Popular Bus Operators</h3>
                    <div class="row row-wrap">
					<?php 
					if(count($operatorBuses)){
                         $today=date('Y-m-d');
						foreach($operatorBuses as $Bus){
						$Info=$getSlidesOp[$Bus['id']];
						
						
					?>

                        <div class="col-md-4">
                            <div class="thumb">
                                <a class="hover-img" href="search-results.php?from=<?php echo $Bus['fromtxt'] ?>&fromid=<?php echo $Bus['from_location_id'] ?>&to=<?php echo $Bus['totxt'] ?>&toid=<?php echo $Bus['to_location_id'] ?>&start=<?php echo $today ?>&end=<?php echo $today ?>&passengers=1&isreturn=F">
                                    <img src="img/196_365_800x600.jpg" alt="Image Alternative text" title="196_365" />
                                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                                        <div class="text-small">
                                            <h5><?php echo $Bus['fromtxt'] .' To '.$Bus['totxt'] ?></h5>
                                            
                                            <p class="mb0">from  ₦<?php echo $Info['minprice'] ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
					<?php } 
					}
					?>
                      
                      
                    </div>
                    <div class="gap"></div>
                </div>
            </div>
        </div>


         <?php 
   
   include_once('lib/footer.php') ?>
</body>

</html>



