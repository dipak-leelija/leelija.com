<?php
session_start();
// echo $_SESSION['userid'];
// require_once("_config/connect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
require_once("classes/login.class.php");
require_once("classes/customer.class.php");
require_once("classes/countries.class.php");
require_once("classes/utility.class.php");
$country		= new Countries();
$logIn			= new Login();
$customer		= new Customer();
$utility		= new Utility();

if(isset($_GET['fName']) && isset($_GET['lName']) && isset($_GET['email']) &&
isset($_GET['pass'])){
  $fName = $_GET['fName'];
  $lName = $_GET['lName'];
  $email = $_GET['email'];
  $pass  = $_GET['pass'];
}
// $customer->packRegister(1,1,$email, $email, $pass, $fName, $lName,'Y','Y');

$insertPackCustomer = $customer->addPackCustomer(
  1, 1,$email, $email, $pass, $fName, $lName,
  'na', '0000-00-00', 'a', '', '','','Y', '', '0',
  '0',
  'Y',
  '0.00');
