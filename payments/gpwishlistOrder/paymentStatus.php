<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


include('Crypto.php');
require_once "../../includes/constant.inc.php";
require_once "../../_config/dbconnect.php";
require_once "../../_config/dbconnect.trait.php";
require_once "../../classes/content-order.class.php";
require_once "../../classes/customer.class.php";
require_once "../../classes/utility.class.php";


$customer		= new Customer();
$ContentOrder   = new ContentOrder();
$utility		= new Utility();


// exit;
    $workingKey='23AA922A82711D538A1ED6BBE222DD01';		//Working Key should be provided here.
    $encResponse=$_POST["encResp"];			//This is the response sent by the CCAvenue Server
    $rcvdString=decrypt($encResponse,$workingKey);		//Crypto Decryption used as per the specified working key.
    $order_status="";
    $decryptValues=explode('&', $rcvdString);

    $dataSize=sizeof($decryptValues);

	for($i = 0; $i < $dataSize; $i++){

		$information=explode('=',$decryptValues[$i]);
		if($i==3)	$order_status=$information[1];
        
        if ($information[0] == 'bank_ref_no') {
            $TXNID = $information[1];
        }

        if ($information[0] == 'order_id') {
            $ORDERID = $information[1];
        }

        if ($information[0] == 'amount') {
            $TXNAMOUNT = $information[1];
        }

        if ($information[0] == 'tracking_id') {
            $trackingId = $information[1];
        }
        
        if ($information[0] == 'trans_date') {
            $TXNDATE = $information[1];
        }

        if($information[0] == 'return_url') $_SESSION['return_url'] = $information[1];
        if($information[0] == 'merchant_param1')	$userId = $information[1];
		if($information[0] == 'merchant_param2')	$_SESSION['return_url'] = $information[1];

	}

    if (!isset($_SESSION['userid'])) {
        $client		= $customer->getCustomerData($userId);

        if ($client != '') {

            $_SESSION['name']           = $client[0][5].' '.$client[0][6];   					
            $_SESSION['welcome_name']   = $client[0][5];
            $_SESSION['userid'] 	    = $userId;		
            $_SESSION['usertypeid'] 	= $client[0][14];		
            $_SESSION['customer_type'] 	= $client[0][0];		

        }
    }

    $typeM		= $utility->returnGetVar('typeM','');
    $cusId		= $utility->returnSess('userid', 0);



	if($order_status==="Success"){
		// echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";

            $_SESSION['trxn_id']	  = $TXNID;
            $_SESSION['orderId']      = $ORDERID;
            $trxnStatus               = 'COMPLETED';
			$_SESSION['pay_success']  = true;
			

			/**
			 * 
			 * ORDER STATUS CODE
			 * 1 = Delivered
			 * 2 = Pending
			 * 3 = Processing
			 * 4 = Oedered
			 * 
			 *  */ 
			$ContentOrder->contentOrderStatusUpdate($_SESSION['orderId'], $_SESSION['trxn_id'], $trxnStatus, 4);

		
	}else if($order_status==="Aborted"){

		// echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";

        /**
			 * 
			 * ORDER STATUS CODE
			 * 1 = Delivered
			 * 2 = Pending
			 * 3 = Processing
			 * 4 = Oedered
			 * 
			 *  */ 
			$ContentOrder->contentOrderStatusUpdate($_SESSION['orderId'], $_SESSION['trxn_id'], $order_status, 2);


		header("Location: ../error-pay.php?msg=".base64_encode('Pending'));
        // echo 'Abroted';
		exit;
	
	}else if($order_status==="Failure"){

		// echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
			$ContentOrder->contentOrderStatusUpdate($_SESSION['orderId'], $_SESSION['trxn_id'], $order_status, 2);

		header("Location: ../error-pay.php");
        // echo 'Failure';
		exit;

	}else{

		echo "<br>Security Error. Illegal access detected";
		// header("Location: ../error-pay.php?msg=".base64_encode('Pending'));
        // Failure
		exit;
	
	}


	for($i = 0; $i < $dataSize; $i++) {

		$information=explode('=',$decryptValues[$i]);
	    	// echo '<tr><td>'.$information[0].'</td><td>'.$information[1].'</td></tr>';
            

            

            
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
                <div class="mt-4 p-5 bg-lighter-blue text-white rounded">
                    <h2 class="text-primary">Thanking you for your payment.</h2>
                    <p><i class="fas fa-check-circle fs-5 text-primary"></i> We have received your payment. You will
                        receive email shortly in your account.</p>
                    <p><i class="fas fa-exclamation-circle fs-5 text-warning"></i> If you find any difficulty, drop an
                        email to <?php echo SITE_BILLING_EMAIL ?></p>
                </div>
            </div>

            <!--======= column 2 =======-->

            <div class="col-11 col-md-10">
                <div class="row p-3 w-md-50">
                    <div class="col-12 col-sm-6">Order ID :</div>
                    <div class="col-12 col-sm-6"><b><?php echo "#".$ORDERID;?></b></div>
                    <div class="col-12 col-sm-6">Transection ID :</div>
                    <div class="col-12 col-sm-6"><b><?php echo $TXNID;?></b></div>
                    <div class="col-12 col-sm-6">Amount :</div>
                    <div class="col-12 col-sm-6"><b><?php echo '$'.$TXNAMOUNT;?></b></div>
                    <div class="col-12 col-sm-6">Time :</div>
                    <div class="col-12 col-sm-6"><b><?php echo date("d-m-Y H:s a", strtotime($TXNDATE));?></b></div>
                </div>
            </div>


            <!--======= column 3 =======-->

            <div class="col-11 col-md-10 mb-3 mb-md-5 p-4 text-center">
                <p>Your order status will updated to you, Now you can go back.</p>
                <div class="mt-3">
                    <a class="btn btn-primary" href="<?php echo URL;?>">Home</a>
                    <a class="btn btn-primary" href="<?php echo CLIENT_AREA;?>">My Account</a>
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