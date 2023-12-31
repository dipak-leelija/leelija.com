<?php
session_start();
require_once "../includes/constant.inc.php";

require_once ROOT_DIR."includes/alert-constant.inc.php";
require_once ROOT_DIR."includes/order-constant.inc.php";
require_once ROOT_DIR."includes/email.inc.php";
require_once ROOT_DIR."includes/paypal.inc.php";

require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/utility.class.php";
require_once ROOT_DIR."classes/order.class.php";

/* INSTANTIATING CLASSES */
$utility		    = new Utility();
$customer           = new Customer();
$order  			= new Order();

###############################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);



if(!isset($_SESSION["domain"]) && !isset($_SESSION["tAmount"]) && !isset($_SESSION["txtBillingName"]) && !isset($_SESSION["txtBillingEmail"]) && !isset($_SESSION["txtBillingAdd"]) && !isset($_SESSION["txtPostCode"]) && !isset($_SESSION["txtCountry"]) && !isset($_SESSION["ordId"]) && !isset($_SESSION["ordKey"]) && !isset($_SESSION["ordAmt"])){

    header("Location: ".URL);
}


if (isset($_GET['data'])) {

    $details = (array)json_decode(base64_decode($_GET['data']));
    $purchase_units = $details['purchase_units'][0];
    $trxnId         = $purchase_units->payments->captures[0]->id;
    $trxnStatus     = $purchase_units->payments->captures[0]->status;


	// $purchase_units = (array)$purchase_units = (array)$payer = $details['purchase_units'];
	// $payments = (array)$payments = $purchase_units[0];
	// $captures = (array)$captures = (array)$payments['payments'];
	// $captures = (array)$captures = (array)$captures = $captures['captures'];
	// $captures = (array)$captures = $captures[0];

	// $trxnId 	= $captures['id'];		//geting the transection id 
	// $trxnStatus = $captures['status'];	//geting the transection status
    // exit;

    if ($trxnStatus == "COMPLETED") {
        $orderId            = $_SESSION['ordId'];
        $transactionCode    = $_SESSION['ordKey'];
		$ordAmt             = $_SESSION['ordAmt'];
        
        //update payment status
        $order->updatePaymentStatus(COMPLETEDCODE, $orderId);
        
        //update order status
        $order->updateOrderStatus($orderId, ORDEREDCODE);

        $orderDetails = $order->getOrderDetail($transactionCode, $orderId);
        $updated = $orderDetails[19];
        $amount  = $orderDetails[27];
    }

    $sess_arr = array('domain','tAmount','txtBillingName','txtBillingEmail','txtBillingAdd','txtPostCode','txtCountry','ordId','ordKey','ordAmt');

    $utility->delSessArr($sess_arr);


}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Payment Success - Order Received</title>
    <link rel="stylesheet" href="<?= URL ?>plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="<?= URL ?>plugins/fontawesome-6.1.1/css/all.css">

    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="<?= URL ?>css/leelija.css">
    <link rel="stylesheet" href="<?= URL ?>css/payment-status.css">

</head>


<body>

    <!-- Start  Header -->
    <?php require_once ROOT_DIR."partials/navbar.php"; ?>
    <!-- End  Header -->

    <!-- Start  container -->
    <div id="container">

        <div class="row flex-column  align-items-center">

            <!--======= column 1 =======-->
            <div class="col-11 col-md-10">
                <div class="mt-4 p-5 bg-lighter-blue rounded">
                    <h2 class="text-primary">Thanking you for your payment.</h2>

                    <div class="row p-3 w-md-50">
                        <div class="col-12 col-sm-6">Order ID :</div>
                        <div class="col-12 col-sm-6"><b><?php echo "#".$transactionCode;?></b></div>
                        <div class="col-12 col-sm-6">Status : </div>
                        <div class="col-12 col-sm-6"><b><?php echo $trxnStatus;?></b></div>
                        <div class="col-12 col-sm-6">Amount :</div>
                        <div class="col-12 col-sm-6"><b><?php echo "$".$amount;?></b></div>
                        <div class="col-12 col-sm-6">Time :</div>
                        <div class="col-12 col-sm-6"><b><?php echo date("d-m-Y H:s a", strtotime($updated)); ?></b></div>

                    </div>

                    <p><i class="fas fa-check-circle fs-5 text-primary"></i> We have received your payment. You will
                        receive email shortly in your account.</p>
                    <p><i class="fas fa-exclamation-circle fs-5 text-warning"></i> If you find any difficulty, drop an
                        email to <?php echo SITE_BILLING_EMAIL ?></p>
                </div>
            </div>

            <!--======= column 2 =======-->

            <div class="col-11 col-md-10 mb-3 mb-md-5 p-4 text-center">
                <p>Your order status will updated to you, Now you can go back.</p>
                <div class="mt-3">
                    <a class="btn btn-primary" href="<?php echo URL; ?>">Home</a>
                    <a class="btn btn-primary" href="<?php echo USER_AREA; ?>">My Account</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mainWrapBottom"></div>
    <!-- End  MainWrap -->

    <!-- Start Foter -->
    <?php require_once ROOT_DIR."partials/footer.php"; ?>
    <!-- End Foter -->
</body>

</html>