<?php
session_start();
// echo $_SESSION['userid'];
// require_once("_config/connect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("classes/customer.class.php");
$customer		= new Customer();

if(isset($_GET['customer'])){
  $cusId = $_GET['customer'];
}

$cusDtl			= $customer->getCustomerData($cusId);

echo $cusDtl[37].",".$cusDtl[3].",".$cusDtl[24].",".$cusDtl[29].",".$cusDtl[30];







 ?>
