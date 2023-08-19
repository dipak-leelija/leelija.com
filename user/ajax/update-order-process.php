<?php
session_start();
require_once dirname(dirname(__DIR__))."/includes/constant.inc.php";
require_once dirname(dirname(__DIR__))."/includes/order-constant.inc.php";
require_once ROOT_DIR."_config/dbconnect.php";

require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/encrypt.inc.php";
require_once ROOT_DIR."classes/order.class.php";
require_once ROOT_DIR."classes/utility.class.php";



/* INSTANTIATING CLASSES */

$customer		= new Customer();
$Order          = new Order();
$utility        = new Utility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);

// print_r($cusDtl);exit;


if($cusDtl[0][0] == 0) {
	header("Location: ".URL);
}

if(isset($_POST["action"])){

    if ($_POST["action"] == 'verified' ) {

        $orders_id          = url_dec($_POST["orderId"]);
        $updated_by         = $cusDtl[0][2];

        $updated = $Order->updateSingleData($orders_id, 'order_status_id', COMPLETEDCODE, $updated_by);
        if ($updated) {
            $updated2 = $Order->updateOrderStatus($orders_id, DELIVEREDCODE);
            if ($updated && $updated2) {
                echo 'verified';
            }
        }
    }else {
        echo "not verified";
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