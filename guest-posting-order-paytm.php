<?php 
session_start();
// var_dump($_SESSION);
$niche = $_SESSION['niche'];
$clientUserId= $_SESSION['userid'];
$clientName= $_SESSION['name'];
$orderPackagePrice = $_SESSION['orderPrice'];
// require_once("_config/connect.php");
require_once "_config/dbconnect.php";
require_once("classes/client-order.class.php");
include('Crypto.php');
require_once("includes/paypal.inc.php");
 ?>
    <form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmPaypal">
      <input type="hidden" name="cmd" value="_xclick">
    
      <input type="hidden" name="business" 		value="<?php echo PAYPAL_BUSINESS; ?>">
    
      <input type="hidden" name="receiver_id" 	value="VW5QDW95ZPFYG">
    
      <input type="hidden" name="item_name" 	value="<?php echo $niche; ?>">
    
      <input type="hidden" name="item_number" 	value="<?php echo "1"; ?>">
    
      <input type="hidden" name="amount" 		value="<?php echo $orderPackagePrice ; ?>">
    
      <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY_CODE; ?>">
    
     <!--  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>><input type="hidden" name="shipping" 		value="0">-->
    
    
      <input type="hidden" name="no_shipping" value="<?php echo PAYPAL_DISPLAY_SHIPPING_ADDRESS; ?>">
    
      <input type="hidden" name="handling" 		value="0">
    
      <input type="hidden" name="image_url" 	value="">
    
      <input type="hidden" name="return" 		value="https://www.leelija.com/check.php">
    
      <input type="hidden" name="cancel_return" value="<?php echo  PAYPAL_SITE_URL . PAYPAL_CANCEL_URL; ?>">
    
      <input type="hidden" name="notify_url" 	value="<?php echo  PAYPAL_SITE_URL . PAYPAL_NOTIFY_URL; ?>">
    
      <input type="hidden" name="first_name" 	value="<?php echo $clientName ; ?>">
    
      <input type="hidden" name="last_name" 	value="">
    
      <input type="hidden" name="address1" 		value="">
    
      <input type="hidden" name="address2" 		value="">
    
      <input type="hidden" name="city" 			value="">
    
      <input type="hidden" name="state" 		value="">
    
      <input type="hidden" name="zip" 			value="">
    
      <input type="hidden" name="day_phone_a" 	value="">
    
      <input type="hidden" name="email" 		value="">
    
      <div style="padding:10px;">
      <img src="images/icon/ajax-loader.gif" width="220" height="19" alt="Page Loading. Please Wait..." />
      </div>
    </form>
    
    <script language="JavaScript" type="text/javascript">
    window.onload=function() {
      window.document.frmPaypal.submit();
    }
    </script>
 