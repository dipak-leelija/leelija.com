<?php
session_start();
// echo $_SESSION['userid'];
// require_once("_config/connect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("classes/login.class.php");
require_once("classes/customer.class.php");
require_once("classes/countries.class.php");
$country		= new Countries();
$logIn			= new Login();
$customer		= new Customer();
if(isset($_GET['user']) && isset($_GET['pass'])){
  $userName  = $_GET['user'];
  $password  = $_GET['pass'];
}


if(isset($_SESSION['return_url']) == '')
  {
    $_SESSION['return_url'] 	= "dashboard.php";
  }
  else {
    $_SESSION['return_url'] = "login.php";
  }

$successLogin = $logIn->validatePackLogin($userName, $password, 'email', 'password', 'customer', $_SESSION['return_url']);

$currentId = $_SESSION['userid'];
$fname     = $_SESSION['welcome_name'];
$cusDtl			= $customer->getCustomerData($currentId);

echo $cusDtl[0][30];
$countryName = $country->showCountry($cusDtl[0][30]);


echo ",".$cusDtl[0][5].",".$cusDtl[0][6].",".$cusDtl[0][3].",".$cusDtl[0][24].",".$cusDtl[0][29].",".$cusDtl[0][30].",".$countryName.",".$currentId; 
 ?>
