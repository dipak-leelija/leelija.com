<?php
session_start();
require_once dirname(dirname(__DIR__))."/includes/constant.inc.php";
require_once ROOT_DIR."_config/dbconnect.php";

require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/order.class.php";
require_once ROOT_DIR."classes/utility.class.php";



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