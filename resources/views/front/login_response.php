<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  

 require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DBUSER= new DB_Functions();

$response = array();
 
if (isset($_POST['email']) && isset($_POST['password'])) {
 
    // receiving the post params
    $email = trim(strtolower($_POST['email']));
    $email = strip_tags($email);
    $password = $_POST['password'];
  
   $user = $DBUSER->UserLogin($email, $password);

if($user['login_status'] === true)
    {
      if($user['status'] == 'V'){
          $response["status"] = 'error';
    $response["msg"] = "Please Verify Your Email Address!";
    echo json_encode($response);
    die();
      }
   if($user['status'] == 'F'){
          $response["status"] = 'error';
    $response["msg"] = "Your Login Blocked By Admin!";
    echo json_encode($response);
    die();
      }

      session_start();
    if($user['role_id'] == 3){
     $_SESSION['email']=$user['email'];
     $_SESSION['userId']= $user['userId'];
     $_SESSION['name']= $user['name'];
   }
   else if($user['role_id'] == 2){
    unset($user['password']);
      $last_login = date("Y-m-d H:i:s");
          $_SESSION['admin_user'] = $user;
          
          $data = array();
          $data['last_login'] = $last_login;
         
         
   }
   else{
       $response["status"] = 'error';
  $response["msg"] = "Wrong Email Or Password";
    echo json_encode($response);
    die();
   }
    
   $response["status"] = 'success';
    $response["msg"] = "Success";
    $response["r_id"] = $user['role_id'];
    echo json_encode($response);
    
    }
else
{
   
   $response["status"] = 'error';
    $response["msg"] = "Wrong Email Or Password";
    echo json_encode($response);
 
}

} 
else {
    $response["status"] = 'error';
    $response["msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
    die();
}
  
  
}