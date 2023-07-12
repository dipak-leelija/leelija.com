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
require_once("classes/order.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/gp-order.class.php");
require_once("classes/domain.class.php");
require_once("classes/checkout.class.php");
$gp = new Gporder();
$utility		= new Utility();
$customer		= new Customer();
$order			= new Order();
$uMesg 			= new MesgUtility();
$domain			= new Domain();
$checkout		= new Checkout();
$cusId			= $utility->returnSess('userid', 0);
$domainDtls		= $domain->ShowDomainData();

if(isset($_GET['name']) && isset($_GET['email']) && isset($_GET['addrs']) && isset($_GET['zipCo']) && isset($_GET['cntry']) && isset($_GET['notes']) && $_GET['niche'] && $_GET['packId']){
  $name   = $_GET['name'];
  $email  = $_GET['email'];
  $addrs  = $_GET['addrs'];
  $zip    = $_GET['zipCo'];
  $cuntry = $_GET['cntry'];
  $notes  = $_GET['notes'];
  $niche  = $_GET['niche'];
  $package = $_GET['packId'];
}

$packDetails = $gp->singlePackageDetails($package);

//defining error variables
$action		= 'order_now';
$url		= $_SERVER['PHP_SELF'];
$id			= 0;
$id_var		= '';
$anchor		= 'ordForm';
$typeM		= 'ERROR';

// //registering the post session variables
// $sess_arr	= array('txtBillingName','txtBillingEmail','txtBillingAdd', 'txtPostCode','txtCountry');
// $utility->addPostSessArr($sess_arr);
//
//customer details
$client_dtl		= $customer->getCustomerData($cusId);
//
//Update Customer details
$customer->editCustomerDtls($cusId, $name);

$updateDetails = $customer->updateCusAddress($cusId, $addrs, $client_dtl[25], $client_dtl[26], $client_dtl[27], $client_dtl[28], $zip, $cuntry,$client_dtl[31], $client_dtl[32], $client_dtl[33], $client_dtl[34]);

//Add Orders
$ordId	= $order->addOrder($cusId, $name, $packDetails[0], $client_dtl[5], $addrs, $client_dtl[25], $client_dtl[26], $client_dtl[29],
$client_dtl[34], $client_dtl[28], $cuntry, $email, $notes);

// //generate order key
$ordKey = $order->generateOrderCode('ORDER', $ordId);
// //order amount
// $ordAmt	= $totalAmt; //0.01;//$totalPrice;//0.01
//
//update order code
$order->updateOrderCode($ordId, $ordKey, $packDetails[0]);

//update order status
$order->updateOrderStatus($ordId, 1);
//
// //hold order values in session
$_SESSION['ordId']	= $ordId;
$_SESSION['ordKey']	= $ordKey;
$_SESSION['ordAmt']	= $packDetails[0];


// //forward to payment page
// $uMesg->showSuccessT('success', 0, '', 'payment.php', SUORDERL101, 'SUCCESS');
