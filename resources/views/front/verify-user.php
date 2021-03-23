<?php
ob_start();
@session_start();
if(empty($_GET['user'])) {
    header('location:index.php');
    die();
}

if(isset($_SESSION['userId'])){
	header('location:index.php');
     die();
}
require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DBUSER= new DB_Functions();
require_once CLASSPATH.'Encryption.php';
$userid=urlencode($_GET['user']);
$user=Encryption::decode($userid);
	
   if($DBUSER->isverifyUser($user)){
      
    $msg= 'User already verify <a href="login-register.php">here</a>';
   
    } 
	else if($DBUSER->verifyUser($user)){
		$msg="Verify Success Please Login <a href='login-register.php'>here</a>";
	}
	else{
		$msg="Something Went Wrong";
	}
	


$pagetitle="TripOn - Booking "; 

    include_once('lib/header.php'); ?>
	
	
	<br> 
	<br> 
	<br> 
	<br> 
	<center>
		<?php 
		
			if(isset($msg)){
				echo $msg;
			}
		?>
	</center>
	</div>
	
	</body>

</html>
