<?php

ob_start();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DBUSER= new DB_Functions();

$action = isset($_POST['action']) ? $_POST['action'] : "";
	
if($action == 'getFromCity'){
		if(empty($_POST['search'])){
			$Result=array();
		}
		else{
			
		
		 $keyword=escape_string($_POST['search']);
		$Result=$DBUSER->getFromCity($keyword);
			
		}
		
		echo json_encode($Result);
		die();
 }
 
 	
if($action == 'getToCity'){
		if(empty($_POST['search'])){
		$Result=array();
		}
		else{
		$keyword=escape_string($_POST['search']);
		$Result=$DBUSER->getToCity($keyword);
		
		}
			echo json_encode($Result);
		die();
		
 }
 
  	
if($action == 'resetPass'){
	if(empty($_POST['email'])){
		$response["status"] = 'error';
    $response["msg"] = "Please Enter Email";
    echo json_encode($response);
    die();
	}

	$email=escape_string($_POST['email']);
	$email=strtolower($email);
	$response=array();
	if($DBUSER->isUserExisted($email)){

   $userid=$email;
   require_once CLASSPATH.'Encryption.php';
  $userenc=Encryption::encode($userid);
   $hourz= strtotime('+2 hour');
   $hour=Encryption::encode($hourz);

  $url=ROOTURL.'reset-pass.php?user='.$userenc.'&t='.$hour;
  
  $body             = file_get_contents('lib/forget-temp.php');
  $body             = str_replace('{username}',$email, $body);
  $body             = str_replace('{url}',$url, $body);
  

		$DBUSER->SendMail($email,'Reset Password Request',$body);
		$response["status"] = 'success';
    $response["msg"] = "Reset link has been sent to your registered email address";
    echo json_encode($response);
    die();
	}
	else{

	$response["status"] = 'error';
    $response["msg"] = "Email Not Found";
    echo json_encode($response);
    die();
	}

 }
 
 	 	
if($action == 'bookbus'){

	$fname=$_POST['fname'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
 	if(!isset($_SESSION['userId'])){
	if($_POST['regcheck'] == 'F' ){
	$response["status"] = 'error';
    $response["msg"] = "Please Check Create Traveler account ";
    echo json_encode($response);
    die();
	}	
	
	else if($DBUSER->isUserExisted($email) ){
			$response["status"] = 'error';
    $response["msg"] = "Email Already register Please Login Please Login first ";
    echo json_encode($response);
    die();
	}
	
	$User=$DBUSER->addBookingUser($fname, $email,$phone);
	if($User['status'] === true){
		$UserId=$User['uer_id'];
	}
	else{
		$response["status"] = 'error';
    $response["msg"] = "Error In Create New User";
    echo json_encode($response);
    die();
	}
	
	}
	else{
		@$UserId=$_SESSION['userId'];
	} 

   $passengertotal=$_POST['passengertotal'];
   $passenger=$_POST['passenger'];
   $name=$_POST['name'];
   $surname=$_POST['surname'];
   $age=$_POST['age'];
   $pickup_id = $_POST['pickup_id'];
	$return_id = $_POST['return_id'];
	@$ticket_id = $_POST['ticket_id'];
	$seatno = $_POST['seatno'];
	$seatid = $_POST['seatid'];
	$bus_id = $_POST['bus_id'];
	$ticket_id = $_POST['ticket_id'];
    $startdate=$_POST['startdate']; 
	$enddate=$_POST['enddate']; 
	$routetxt=$_POST['routetxt'];
	$route_id=$_POST['route_id'];
	$isback=$_POST['isback'];
	$startBoard=$_POST['startBoard'];
	$endBoard=$_POST['endBoard'];
	$PayMethod=$_POST['PayMethod'];
	$Bstatus='pending';
	
   

   $subtotal=$_POST['ftotalval'];
   $tax=10*$passengertotal;
   $total=$subtotal+$tax;
   
    if($isback=='Y'){
		  $RTpassengertotal=$_POST['return_passengertotal'];
   $RTpassenger=$_POST['return_passenger'];
   $RTname=$_POST['return_name'];
   $RTsurname=$_POST['return_surname'];
   $RTage=$_POST['return_age'];
   $RTpickup_id = $_POST['return_pickup_id'];
	$RTreturn_id = $_POST['return_return_id'];
	$RTticket_id = $_POST['return_ticket_id'];
	$RTseatno = $_POST['return_seatno'];
	$RTseatid = $_POST['return_seatid'];
	$RTbus_id = $_POST['return_bus_id'];
	$RTticket_id = $_POST['return_ticket_id'];
    $RTstartdate=$_POST['return_startdate']; 
	$RTenddate=$_POST['return_enddate']; 
	$RTroutetxt=$_POST['return_routetxt'];
	$RTroute_id=$_POST['return_route_id'];
	$RTstartBoard=$_POST['return_startBoard'];
	$RTendBoard=$_POST['return_endBoard'];
	
  
   $RTsubtotal=$_POST['ltotalval'];;
   $RTtax=10*$RTpassengertotal;
   $RTtotal=$RTsubtotal+$RTtax;
		
	}
	
$addBooking=$DBUSER->addBooking($UserId,$passenger,$seatno,$seatid,$name,$surname,$age,$bus_id,$pickup_id,$return_id,$startdate,$routetxt,$enddate,$subtotal,$tax,$total,$route_id,$ticket_id,$startBoard,$endBoard,$PayMethod,$Bstatus,$fname,$email);

	if($isback=='Y'){
	$uuid=$addBooking['uuid'];
$addReturnBooking=	$DBUSER->addReturnBooking($UserId,$RTpassenger,$RTseatno,$RTseatid,$RTname,$RTsurname,$RTage,$RTbus_id,$RTpickup_id,$RTreturn_id,$RTstartdate,$RTroutetxt,$RTenddate,$RTsubtotal,$RTtax,$RTtotal,$RTroute_id,$RTticket_id,$RTstartBoard,$RTendBoard,$PayMethod,$Bstatus,$fname,$email,$uuid);	
	$RUid=$addReturnBooking['uuid'];
	}
	else{
	 $addReturnBooking=array('status'=>true);
	 $RUid=$addBooking['uuid'];
	}

	if($addBooking['status'] === true && $addReturnBooking['status'] === true){
	$response["status"] = 'success';
    $response["msg"] = "Booking Success";
    $response["uid"] = $RUid;
	
    echo json_encode($response);
    die();
	}
	else{
	$response["status"] = 'error';
    $response["msg"] = "Error In Booking";
    echo json_encode($response);
    die();
	}
 }
 
 
 if($action == 'changePass')
 {
 	$email=escape_string($_POST['email']);
 	$email=strtolower($email);
	$newpass=$_POST['newpass'];
	$confpass=$_POST['confpass'];
	if(strlen($newpass) < 6){
			$response["status"] = 'error';
    $response["msg"] = "Password must be of minimum 6 characters length";
    echo json_encode($response);
    die();
	}

	else if($newpass != $confpass){
		$response["status"] = 'error';
    $response["msg"] = "Password Not Match";
    echo json_encode($response);
    die();
	}

	if($DBUSER->resetPassword($email,$newpass)) {
			$response["status"] = 'success';
    $response["msg"] = "Password Change Success";
    echo json_encode($response);
    die();
	}
	else{
			$response["status"] = 'error';
    $response["msg"] = "Something Worng To change password";
    echo json_encode($response);
    die();
	}
 
 }

 if($action == 'routeRating'){
 	if(empty($_SESSION['userId'])){
 		die('fail');
 	}	
 	if(empty($_POST['route'])){
 		die('fail');
 	}
 	$rating=escape_string($_POST['rating']);
 	$review=escape_string($_POST['review']);
 	$route=escape_string($_POST['route']);
 	$UserId=$_SESSION['userId'];
 	$rating=($rating > 5) ? 5 : $rating;
  	$addRating=$DBUSER->addRouteRating($route,$rating,$review,$UserId);
 	if($addRating===true){
 		echo "success";
 	}
 	else{
 		echo "fail";
 	}
 }
 	

 	if($action == 'usersBookingHistory')
{
	@ session_start();
    if (empty($_SESSION['userId'])){
    	die('Please Login');
    }  
     $start= $_POST['start'];
     $end=$_POST['length'];
     
     @$search=$_POST['search']['value'];
      $userId=$_SESSION['userId'];
     
     $Bookings= $DBUSER->bookingHistory($search,$userId,$start,$end);

         $data=array();
         $BookendTime=strtotime('-2 hour');
         foreach($Bookings['data'] as $Booking)
         {
          
         $arrDate=strtotime($Booking['booking_datetime']);

         if($arrDate > $BookendTime){
         	
         	$cancelBtn='<button class="btn btn-default btn-sm cancel-booking"  title="Cancel" data-toggle="tooltip" data-uid="'.$Booking['uuid'].'" data-id="'.$Booking['id'].'">Cancel </button>';
         }
         else{
         	$cancelBtn='';
         }
        
             $sub_array = array();
            
             $sub_array[] = $Booking['booking_route'] ;
             $sub_array[] = date("F j, Y, g:i a",strtotime($Booking['booking_datetime']));
             $sub_array[] = $Booking['total'] ;
             $sub_array[] = $Booking['payment_method'] ;
             $sub_array[] = $Booking['status'] ;
             $sub_array[] = $cancelBtn ;
             
             $data[] = $sub_array;
           
         }

       
             
    $output = array(
             "draw"    => intval($_POST['draw']),
             "recordsTotal"  => count($Bookings['data']),
             "recordsFiltered" =>  $Bookings['cTotal'],
             "data"    => $data,
             
            
            );

        echo json_encode($output);
    die();
}
 	if($action == 'CancelBookingHistory')
{
	
    if (empty($_SESSION['userId'])){
    	die('Please Login');
    }  
     $start= $_POST['start'];
     $end=$_POST['length'];
     
     @$search=$_POST['search']['value'];
      $userId=$_SESSION['userId'];
     

     $Bookings= $DBUSER->bookingHistory($search,$userId,$start,$end,1);

         $data=array();
         foreach($Bookings['data'] as $Booking)
         {
          
      
             $sub_array = array();
            
             $sub_array[] = $Booking['booking_route'] ;
             $sub_array[] = date("F j, Y, g:i a",strtotime($Booking['booking_datetime']));
             $sub_array[] = $Booking['total'] ;
             $sub_array[] = $Booking['payment_method'] ;
             $sub_array[] = '<span class="label label-warning">'.$Booking['status'].'</span>' ;
             
             $data[] = $sub_array;
           
         }

       
             
    $output = array(
             "draw"    => intval($_POST['draw']),
             "recordsTotal"  => count($Bookings['data']),
             "recordsFiltered" =>  $Bookings['cTotal'],
             "data"    => $data,
             
            
            );

        echo json_encode($output);
    die();
}
    
if($action == 'cancelBooking'){
	$uid=escape_string($_POST['uid']);
	$id=escape_string($_POST['id']);
	$Cancel= $DBUSER->cancelBooking($id,$uid,1);

	if($Cancel===true){
	$response["status"] = 'success';
    $response["msg"] = "Cancel Success";
    echo json_encode($response);
    die();
	}
	else{
	$response["status"] = 'error';
    $response["msg"] = "error in cancel";
    echo json_encode($response);
    die();
	}
}

if($action=='updateProfile'){
	 if (empty($_SESSION['userId'])){
    	die('Please Login');
    }  
	$name=escape_string($_POST['name']);
	$countryCode=escape_string($_POST['countryCode']);
	$mobile=escape_string($_POST['mobile']);
	$userId=$_SESSION['userId'];
	$updateProfile=$DBUSER->updateProfile($name,$countryCode,$mobile,$userId);
	if($updateProfile===true){
  $response["status"] = 'success';
    $response["msg"] = 'Profile Update Success';
    echo json_encode($response);
    die();
	}
	else{
		  $response["status"] = 'error';
    $response["msg"] = 'Error In update profile';
    echo json_encode($response);
    die();
	}
}

if($action=='changeUserPassword'){
	 if (empty($_SESSION['userId'])){
     $response["status"] = 'error';
    $response["msg"] = 'Please Login';
    echo json_encode($response);
    die();
    }  
    $userId=$_SESSION['userId'];
    if(empty($_POST['oldpassword']) || empty($_POST['newpass']) || empty($_POST['confirmpass']) ){
    	  $response["status"] = 'error';
    $response["msg"] = 'Please fill all fields';
    echo json_encode($response);
    die();
    }
    else if($DBUSER->getUserPassword($userId,$_POST['oldpassword']) === 0){
    $response["status"] = 'error';
    $response["msg"] = "Current password doesn't match";
    echo json_encode($response);
    die();
    }
    else if($_POST['newpass'] != $_POST['confirmpass']){
    $response["status"] = 'error';
    $response["msg"] = "Confirm password dont match";
    echo json_encode($response);
    die();
    } 
   

	$oldPassword=$_POST['oldpassword'];
	$newpass=$_POST['newpass'];
	$confirmpass=$_POST['confirmpass'];
	
	$updateProfile=$DBUSER->changePassword($userId,$newpass);
	if($updateProfile===true){
  $response["status"] = 'success';
    $response["msg"] = 'Password Update Success';
    echo json_encode($response);
    die();
	}
	else{
		  $response["status"] = 'error';
    $response["msg"] = 'Error In update Password';
    echo json_encode($response);
    die();
	}
}

}

 function escape_string($data) {
  $data = trim(htmlentities(strip_tags($data)));

  if (get_magic_quotes_gpc())
    $data = stripslashes($data);

  return $data;
 }