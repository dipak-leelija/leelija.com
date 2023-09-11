<?php
session_start();
require_once dirname(dirname(__DIR__))."/includes/constant.inc.php";

require_once ROOT_DIR."includes/order-constant.inc.php";

require_once ROOT_DIR."_config/dbconnect.php";
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

if($cusId == 0){
	header("Location: index.php");
}


if(isset($_POST["action"])){

    if ($_POST["action"] == 'sendData' ) {

        $orders_id    = $_POST["ordrId"];
        $domainCode   = $_POST["domainAuthCode"];
        $fileLink     = $_POST['websiteFile'];
        $dbLink       = $_POST['dbFile'];
        // $dbName       = $_POST['dbName'];
        // $dbUser       = $_POST['dbUser'];
        // $dbPass       = $_POST['dbPass'];
        $dbName       = '';
        $dbUser       = '';
        $dbPass       = '';
        $waitingTime  = $_POST['waitingTime'];
        $updated_by   = $cusDtl[0][2];
        
        $send = $Order->updateData($orders_id, $domainCode, $fileLink, $dbLink, $dbName, $dbUser, $dbPass, $waitingTime, $updated_by);
        $accepted = $Order->updateOrderStatus($orders_id, DELIVEREDCODE);
        if ($send) {
            echo 'sended';
        }
    }
}else {
    echo "Failed";
}

?>