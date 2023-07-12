<?php
session_start();
require_once "../../_config/dbconnect.php";
require_once "../../_config/dbconnect.trait.php";

require_once "../../includes/constant.inc.php";
require_once "../currency-convert.php";

require_once "../../classes/customer.class.php";
require_once "../../classes/content-order.class.php";
require_once "../../classes/countries.class.php";
require_once "../../classes/utility.class.php";


$ContentOrder     = new ContentOrder();
$Customer         = new Customer();
$country	      = new Countries();
$utility		  = new Utility();


$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $Customer->getCustomerData($cusId);


// <?php echo ;

// Fetching Client Details
$clientUserId             = $_SESSION['userid'];
$clientName               = $_SESSION['name'];
$clientEmail              = $_SESSION['USERcontinuecontent_ecom_SESS2016'];
// $clientEmail              =  $cusDtl[0][2];// Client Email 1
$clientAddr               = $cusDtl[0][24]; // Client Address 1
$clientCity               = $cusDtl[0][27]; // Client Town
$clientzip                = $cusDtl[0][29]; // Client Postcode
$clientState              = $cusDtl[0][28]; // Client Province
$clientCntry              = $cusDtl[0][30]; // Client Country
$clientContact            = $cusDtl[0][31]; // Client Phone 1

$clientOrderedSite        = $_SESSION['domainName'];
$clientOrderPrice         = $_SESSION['sitePrice'];
// $clientName               = $_SESSION['name'];


$countriesDtls 	= $country->showCountry($clientCntry);
$countryName    = $countriesDtls[0][0];

if ($clientContact == '') {
    $clientContact = '0000000000';
}
if ($clientState == '') {
    $clientState = 'GLOBAL';
}
if ($clientCity == '') {
    $clientCity = 'my city';
}
if ($clientzip == '') {
    $clientzip = '000000';
}



if($_POST['order-name'] == 'ccAvOrder' ){

    // foreach ($_POST as $key => $value) {
    //     echo $key.'=> '.$value;
    //     echo '<br>';
    // }

  $clientContent1     = $_POST['clientContent1'];
  $clientTargetUrl    = $_POST['clientTargetUrl'];
  $clientAnchorText   = $_POST['clientAnchorText'];
  $clientRequirement  = $_POST['clientRequirement'];
  $blogId             = $_POST['blogId'];
  $tid                = $_POST['tid'];
  
  

    /**
     * 
     * ORDER STATUS CODE
     * 1 = Delivered
     * 2 = Pending
     * 3 = Processing
     * 4 = Oedered
     * 
     *  */ 
  $clientOrderData = $ContentOrder->contentOrderDetails($clientUserId,$clientName,$clientEmail,$clientOrderedSite,$clientTargetUrl,$clientAnchorText,$clientContent1,$clientRequirement,$clientOrderPrice, 2);
  // var_dump( $clientOrderData);

  $_SESSION['orderId'] = $clientOrderData ;
//   print_r($_SESSION['orderId']);

// converting order amount from USD to INR
$amountinInr = currencyConvert($clientOrderPrice, "USD", "INR");
}
?>

<html>

<head>
    <script>
    window.onload = function() {
        var d = new Date().getTime();
        document.getElementById("tid").value = d;
    };
    </script>

    <style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .rrdiv {
        font-family: 'Poppons', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        align-items: center;
        text-align: center;
        justify-content: center;
    }

    @media screen and (max-width: 552px) {
        .rrdiv {
            margin: 15rem auto;
            align-items: center;
            text-align: center;
            justify-content: center;
            font-size: small;
        }
    }
    </style>


</head>

<body>

    <div class="rrdiv">
        <h1>Please do not refresh this page!</h1>
        <h4><span><img src="../../images/icons/loading.gif" alt="loading"></span>Taking you to the payment page.</h4>
    </div>


    <form method="post" name="customerData" action="pay-now.php">

        <input type="text" name="tid" id="tid" readonly />
        <input type="text" name="merchant_id"   value="284544" />
        <input type="text" name="order_id"      value="<?php echo $clientOrderData; ?>" />
        <input type="text" name="amount"        value="<?php echo $amountinInr; ?>" />
        <input type="text" name="currency"      value="INR" />
        <input type="text" name="redirect_url"  value="<?php echo URL; ?>/payments/gpwishlistOrder/paymentStatus.php" />
        <input type="text" name="cancel_url"    value="<?php echo URL; ?>/payments/gpwishlistOrder/paymentStatus.php" />
        <input type="text" name="language"      value="EN" />

        <input type="text" name="billing_name"      value="<?php echo $clientName;?>" />
        <input type="text" name="billing_address"   value="<?php echo $clientAddr;?>" />
        <input type="text" name="billing_city"      value="<?php echo $clientCity;?>" />
        <input type="text" name="billing_state"     value="<?php echo $clientState; ?>" />
        <input type="text" name="billing_zip"       value="<?php echo $clientzip; ?>" />
        <input type="text" name="billing_country"   value="India" />
        <input type="text" name="billing_tel"       value="<?php echo $clientContact; ?>" />
        <input type="text" name="billing_email"     value="<?php echo $clientEmail;?>" />

        <input type="text" name="delivery_name"     value="<?php echo $clientName;?>" />
        <input type="text" name="delivery_address"  value="<?php echo $clientAddr;?>" />
        <input type="text" name="delivery_city"     value="<?php echo $clientCity;?>" />
        <input type="text" name="delivery_state"    value="<?php echo $clientState; ?>" />
        <input type="text" name="delivery_zip"      value="<?php echo $clientzip; ?>" />
        <input type="text" name="delivery_country"  value="India" />
        <input type="text" name="delivery_tel"      value="<?php echo $clientContact; ?>" />

        <input type="text" name="merchant_param1"   value="<?php echo $_SESSION['userid']; ?>" />
        <input type="text" name="merchant_param2"   value="<?php echo $_SESSION['return_url']; ?>" />
        <input type="text" name="merchant_param3"   value="" />
        <input type="text" name="merchant_param4"   value="" />
        <input type="text" name="merchant_param5"   value="<?php echo $_SESSION['reorder-page']; ?>" />

        <input type="text" name="promo_code"            value="" />
        <input type="text" name="customer_identifier"   value="" />
        <input type="text" name="integration_type"      value="iframe_normal" />
        <INPUT TYPE="submit" value="CheckOut">

    </form>

    <script>
    // document.getElementById("ccavForm").submit();
    </script>
</body>

</html>