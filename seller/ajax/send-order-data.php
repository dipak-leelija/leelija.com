<?php
session_start();
require_once dirname(dirname(__DIR__))."_config/dbconnect.php";

require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/order.class.php";
require_once ROOT_DIR."classes/utility.class.php";



/* INSTANTIATING CLASSES */

$customer		= new Customer();
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

// if($cusDtl[0][0] == 1){
// 	header("Location: app.client.php");
// }

if(isset($_POST["action"])){

    if ($_POST["action"] == 'sendData' ) {
        $updated_by         = $cusDtl[0][2];
        
        $send = $Order->updateData($_POST["ordrId"], 'domain_authorizatrion_code', $_POST["domainCode"], 'website_file_link', $_POST["driveUrl"], 	'waiting_time', $_POST["waitingTime"], '', $updated_by);
        // $driveUrl = base64_decode($_POST["driveUrl"]);
        // $newStat   = 3; // Processesing
        // $accepted = $Order->updateOrderStatus($orders_id, $newStat);
        if ($send) {
            echo 'sended';
        }
    }
}else {
    echo "Failed";
}

?>