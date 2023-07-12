<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// require_once("_config/connect.php");
require_once "_config/dbconnect.php";
require_once "_config/dbconnect.trait.php";


require_once("includes/constant.inc.php");
require_once("includes/user.inc.php");
require_once("includes/email.inc.php");
require_once("includes/registration.inc.php");
// require_once("includes/company_contact.inc.php");
// require_once("includes/order_landing.inc.php");
require_once("includes/paypal.inc.php");
// require_once("includes/guest_post_req.inc.php");

// require_once("classes/cart.class.php");
// require_once("classes/guest_post.class.php");  
// require_once("classes/package.class.php");

require_once "classes/domain.class.php"; 
require_once "classes/blog_mst.class.php"; 
require_once "classes/order.class.php";
require_once "classes/orderStatus.class.php";
require_once "classes/error.class.php";
require_once "classes/date.class.php";
require_once "classes/content-order.class.php";
require_once "classes/wishList.class.php";
require_once "classes/utility.class.php"; 
require_once "classes/utilityMesg.class.php"; 

/* INSTANTIATING CLASSES */
$domain			= new Domain();
$BlogMst		= new BlogMst();
$ordObj			= new Order();
$OrderStatus	= new OrderStatus();
$error			= new MyError();
$ContentOrder	= new ContentOrder();
$WishList		= new WishList();

$dateUtil		= new DateUtil();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

###############################################################################################


require_once("classes/customer.class.php");
$customer		= new Customer();
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');


if (!isset($_POST)) {
	header("Location: dashboard.php");
	exit;
}



if(isset($_SESSION['orderId'])) {
	//$_SESSION['orderId'] is the id of created order 
	$_SESSION['ordIdCusOrd']	=	$_SESSION['orderId'];
}else {
	header("Location: dashboard.php");
	exit;
}

if (isset($_POST['data'])) {
	
	$blogId = $_POST['blogId'];

	$details = (array)json_decode($_POST['data']);

	$purchase_units = (array)$purchase_units = (array)$payer = $details['purchase_units'];
	$payments = (array)$payments = $purchase_units[0];
	$captures = (array)$captures = (array)$payments['payments'];
	$captures = (array)$captures = (array)$captures = $captures['captures'];
	$captures = (array)$captures = $captures[0];

	$trxnId 	= $captures['id'];		//geting the transection id 
	$trxnStatus = $captures['status'];	//geting the transection status



	// print_r($purchase_units 	   = (array)$payer = $details['purchase_units']);
	// $payerName = (array)$payerName = $payer['name'];
	
	// $orderId 		
	// echo '<br>';
	// echo '<br>';
	// echo '<br>';
	
	// $payerName = (array)$payerName = $payer['name'];
	// $firstName = $payerName['given_name'];
	// $lastName  = $payerName['surname'];

	if ($trxnStatus == "COMPLETED") {

			$_SESSION['trxn_id']	  = $trxnId;
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
	}else {
		$ContentOrder->contentOrderStatusUpdate($_SESSION['orderId'], $_SESSION['trxn_id'], $trxnStatus, 2);
	}

	
}

// exit;


$orderDetail 	= $ContentOrder->showOrderdContentsByCol('id', $_SESSION['ordIdCusOrd'], '', '');

//For Testing
//$orderDetail  = $ordObj->getOrderLandingData(5);
$prodIds	 	= $utility->getAllIdByCond('product_id', 'orders_id', $_SESSION['ordIdCusOrd'], 'orders_products', 'orders_products_id');


// if(isset($_SESSION['ordId'])) {
if(isset($_SESSION['orderId'])) {

	// CURRENT SESSION ID
	// echo $sid = session_id();

	//Remove Item From WishList after purchase
	$WishList->removeWish($orderDetail[0]['clientUserId'], $blogId);
	

	//delete the session
	$sess_arr = array('txtName','txtPhone','txtEmail', 'txtAddress','txtCity','txtState','txtPostalCode', 
	'ordId', 'ordKey', 'ordAmt', 'pay_success', 'trxn_id', 'ordIdCusOrd', 'orderId');
	$utility->delSessArr($sess_arr);
	unset($_POST);
	
	//order status
	$statusCode	= $orderDetail[0]['clientOrderStatus'];
	$statusName 		= $OrderStatus->getOrdStatName($statusCode);

	// Client Details 
	$client		= $customer->getCustomerData($orderDetail[0]['clientUserId']);


	$domainDetails = $BlogMst->showBlogbyDomain($orderDetail[0]['clientOrderedSite']);
	$sellerEmail = $domainDetails[19];

	$seller = $customer->getCustomerByemail($sellerEmail);

//'txtName','txtPhone','txtEmail', 'txtAddress','txtCity','txtState','txtPostalCode'

	// ===================================================================================================================
	// =========================================		SEND MAIL TO ADMIN		 =========================================
	// ===================================================================================================================

	$to 		=   SITE_BILLING_NAME."<".SITE_BILLING_EMAIL.">";//EMAIL_FROM_TO_INFO Himadri Shekhar Roy<himadri.s.roy@ansysoft.com>
	
	$from 		=	$orderDetail[0]['clientName']. "<".$orderDetail[0]['clientEmail'].">";

	$fromMail 	=	$orderDetail[0]['clientEmail'];
	
	//subject
	$subject	=	"Order from  ".$orderDetail[0]['clientEmail']." - ".date("d-m-Y");
	
	//body 
	$body = "<div style='font-family: Poppins, Verdana, Arial, Helvetica,
				sans-serif;
				font-size: 11px;
				color: #000000;
				display: grid;
				justify-content: center;
				'>

				<div style='margin-bottom:20px;'>
					<div style='text-align: center;'>
						<img src='images/logo/logo.png' width='".LOGO_WIDTH."' height='".LOGO_HEIGHT."' />
					</div>
				</div>

				<div>

					<h2 align='left'
						style='padding-bottom:40px; font-family: Poppins, Arial, Helvetica, sans-serif; color: #000000;font-style: normal;font-weight: 900; text-align: center;'>
						Order from - ".$orderDetail[0]['clientEmail']."</h2>

					<h3 style='margin:0 0 20px 0; font-weight:bold'>Client Personal Detail</h3>
					<div style='margin:0 0 40px 0'>
						<table width='545' style=' font-size: 11px; border:1px solid #666666'>
							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>NAME: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$orderDetail[0]['clientName']."
								</td>
							</tr>
							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>EMAIL: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['clientEmail']."
								</td>
							</tr>

							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>BUSINESS NAME: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$client[0][12]."
								</td>
							</tr>
							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>CITY: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$client[0][27]."
								</td>
							</tr>
							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>STATE: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$client[0][28]."
								</td>
							</tr>

							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>POSTAL CODE: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$client[0][29]."
								</td>
							</tr>
							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PHONE: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$client[0][34]."
								</td>
							</tr>
						</table>
					</div>
				</div>



				<div style='margin:0 0 40px 0'>
					<h3 style='margin:0 0 20px 0; font-weight:bold'>Transaction Detail</h3>

					<table width='545' style='font-family: Verdana, Arial, Helvetica, sans-serif;
							font-size: 11px;
							color: #000000; border:1px solid #666666'>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>ORDER ID: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['id']."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>TRANSECTION ID: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['clientTransactionId']."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>AMOUNT: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								$".$orderDetail[0]['clientOrderPrice']."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PAYMENT STATUS: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['paymentStatus']."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PLACED ON: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".date("d-m-Y H:i a", strtotime($orderDetail[0]['added_on']))."
							</td>
						</tr>


					</table>

				</div>



				<div style='margin:0 0 40px 0'>
					<h3 style='margin:0 0 20px 0; font-weight:bold'>Order Details</h3>

					<table width='545' style='font-family: Verdana, Arial, Helvetica, sans-serif;
							font-size: 11px;
							color: #000000; border:1px solid #666666'>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>CLIENT NAME: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['clientName']."
							</td>
						</tr>

						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>CLIENT EMAIL: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['clientEmail']."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>SELLER NAME: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$seller[0]['fname']." ".$seller[0]['lname']."
							</td>
						</tr>

						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>SELLER EMAIL: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$sellerEmail."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>DOMAIN: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['clientOrderedSite']."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>ORDER STATUS: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$statusName."
							</td>
						</tr>

						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PLACED ON: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".date("d-m-Y H:i a", strtotime($orderDetail[0]['added_on']))."
							</td>
						</tr>

					</table>

				</div>

				<div>This is a Auto Generated Mail From ".SITE_BILLING_NAME.". During Client Order.</div>

			</div>";
					
	//normal mail
	$headers  = "From: ".$from."\r\n";
	$headers .= "Return-Path: <".$fromMail.">\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1";

	@mail($to, $subject, $body, $headers);

	// ================================== MAIL SENDED TO ADMIN ================================== 


	// ===================================================================================================================
	// =========================================		SEND MAIL TO CLIENT		 =========================================
	// ===================================================================================================================

	$toC 		=   $orderDetail[0]['clientName']. "<".$orderDetail[0]['clientEmail'].">";
	$fromC 		=	SITE_BILLING_NAME."<".SITE_BILLING_EMAIL.">";
	$fromMailC 	=	SITE_BILLING_EMAIL;
	
	//subject
	$subjectC	=	"Your Order Detail on - "." - ".date("Y-m-d");	

	//body 
	$bodyC = "<div style='font-family: Poppins, Verdana, Arial, Helvetica,
				sans-serif;
				font-size: 11px;
				color: #000000;
				display: grid;
				justify-content: center;
				'>

				<div style='margin-bottom:20px;'>
					<div style='text-align: center;'>
						<img src='images/logo/logo.png' width='".LOGO_WIDTH."' height='".LOGO_HEIGHT."' />
					</div>
				</div>

				<div>

					<h2 align='left'
						style='padding-bottom:40px; font-family: Poppins, Arial, Helvetica, sans-serif; color: #000000;font-style: normal;font-weight: 900; text-align: center;'>
						Order Details For - ".$orderDetail[0]['clientOrderedSite']."</h2>

					<h3 style='margin:0 0 20px 0; font-weight:bold'>Client Personal Detail</h3>
					<div style='margin:0 0 40px 0'>
						<table width='545' style=' font-size: 11px; border:1px solid #666666'>
							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>NAME: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$orderDetail[0]['clientName']."
								</td>
							</tr>
							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>EMAIL: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['clientEmail']."
								</td>
							</tr>

							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>BUSINESS NAME: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$client[0][12]."
								</td>
							</tr>
							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>CITY: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$client[0][27]."
								</td>
							</tr>
							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>STATE: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$client[0][28]."
								</td>
							</tr>

							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>POSTAL CODE: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$client[0][29]."
								</td>
							</tr>
							<tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PHONE: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$client[0][34]."
								</td>
							</tr>
						</table>
					</div>
				</div>



				<div style='margin:0 0 40px 0'>
					<h3 style='margin:0 0 20px 0; font-weight:bold'>Transaction Detail</h3>

					<table width='545' style='font-family: Verdana, Arial, Helvetica, sans-serif;
							font-size: 11px;
							color: #000000; border:1px solid #666666'>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>ORDER ID: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['id']."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>TRANSECTION ID: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['clientTransactionId']."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>AMOUNT: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								$".$orderDetail[0]['clientOrderPrice']."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PAYMENT STATUS: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['paymentStatus']."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PLACED ON: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".date("d-m-Y H:i a", strtotime($orderDetail[0]['added_on']))."
							</td>
						</tr>


					</table>

				</div>



				<div style='margin:0 0 40px 0'>
					<h3 style='margin:0 0 20px 0; font-weight:bold'>Order Details</h3>

					<table width='545' style='font-family: Verdana, Arial, Helvetica, sans-serif;
							font-size: 11px;
							color: #000000; border:1px solid #666666'>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>CLIENT NAME: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['clientName']."
							</td>
						</tr>

						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>CLIENT EMAIL: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['clientEmail']."
							</td>
						</tr>

						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>DOMAIN: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[0]['clientOrderedSite']."
							</td>
						</tr>
						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>ORDER STATUS: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$statusName."
							</td>
						</tr>

						<tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PLACED ON: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".date("d-m-Y H:i a", strtotime($orderDetail[0]['added_on']))."
							</td>
						</tr>

					</table>

				</div>

				<div>This is a Auto Generated Mail From ".SITE_BILLING_NAME.". During Client Order.</div>

			</div>";
				
	//normal mail
	$headersC  = "From: ".$fromC."\r\n";
	$headersC .= "Return-Path: <".$fromMailC.">\r\n";
	$headersC .= "Content-type: text/html; charset=iso-8859-1";
	
	@mail($toC, $subjectC, $bodyC, $headersC);

	// ================================== MAIL SENDED TO CLIENT ================================== 
	
	//session array
	$sess_arr = array('txtName', 'txtPhone', 'txtEmail', 'txtAddress', 'txtCity', 'txtState', 'txtPostalCode', 'ordId', 'ordKey', 'ordAmt');
	
	//delete the session
	$utility->delSessArr($sess_arr);
}

if(isset($_POST['reqSubmit'])) {
	
	//defining error variables
	$action		= 'add_guest_post';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addGuestPost';
	$typeM		= 'ERROR';
	
	
	$selNum			= $_POST['selNum'];
	
	//add the additional paragraphs			
	for($i=0; $i < $selNum; $i++)
	{
		if($_POST['txtAncharText'][$i] == '') {
			$error->showErrorTA($action, $id, $id_var, $url, ERGUESTPOST001, $typeM, $anchor);
		}else if($_POST['txtTargetUrl'][$i] == '') {
			$error->showErrorTA($action, $id, $id_var, $url, ERGUESTPOST002, $typeM, $anchor);
		}else{
			$staticDtlId	= $guestPost->addGuestPostReq($_SESSION['ordIdCusOrd'], $_POST['txtAncharText'][$i], $_POST['txtTargetUrl'][$i], $_POST['txtRequirement'][$i]);
		}
	}
	//session array
	$sess_arr = array('pay_success', 'trxn_id', 'ordIdCusOrd');
	
	//delete the session
	$utility->delSessArr($sess_arr);
	header("Location: index.php");
	
}
		
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Payment Success - Order Received</title>
    <link rel="stylesheet" href="<?php echo URL ?>style/ansysoft.css" type="text/css" />
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">

    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="css/leelija.css">
    <link rel="stylesheet" href="css/payment-status.css">

</head>


<body>

    <!-- Start  Header -->
    <?php require_once "partials/navbar.php"; ?>
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

            <div class="col-11 col-md-10 mb-3 mb-md-5 p-4 text-center">
                <p>Your order status will updated to you, Now you can go back.</p>
                <div class="mt-3">
                    <a class="btn btn-primary" href="index.php">Home</a>
                    <a class="btn btn-primary" href="app.client.php">My Account</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mainWrapBottom"></div>
    <!-- End  MainWrap -->

    <!-- Start Foter -->
    <?php require_once "partials/footer.php"; ?>
    <!-- End Foter -->
</body>

</html>