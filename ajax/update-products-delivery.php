<?php
session_start();
//var_dump($_SESSION);
//include_once('checkSession.php');
require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";

require_once "../classes/customer.class.php";
require_once "../classes/encrypt.inc.php";
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


if($cusDtl[0][0] == 0) {
	header("Location: ../index.php");
}

if(isset($_POST["action"])){

    if ($_POST["action"] == 'self-integration' ) {

        $orders_id          = url_dec($_POST["orderId"]);
        $order_status_id    = 3;
        $domain_provider    = $_POST["domainProvider"];
        $domain_email      = $_POST["emailAddress"];
        $updated_by         = $cusDtl[0][2];

        $delivery_type      = 1;
        
        $accepted = $Order->addSelfIntegration($orders_id, $order_status_id, $domain_provider, $domain_email, $updated_by);
        if ($accepted) {
            $update = $Order->acceptedOrderStatus($orders_id, $delivery_type);
            if ($update && $accepted) {
                echo 'submited';
            }
        }
    }else {
        echo "not submited";
    }
}










if ($_POST["action"] == 'updateSingleData' ) {

    $orders_id          = $_POST["orderId"];
    $colName          = $_POST["colName"];
    $colValue          = $_POST["colValue"];

    $updated_by         = $cusDtl[0][2];

    $updated = $Order->updateSingleData($orders_id, $colName, $colValue, $updated_by);
    if ($updated) {
        echo 'updated';
    }
}



?>