<?php
session_start();
//var_dump($_SESSION);
//include_once('checkSession.php');
require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";

require_once "../classes/customer.class.php";
require_once "../classes/order.class.php";
require_once "../classes/utility.class.php";



/* INSTANTIATING CLASSES */

$customer		= new Customer();
// $Domain			= new Domain();
// $OrderStatus    = new OrderStatus();
$Order          = new Order();
$utility        = new Utility;
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);

// print_r($cusDtl);exit;

if($cusId == 0){
	header("Location: index.php");
}

if($cusDtl[0][0] == 1){
	header("Location: app.client.php");
}

if(isset($_POST["action"])){

    if ($_POST["action"] == 'accept-order' ) {
        $orders_id = base64_decode($_POST["orderId"]);
        $newStat   = 3; // Processesing
        $accepted = $Order->updateOrderStatus($orders_id, $newStat);
        if ($accepted) {
            echo 'accepted';
        }
    }
}else {
    echo "Failed";
}

?>