<?php 
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
require_once "classes/order.class.php";
require_once "classes/error.class.php"; 
require_once "classes/date.class.php";
require_once "classes/client-order.class.php";
require_once "classes/utility.class.php"; 
require_once "classes/utilityMesg.class.php"; 


// require_once("classes/utilityImage.class.php");
// require_once("classes/utilityNum.class.php");
// require_once("classes/utilityStr.class.php");

/* INSTANTIATING CLASSES */
$domain			= new Domain();
$ordObj			= new Order();
$error			= new MyError();
$ContentOrder	= new ContentOrder();
$dateUtil		= new DateUtil();
$utility		= new Utility();
$uMesg 			= new MesgUtility();


// $package		= new Package();
// $cart			= new Cart();
// $guestPost		= new GuestPosts();
// $uImg 			= new ImageUtility();
// $uNum 			= new NumUtility();
// $uStr 			= new StrUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');

if (isset($_POST['data'])) {

	$details = (array)json_decode($_POST['data']);
	// print_r($details);


	$_SESSION['pay_success'] = true;
	$_SESSION['trxn_id']	 = $details['id'];
	// $_SESSION['ordId']
	
	
	// $orderId 		
	// echo '<br>';
	// echo '<br>';
	// echo '<br>';
	// $payer 	   = (array)$payer = $details['payer'];
	
	// $payerName = (array)$payerName = $payer['name'];
	// $firstName = $payerName['given_name'];
	// $lastName  = $payerName['surname'];

	
}else {
	echo "Sorry";
}
// exit;




//check if session exists or not
if((!isset($_SESSION['pay_success'])) || (!isset($_SESSION['trxn_id'])))
{
	header("Location: index.php");
}

//For Testing
//$_SESSION['ordIdCusOrd']	= 5;
if(isset($_SESSION['orderId'])) {
	//To customize the order take a backup of ordId
	// $_SESSION['ordIdCusOrd']	=	$_SESSION['ordId'];
	$_SESSION['ordIdCusOrd']	=	$_SESSION['orderId'];
}

//get the order detail, and reassign them to session
//==$orderDetail 	= $ordObj->getOrderLandingData($_SESSION['ordIdCusOrd']);
//==print_r($orderDetail);

$orderDetail 	= $ContentOrder->showOrderdContents($_SESSION['ordIdCusOrd']);
print_r($orderDetail);

//For Testing
//$orderDetail  = $ordObj->getOrderLandingData(5);
$prodIds	 	= $utility->getAllIdByCond('product_id', 'orders_id', $_SESSION['ordIdCusOrd'], 'orders_products', 'orders_products_id');
//For Testing
//$prodIds	 	= $utility->getAllIdByCond('product_id', 'orders_id', 5, 'orders_products', 'orders_products_id');
//== $packageIds	 	= $utility->getAllIdByCond('package_id', 'orders_id', $_SESSION['ordIdCusOrd'], 'orders_products', 'orders_products_id');

//For Testing
//$packageIds	= $utility->getAllIdByCond('package_id', 'orders_id', 5, 'orders_products', 'orders_products_id');

/* $checkPackage = false;
$prodDtlSec	 = "";
foreach($packageIds as $p)
{
	if($p == 0){
		$checkPackage = false;
	}
	else {
		$checkPackage = true;
	}
}
*/

if(isset($_SESSION['ordId'])) {
	// CURRENT SESSION ID
	$sid = session_id();
	
	//Remove Items From Cart
	$cartIds	= $cart->getCartIds();
	if(count($cartIds) > 0) {
		foreach($cartIds as $c)
		{
			$cart->deleteFromCart($c);
		}
	}
	
	//order status
	$statusCode	= $orderDetail[13];
	//$statusName = $ordObj->getOrdStatName($statusCode);

	//'txtName','txtPhone','txtEmail', 'txtAddress','txtCity','txtState','txtPostalCode'
	//send email to the customer and admin
	$to 		=   SITE_BILLING_NAME."<".SITE_BILLING_EMAIL.">";//EMAIL_FROM_TO_INFO Himadri Shekhar Roy<himadri.s.roy@ansysoft.com>
	$from 		=	$orderDetail[3]. "<".$orderDetail[15].">";
	$fromMail 	=	$orderDetail[15];
	
	//subject
	$subject	=	"Order from  ".$orderDetail[3]." - ".date("Y-m-d");
	
	//body 
	$body		= 	"<div style='auto; font-family: Verdana, Arial, Helvetica,
					sans-serif;
					font-size: 11px;
					color: #000000;
					'> 
						
						<div style='margin-bottom:20px;'>
						<div style=' float:right;'>
							<div style='padding-right:10px;'>
								<img src='".URL."/".LOGO_WITH_PATH."' width='".LOGO_WIDTH."' height='".LOGO_HEIGHT."' />
							</div>
						</div>
						
						<div align='left' 
						style='padding-top:40px; font-family: Arial, Helvetica, sans-serif;
						font-size: 14px; color: #000000;font-style: normal;font-weight: 900;'>
							 Order from - ".$orderDetail[3]." 
						</div>
						
						<div style='clear:right'></div>
					   </div>
					
					  <div style='margin:0 0 40px 0'>
						<div style='margin:0 0 20px 0; font-weight:bold'>Personal Detail</div>
						<table width='545'' border='0' 
						 style='font-family: Verdana, Arial, Helvetica, sans-serif;
								font-size: 11px;
								color: #000000; border:1px solid #666666'>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>NAME: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[3]."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>EMAIL: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[15]."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>BUSINESS NAME: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[17]."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>CITY: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[6]."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>STATE: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[9]."
							</td>
						  </tr>
						  
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>POSTAL CODE: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[7]."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PHONE: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[8]."
							</td>
						  </tr>
						  
						  
						</table>
					  </div>
					  
					  <div style='margin:0 0 40px 0'>
						<div style='margin:0 0 20px 0; font-weight:bold'>Transaction Detail</div>
						<table width='545'' border='0' 
						 style='font-family: Verdana, Arial, Helvetica, sans-serif;
								font-size: 11px;
								color: #000000; border:1px solid #666666'>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>ORDER CODE: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[2]."
							</td>
						  </tr>
						  
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>AMOUNT: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$utility->priceFormat($orderDetail[1])."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PLACED ON: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$dateUtil->printDate4($orderDetail[11])."
							</td>
						  </tr>
							  
						  
						</table>
						
					  </div>
					  
					 </div>
					 
					 
					 <div style='margin:0 0 40px 0'>
						<div style='margin:0 0 20px 0; font-weight:bold'>Order Details</div>
						<table width='545' border='0' cellpadding='0' cellspacing='0' 
						 style='font-family: Verdana, Arial, Helvetica, sans-serif;
								font-size: 11px;
								color: #000000; border:1px solid #666666'>
						 	
							<tr
								style='font: bold 12px Verdana, Arial, Helvetica, sans-serif;
								color: #000000; border:1px solid #666666'>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>Domain Name</td>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>Niche</td>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>
								Price</td>
								<td style='border-bottom:1px solid #666666;'>Url</td>
							</tr>
						 ";
						 
						 if($checkPackage == false) {
						 if(count($prodIds) > 0) {
							 foreach($prodIds as $p)
							 {
								$domainDtl	= $domain->showDomains($p);
								
								
						 
			$body		.=  "		
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>
								".$domainDtl[0]."
							</td>
						  
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>
								".$domainDtl[1]."
							</td>
						  
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>
								".$domainDtl[17]."
							</td>
						  
							<td style='border-bottom:1px solid #666666;'>
								<a href='".$domainDtl[9]."'>".$orderDetail[9]."</a>
							</td>
						  </tr>";
						  
								}
						}
						}
						else{
						  if(count($packageIds) > 0) {
							 foreach($packageIds as $pck)
							 {
								  $packageDtl	= $package->getPackageData($pck);
								  $body		.=  "		
								  <tr>
									<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>Package Name: </td>
									<td style='border-bottom:1px solid #666666;'>&nbsp;
										".$packageDtl[0]."
									</td>
								  </tr>
								  <tr>
									<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>Price: </td>
									<td style='border-bottom:1px solid #666666;'>&nbsp;
										".$packageDtl[4]."
									</td>
								  </tr>
								  <tr>
									<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>Contact Name: </td>
									<td style='border-bottom:1px solid #666666;'>&nbsp;
										".$orderDetail[11]."
									</td>
								  </tr>
								  <tr>
									<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>Turn Around Time: </td>
									<td style='border-bottom:1px solid #666666;'>&nbsp;
										".$packageDtl[9]." days
									</td>
								  </tr>";
							 }
						  }
						}
						  
			$body		.=  "</table>
						
					  </div>
					  
					 </div>
					 ";
					
	$body		.= 	"	</div>
					 </div>";
					
	
	//normal mail
	$headers  = "From: ".$from."\r\n";
	$headers .= "Return-Path: <".$fromMail.">\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1";
	
	@mail($to, $subject, $body, $headers);
	
	//mail to the user
	$toC 		=   $orderDetail[3]. "<".$orderDetail[15].">";//EMAIL_FROM_TO_INFO Himadri Shekhar Roy<himadri.s.roy@ansysoft.com>
	$fromC 		=	SITE_BILLING_NAME."<".SITE_BILLING_EMAIL.">";
	$fromMailC 	=	SITE_BILLING_EMAIL;
	
	//subject
	$subjectC	=	"Your Order Detail on - "." - ".date("Y-m-d");	
	$body		= 	"<div style='auto; font-family: Verdana, Arial, Helvetica,
					sans-serif;
					font-size: 11px;
					color: #000000;
					'> 
						
						<div style='margin-bottom:20px;'>
						<div style=' float:right;'>
							<div style='padding-right:10px;'>
								<img src='".URL."/".LOGO_WITH_PATH."' width='".LOGO_WIDTH."' height='".LOGO_HEIGHT."' />
							</div>
						</div>
						
						<div align='left' 
						style='padding-top:40px; font-family: Arial, Helvetica, sans-serif;
						font-size: 14px; color: #000000;font-style: normal;font-weight: 900;'>
							 Order from - ".$orderDetail[3]." 
						</div>
						
						<div style='clear:right'></div>
					   </div>
					
					  <div style='margin:0 0 40px 0'>
						<div style='margin:0 0 20px 0; font-weight:bold'>Personal Detail</div>
						<table width='545'' border='0' 
						 style='font-family: Verdana, Arial, Helvetica, sans-serif;
								font-size: 11px;
								color: #000000; border:1px solid #666666'>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>NAME: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[3]."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>EMAIL: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[15]."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>BUSINESS NAME: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[17]."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>CITY: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[6]."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>STATE: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[9]."
							</td>
						  </tr>
						  
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>POSTAL CODE: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[7]."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PHONE: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[8]."
							</td>
						  </tr>
						  
						  
						</table>
					  </div>
					  
					  <div style='margin:0 0 40px 0'>
						<div style='margin:0 0 20px 0; font-weight:bold'>Transaction Detail</div>
						<table width='545'' border='0' 
						 style='font-family: Verdana, Arial, Helvetica, sans-serif;
								font-size: 11px;
								color: #000000; border:1px solid #666666'>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>ORDER CODE: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$orderDetail[2]."
							</td>
						  </tr>
						  
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>AMOUNT: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$utility->priceFormat($orderDetail[1])."
							</td>
						  </tr>
						  <tr>
							<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>PLACED ON: </td>
							<td style='border-bottom:1px solid #666666;'>&nbsp;
								".$dateUtil->printDate4($orderDetail[11])."
							</td>
						  </tr>
							  
						  
						</table>
						
					  </div>
					  
					 </div>";
					 
					 
					
	$body		.= 	"	</div>
					 </div>";
	//normal mail
	$headersC  = "From: ".$fromC."\r\n";
	$headersC .= "Return-Path: <".$fromMailC.">\r\n";
	$headersC .= "Content-type: text/html; charset=iso-8859-1";
	
	@mail($toC, $subjectC, $body, $headersC);
	
	//session array
	$sess_arr = array('txtName','txtPhone','txtEmail', 'txtAddress','txtCity','txtState','txtPostalCode', 
					  'ordId', 'ordKey', 'ordAmt');
	
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
		}
		else if($_POST['txtTargetUrl'][$i] == '') {
			$error->showErrorTA($action, $id, $id_var, $url, ERGUESTPOST002, $typeM, $anchor);
		}
		else
		{
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/payment-status.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">


    <!-- JavaScript -->

    <!-- eof JavaScript -->

</head>


<body>

    <!-- Start  Header -->
    <?php require_once "partials/header.inc.php"; ?>
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
            <div class="col-11 col-md-10 mt-3 mt-md-5 p-4 ">
                <div class="row border p-4">
                    <div class="col-12 col-md-6">
                        <p class="fs-6 fw-semibold text-primary">Anchor Text:</p>
						<input type="text" class="form-control border-0" id="anchorText" aria-describedby="anchorText" value="<?php echo $orderDetail['clientAnchorText']; ?>">
                    </div>
                    <div class="col-12 col-md-6 mt-3 mt-md-0">
                        <p class="fs-6 fw-semibold text-primary">URL:</p>
						<input type="text" class="form-control border-0" id="anchorText" aria-describedby="anchorText" value="<?php echo $orderDetail['clientTargetUrl']; ?>">
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <p class="fs-6 fw-semibold text-primary">Content: </p>
						<textarea class="form-control border-0" id="content" rows="6"><?php echo $orderDetail['clientAnchorText']; ?></textarea>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
						<p class="fs-6 fw-semibold text-primary">Special Requirements: </p>
						<textarea class="form-control border-0" id="exampleFormControlTextarea1" rows="6"><?php echo $orderDetail['clientRequirement']; ?></textarea>
					</div>
                </div>
            </div>

            <div class="col-11 col-md-10 mb-3 mb-md-5 p-4 text-center">
				<p>Your order status will updated to you, Now you can go back.</p>
				<div class="mt-3">
					<a class="btn btn-primary" href="index.php">Home</a>
					<a class="btn btn-primary" href="app.client.php">My Account</a>
				</div>
			</div>
        </div>


        <!-- Start header Image -->
        <div class="content-wrap">

            <!-- <div class="divorce-title-description">
                <h2>Thanking you for your payment</h2>

                <p class="padT20">
                    We have received your payment. You will receive email shortly in your account.
                </p>
                <p>
                    If you find any difficulty, drop an email to <?php echo SITE_BILLING_EMAIL ?>
                </p>

            </div> -->
            <!-- <form id="requirementsform" name="requirementsform" action="" method="post" enctype="multipart/form-data"
                autocomplete="off">
                <h2>Special Requirements</h2>
                <div id="errorMsg"><?php $uMesg->dispMessage($typeM, 'images/icon/', 'blackLarge');?></div>
                <div class="cart-details-table">
                    <table class="heading-table" id="" border="0" cellpadding="0" cellspacing="0">
                        <tr class="heading-row">
                            <th width="5%" align="center">SN</th>
                            <th width="30%" align="center">Anchor Text</th>
                            <th width="30%" align="center">Target URL</th>
                            <th width="35%" align="center">Requirements</th>
                        </tr>
                    </table>

                    <div class="full-table-content">
                        ===table section 
                        <div class="table-section" id="cart-table">
                            <table class="continue-table" border="0">
                                <tr class="heading-row-border">
                                    <th width="5%" align="center"></th>
                                    <th width="30%" align="center"></th>
                                    <th width="30%" align="center"></th>
                                    <th width="35%" align="center"></th>
                                </tr>
                                <tbody>
                                    <?php 
								if($checkPackage == true)
								{
									if(count($packageIds) > 0) {
										$packageDtl	= $package->getPackageData($packageIds[0]);
										 ?>
                                    <input type="hidden" name="selNum" id="selNum"
                                        value="<?php echo $packageDtl[7] ?>" />
                                    <?php
										for($k = 0; $k < $packageDtl[7]; $k++) {
										  
								?>
                                    <tr>
                                        <td><?php echo $k+1 ?></td>
                                        <td><input type="text" class="text-field" name="txtAncharText[]"
                                                id="txtAncharText[]" placeholder="" /></td>
                                        <td><input type="text" class="text-field" name="txtTargetUrl[]"
                                                id="txtTargetUrl[]" placeholder="" /></td>
                                        <td><textarea class="requirements-area" id="txtRequirement[]"
                                                name="txtRequirement[]"></textarea></td>
                                    </tr>
                                    <?php 	
										}
									}
								}
								else {
									if(count($prodIds) > 0) {
										?>
                                    <input type="hidden" name="selNum" id="selNum"
                                        value="<?php echo count($prodIds) ?>" />
                                    <?php
										for($k = 0; $k < count($prodIds); $k++) {
										?>
                                    <tr>
                                        <td><?php echo $k+1 ?></td>
                                        <td><input type="text" class="text-field" name="txtAncharText[]"
                                                id="txtAncharText[]" placeholder="" /></td>
                                        <td><input type="text" class="text-field" name="txtTargetUrl[]"
                                                id="txtTargetUrl[]" placeholder="" /></td>
                                        <td><textarea class="requirements-area" id="txtRequirement[]"
                                                name="txtRequirement[]"></textarea></td>
                                    </tr>
                                    <?php	
										}
									}
								}
								?>
                                </tbody>
                            </table>
                        </div>
                         =====eof table section

                    </div>
                    <div class="sumbitt-button">
                        <input type="submit" name="reqSubmit" id="reqSubmit" class="btnSubscribe" value="Submit" />
                    </div>
                    <div class="cl"></div>
                </div>
            </form> -->


        </div>
    </div>
    <div class="mainWrapBottom"></div>
    <!-- End  MainWrap -->

    <!-- Start Foter -->
    <?php require_once "partials/footer.inc.php"; ?>


	<script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
    <!-- End Foter -->
</body>

</html>