<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  

 require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DBUSER= new DB_Functions();

$response = array();
 $error="";
  if(empty($_POST['email'])){
    $error.="Please Enter Email<br>";
  }
  if(empty($_POST['name'])){
     $error.="Please Enter Name<br>";
  }

  if(empty($_POST['password'])){
     $error.="Please Enter password<br>";
  }

  
 if(!is_numeric($_POST['mobile']) || strlen($_POST['mobile']) > 12 ){
     $error.="Please Enter Valid Mobile Number<br>";
  }

  if(!empty($error)){

       $response["status"] = 'error';
    $response["msg"] = $error;
    echo json_encode($response);
    die();
  }
	
    // receiving the post params
	 $type=(isset($_POST['type']) && $_POST['type'] == 'op') ? 2 : 3;
    $email = trim(strtolower($_POST['email']));
    $email = strip_tags($email);
    $name = trim(strip_tags($_POST['name']));
    $ccode = (empty($_POST['ccode'])) ? '+234' : trim(strip_tags($_POST['ccode']));
    $mobile = trim(strip_tags($_POST['mobile']));
    $password = $_POST['password'];
     
     if($DBUSER->isUserExisted($email)){
        $response["status"] = 'error';
    $response["msg"] = 'Email already exists';
    echo json_encode($response);
    die();
     } 

   $user = $DBUSER->storeUser($name,$email,$ccode,$mobile,$password,$type);

if($user['status'] === true)
    {
     
   $response["status"] = 'success';
    $response["msg"] = "Verification link has been sent to your email (Note :-Please check SPAM folder if Link not received in  inbox). ";
    echo json_encode($response);
    
    }
else
{
   
   $response["status"] = 'error';
    $response["msg"] = "Error In Register";
    echo json_encode($response);
 
}


  
  
}