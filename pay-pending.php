<?php 
session_start();
require_once("_config/connect.php");

require_once("includes/constant.inc.php");
require_once("includes/user.inc.php");
require_once("includes/email.inc.php");
require_once("includes/registration.inc.php");
require_once("includes/company_contact.inc.php");
require_once("includes/order_landing.inc.php");
require_once("includes/paypal.inc.php");

require_once("classes/error.class.php"); 
require_once("classes/date.class.php"); 

require_once("classes/order.class.php");

require_once("classes/utility.class.php"); 
require_once("classes/utilityMesg.class.php"); 
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");
require_once("classes/utilityStr.class.php");

/* INSTANTIATING CLASSES */
$error			= new Error();
$dateUtil		= new DateUtil();


$ordObj			= new Order();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$uStr 			= new StrUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');


//check if session exists or not
if( (!isset($_SESSION['ordId'])) || (!isset($_SESSION['pay_pending'])) || (!isset($_SESSION['trxn_id'])))
{
	header("Location: order.php");
}

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

//get the order detail, and reassign them to session
$orderDetail = $ordObj->getOrderLandingData($_SESSION['ordId']);
$prodIds	 = $utility->getAllIdByCond('product_id', 'orders_id', $_SESSION['ordId'], 'orders_products', 'orders_products_id');
$packageIds	 = $utility->getAllIdByCond('package_id', 'orders_id', $_SESSION['ordId'], 'orders_products', 'orders_products_id');
$checkPackage = false;
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
//order status
$statusCode	= $orderDetail[13];


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
							<table width='545'' border='0' 
							 style='font-family: Verdana, Arial, Helvetica, sans-serif;
									font-size: 11px;
									color: #000000; border:1px solid #666666'>
							 ";
							 if($checkPackage == false) {
							 if(count($prodIds) > 0) {
								 foreach($prodIds as $p)
								 {
									$blogDtl	= $prod->showProduct($p);
									
								
							 
				$body		.=  "		
							  <tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>Domain: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$blogDtl[0]."
								</td>
							  </tr>
							  <tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>Email: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$blogDtl[10]."
								</td>
							  </tr>
							  <tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>Contact Name: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									".$orderDetail[11]."
								</td>
							  </tr>
							  <tr>
								<td style='border-bottom:1px solid #666666;border-right:1px solid #666666;'>Url: </td>
								<td style='border-bottom:1px solid #666666;'>&nbsp;
									<a href='".$orderDetail[13]."'>".$orderDetail[13]."</a>
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
		                  'ordId', 'ordKey', 'ordAmt', 'pay_pending', 'trxn_id');
		
		//delete the session
		$utility->delSessArr($sess_arr);
		
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Pending - Order Received</title>
<link rel="stylesheet" href="<?php /*?><?php echo URL ?><?php */?>style/ansysoft.css" type="text/css" />

<!-- JavaScript -->

<!-- eof JavaScript -->

</head>


<body>

	<!-- Start  Header -->
	<?php require_once('header.inc.php'); ?>
    <!-- End  Header -->
  
    <!-- Start  MainWrap -->
    <div id="mainWrap">
		
    	
		<!-- Start header Image -->
        <div class="content-wrap">
            
            <div class="divorce-title-description">
                <h2>Thanking you for your payment</h2>
                
                <p class="padT20">
                	Your Payment is in pending state. You will receive email shortly in your account.
                    
                </p>
                <p>
                	If you find any difficulty, drop an email to <?php echo SITE_BILLING_EMAIL ?>
                </p>
                <div align="center" class="padT10">
                    <a href="<?php echo URL ?>index.php" title="Return to Home" class="read-more" 
                    href="javascript:void()" title="Read More">Return to Home</a>
                </div>
            </div>
            
            
            
		</div>
    </div>
    <div class="mainWrapBottom"></div>
    <!-- End  MainWrap -->
    
    <!-- Start Foter -->
    <?php require_once('footer.inc.php'); ?>
    

	<!-- End Foter -->
</body>
</html>