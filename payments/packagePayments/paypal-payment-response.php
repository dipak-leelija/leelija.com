<?php 
session_start();
// var_dump($_SESSION);
require_once "../../_config/dbconnect.php";
require_once "../../_config/dbconnect.trait.php";

require_once "../../includes/constant.inc.php";
require_once "../../includes/user.inc.php";
require_once "../../includes/email.inc.php";
require_once "../../includes/paypal.inc.php";

require_once "../../classes/customer.class.php";
require_once "../../classes/utility.class.php";
require_once "../../classes/order.class.php";
require_once "../../classes/gp-order.class.php";

/* INSTANTIATING CLASSES */

$utility		= new Utility();
$customer           = new Customer();
$order  			= new Order();
$gp 				= new Gporder();
###############################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);


if (!isset($_SESSION['package-order-id']) && !isset($_SESSION['paypalTranId']) && !isset($_SESSION['order-amount'])) {
    header("Location: ../../");
}


if (isset($_GET['data'])) {
    
    if (isset($_SESSION['package-order-id'])) {
    
        $orderId       = $_SESSION['package-order-id'];
        $userCurrentId = $_SESSION['userid'];
        $userName      = $_SESSION['name'];
        $amount        = $_SESSION['order-amount'];

    }


    $details = (array)json_decode(base64_decode($_GET['data']));
    // print_r($details);

	$purchase_units = (array)$purchase_units = (array)$payer = $details['purchase_units'];
	$payments = (array)$payments = $purchase_units[0];
	$captures = (array)$captures = (array)$payments['payments'];
	$captures = (array)$captures = (array)$captures = $captures['captures'];
	$captures = (array)$captures = $captures[0];

	$transactionId 	= $captures['id'];		//geting the transection id 
	$trxnStatus = $captures['status'];	//geting the transection status
    // exit;

    if ($trxnStatus == "COMPLETED") {
        $_SESSION['paypalTranId'] = $transactionId;
        $orderStatus   = "Ordered";
        $paymentStatus = "Completed";
        
        $paymentMode   = "Paypal";
    
        $order = $gp->gpOrderById($orderId);
        $updated = $order[0]['date'];
        $updateOrder = $gp->successPayment($orderId, $transactionId, $paymentMode, $paymentStatus, $orderStatus); 
        // print_r($order);
    
        if(!$updateOrder){
            echo"error";  
        }else{
            $sess_arr = array('paypalTranId','order-amount','package-order-id');
            $utility->delSessArr($sess_arr);
            unset($_POST);
        }

    }else {
        header("Location: ../error-pay.php");
    }

}else {
    header("Location: ../../");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Payment Success - Order Received</title>
    <link rel="icon" href="<?php echo FAVCON_PATH; ?>" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo FAVCON_PATH; ?>" />
    
    <link rel="stylesheet" href="../../plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="../../plugins/fontawesome-6.1.1/css/all.css">

    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="../../css/leelija.css">
    <link rel="stylesheet" href="../../css/payment-status.css">

    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
</head>
<body>

    <!-- Start  Header -->
    <?php require_once "../../partials/navbar.php"; ?>
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
                        <div class="col-12 col-sm-6"><b><?php echo "#".$orderId;?></b></div>
                        <div class="col-12 col-sm-6">Transection ID :</div>
                        <div class="col-12 col-sm-6"><b><?php echo $transactionId;?></b></div>
                        <div class="col-12 col-sm-6">Amount :</div>
                        <div class="col-12 col-sm-6"><b><?php echo '$'.$amount;?></b></div>
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
                    <a class="btn btn-primary" href="<?php echo CLIENT_AREA; ?>">My Account</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mainWrapBottom"></div>
    <!-- End  MainWrap -->

    <!-- Start Foter -->
    <?php require_once "../../partials/footer.php"; ?>
    <!-- End Foter -->
</body>

</html>