<?php 
session_start();
// var_dump($_SESSION);
$niche              = $_SESSION['niche'];
$clientUserId       = $_SESSION['userid'];
$clientName         = $_SESSION['name'];
$orderPackagePrice  = $_SESSION['orderPrice'];
$clientEmail        = $_SESSION['USERcontinuecontent_ecom_SESS2016'];
// require_once("_config/connect.php");
require_once "_config/dbconnect.php";
require_once "_config/dbconnect.trait.php";
require_once "classes/client-order.class.php";
include('Crypto.php');
require_once("includes/paypal.inc.php");

$x = file_get_contents("http://api.currencylayer.com/live?access_key=8a2f585d514c46191c359ccab7f7ebaf");
    $response_data = json_decode($x);
    print_r($response_data);
    $val = $response_data->quotes->USDINR;

    $inrUsd =$val*$orderPackagePrice;
    $tid = rand() ;
  $paymentArray = array(
    "tid"=>$tid,
    "merchant_id"=>284544,
    "order_id"=>22,
    "amount"=>$inrUsd,
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
<!-- <script language='javascript'>document.redirect.submit();</script> -->





