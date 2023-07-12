<?php 
session_start();
//include_once('checkSession.php');
// require_once("_config/connect.php"); 
require_once "_config/dbconnect.php";
require_once "_config/dbconnect.trait.php";
require_once("includes/constant.inc.php");
require_once("classes/date.class.php");  
require_once("classes/error.class.php"); 
require_once("classes/search.class.php");	
require_once("classes/customer.class.php");
require_once("classes/order.class.php"); 
require_once("classes/checkout.class.php");
require_once("classes/login.class.php"); 
require_once("includes/paypal.inc.php");

require_once("classes/countries.class.php"); 
require_once("classes/blog_mst.class.php"); 
require_once("classes/domain.class.php"); 
require_once("classes/utility.class.php"); 
require_once("classes/utilityMesg.class.php"); 
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$order			= new Order();
$checkout		= new Checkout();

$country		= new Countries();
$blogMst		= new BlogMst();
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

###############################################################################################

//declare vars
$typeM			= $utility->returnGetVar('typeM','');
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay',10);

if(!isset($_SESSION['ordId']))
{
	header("Location: index.php"); 
}

//get the order detail, and reassign them to session
$orderDetail = $order->getOrderLandingData($_SESSION['ordId']);

//'txtName','txtPhone','txtEmail', 'txtAddress','txtCity','txtState','txtPostalCode'
//'ordId', 'ordKey', 'ordAmt'

$_SESSION['txtName'] 		= $orderDetail[3];
$_SESSION['txtAddress']		= $orderDetail[4]." ".$orderDetail[5];

$_SESSION['txtCity']		= $orderDetail[6];
$_SESSION['txtState']		= $orderDetail[9];
$_SESSION['txtPostalCode']	= $orderDetail[7];
$_SESSION['txtPhone']		= $orderDetail[8];

$_SESSION['txtEmail']		= $orderDetail[15];
$_SESSION['ordAmt']			= doubleval($orderDetail[1]);

$_SESSION['ordCode']		= $orderDetail[2];


?>
<div id="header">
    <div class="content">
        <!--  header left  -->
        <div class="header-left">
            <a href="index.php" title="Continue Content">
                <img src="<?php echo URL ?>images/logo/logo.png" id="logo" alt="Continue Content Logo" title="Continue Content logo"/>
            </a>
            <div class="cl"></div>
        </div>
        <!--  eof header left  -->
        <?php// exit; ?>
        <!--  header right  -->
        <div class="header-right">
            <!-- Navigation -->
            <?php //require_once('navigation.inc.php'); ?>
            <!-- eof Navigation -->
        </div>
        <!--  eof header right  -->
        <div class="cl"></div>
    </div>
</div>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="frmPaypal">
<?php /*?>https://sandbox.paypal.com/cgi-bin/webscr<?php */?>
  <input type="hidden" name="cmd" value="_xclick">

  <?php /*?><input type="hidden" name="bn" value="webassist.dreamweaver.4_0_3"><?php */?>								
  
  <input type="hidden" name="business" 		value="<?php echo PAYPAL_BUSINESS; ?>">
  
  <input type="hidden" name="receiver_id" 	value="VW5QDW95ZPFYG">
  
  <input type="hidden" name="item_name" 	value="<?php echo $_SESSION['ordCode']; ?>">

  <input type="hidden" name="item_number" 	value="<?php echo $_SESSION['ordCode']; ?>">

  <input type="hidden" name="amount" 		value="<?php echo $_SESSION['ordAmt'];// ?>">

  <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY_CODE; ?>">

 <!--  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>><input type="hidden" name="shipping" 		value="0">-->

   
  <input type="hidden" name="no_shipping" value="<?php echo PAYPAL_DISPLAY_SHIPPING_ADDRESS; ?>">

  <input type="hidden" name="handling" 		value="0">

  <input type="hidden" name="image_url" 	value="">

  <input type="hidden" name="return" 		value="<?php echo  PAYPAL_SITE_URL . PAYPAL_NOTIFY_URL; ?>">

  <input type="hidden" name="cancel_return" value="<?php echo  PAYPAL_CANCEL_URL; ?>">
  
  <input type="hidden" name="notify_url" 	value="<?php echo  PAYPAL_SITE_URL . PAYPAL_NOTIFY_URL; ?>">

  <input type="hidden" name="first_name" 	value="<?php echo $_SESSION['txtName']; ?>">
  
  <input type="hidden" name="last_name" 	value="<?php echo ''; ?>">
  
  <input type="hidden" name="address1" 		value="<?php echo $_SESSION['txtAddress']; ?>">
  
  <input type="hidden" name="address2" 		value="<?php echo ''; ?>">

  <input type="hidden" name="city" 			value="<?php echo $_SESSION['txtCity']; ?>">								

  <input type="hidden" name="state" 		value="<?php echo $_SESSION['txtState']; ?>"> 

  <input type="hidden" name="zip" 			value="<?php $_SESSION['txtPostalCode']; ?>">

  <input type="hidden" name="day_phone_a" 	value="<?php echo $_SESSION['txtPhone']; ?>">

  <input type="hidden" name="email" 		value="<?php echo $_SESSION['txtEmail']; ?>">
 
  <div style="padding:10px;">
	<img src="images/icon/ajax-loader.gif" width="220" height="19" alt="Page Loading. Please Wait..." />
  </div>
</form>

<script language="JavaScript" type="text/javascript">
window.onload=function() {
	window.document.frmPaypal.submit();
}
</script>




<!-- Warning: Undefined property: stdClass::$company_name in C:\xampp\htdocs\leelija.in3.0\classes\order.class.php on line 217

Warning: Undefined property: stdClass::$trxn_id in C:\xampp\htdocs\leelija.in3.0\classes\order.class.php on line 218 -->
