<?php
ob_start();
session_start();



if (isset($_SESSION['email']) && isset($_SESSION['name']) && isset($_SESSION['userId']) )   
{
   require_once 'config/config.php';

require_once CLASSPATH.'DB_Functions.php';
$DBUSER= new DB_Functions();

     $email 	=   $_SESSION['email'];
     $usernum 	= $_SESSION['name'];
     $userId 	=  $_SESSION['userId'];
    

}


else
{

unset($_SESSION['email']);
unset($_SESSION['name']);
unset($_SESSION['userId']);
session_destroy();
header('Location: login.php');

}


?>