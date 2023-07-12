<?php 
session_start();
require_once "_config/dbconnect.php";
require_once "_config/dbconnect.trait.php";

$clientUserId= $_SESSION['userid'];
$clientName= $_SESSION['name'];
$clientEmail= $_SESSION['USERcontinuecontent_ecom_SESS2016'];
$clientOrderedSite = $_REQUEST['domainName2'];
$clientOrderPrice = $_REQUEST['sitePrice2'];
// require_once("_config/connect.php");
require_once("classes/client-order.class.php");
include('Crypto.php');
require_once("includes/paypal.inc.php");
$clientOrderModel = new ClientOrder();

if(isset($_POST['OrderNowPaypal2']) || isset($_POST['orderNowCcavenue2'])){
  $clientContent1 = '';
  $clientTargetUrl = $_POST['clientTargetUrl2'];
  $clientAnchorText = $_POST['clientAnchorText2'];
  $clientRequirement = $_POST['clientRequirement2'];
  $tid    = $_POST['tid'];

  $clientOrderData=$clientOrderModel->ClientOrderDetails($clientUserId,$clientName,$clientEmail,$clientOrderedSite,$clientTargetUrl,$clientAnchorText,$clientContent1,$clientRequirement,$clientOrderPrice);

//   $contentPrice = 15;

//   $contentOrderPrice = $clientOrderPrice +$contentPrice ;

}


if(isset($_POST['OrderNowPaypal2'])){ 

?>
    <form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmPaypal">
      <input type="hidden" name="cmd" value="_xclick">
    
      <input type="hidden" name="business" 		value="<?php echo PAYPAL_BUSINESS; ?>">
    
      <input type="hidden" name="receiver_id" 	value="VW5QDW95ZPFYG">
    
      <input type="hidden" name="item_name" 	value="<?php echo $clientOrderedSite; ?>">
    
      <input type="hidden" name="item_number" 	value="<?php echo $clientUserId; ?>">
    
      <input type="hidden" name="amount" 		value="<?php echo $clientOrderPrice ; ?>">
    
      <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY_CODE; ?>">
    
     <!--  >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>><input type="hidden" name="shipping" 		value="0">-->
    
    
      <input type="hidden" name="no_shipping" value="<?php echo PAYPAL_DISPLAY_SHIPPING_ADDRESS; ?>">
    
      <input type="hidden" name="handling" 		value="0">
    
      <input type="hidden" name="image_url" 	value="">
    
      <input type="hidden" name="return" 		value="<?php echo  PAYPAL_SITE_URL . PAYPAL_NOTIFY_URL; ?>">
    
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
 <?php }
  elseif(isset($_POST['orderNowCcavenue2'])){

    $x = file_get_contents("http://api.currencylayer.com/live?access_key=8a2f585d514c46191c359ccab7f7ebaf");
    $response_data = json_decode($x);
    $val = $response_data->quotes->USDINR;
    $contentfees = 15;
    $contentPrice=$val*$contentfees;
    $inrUsd = $val*$clientOrderPrice;
    $inrUsdTotal =$inrUsd+$contentPrice;
   
  $paymentArray = array(
    "tid"=>$tid,
    "merchant_id"=>284544,
    "order_id"=>22,
    "amount"=>$inrUsdTotal,
    "currency"=>'INR',
    "redirect_url"=>'https://leelija.com/payment/ccavResponseHandler.php',
    "cancel_url"=>'https://leelija.com/payment/ccavResponseHandler.php',
    "language"=>'EN',
    "billing_name"=> $clientName,
    "billing_address"=>'',
    "billing_city"=>'',
    "billing_state"=>'',
    "billing_zip"=>'',
    "billing_country"=>'',
    "billing_tel"=>'',
    "billing_email"=>$clientEmail,
    "delivery_name"=> $clientName,
    "delivery_address"=>'',
    "delivery_city"=>'',
    "delivery_state"=>'',
    "delivery_zip"=>'',
    "delivery_country"=>'',
    "delivery_tel"=>'',
    "merchant_param1"=>'',
    "merchant_param2"=>'',
    "merchant_param3"=>'',
    "merchant_param4"=>'',
    "merchant_param5"=>'',
    "promo_code"=>'',
    "customer_identifier"=>'',
);
$merchant_data= '';
	$working_key='23AA922A82711D538A1ED6BBE222DD01';//Shared by CCAVENUES
	$access_code='AVAM96HK83BN94MANB';//Shared by CCAVENUES
	
	foreach ($paymentArray as $key => $value){
        $merchant_data.=$key.'='.$value.'&';
	}
	// var_dump($merchant_data);
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>

<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">    <?php 
echo  "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";  
?>
</form>
<script language='javascript'>document.redirect.submit();</script>


<?php  } ?>


