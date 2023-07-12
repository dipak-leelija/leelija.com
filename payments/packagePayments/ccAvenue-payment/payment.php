<?php
ini_set("display_errors", 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
//following files included to insert order into database
require_once "../../../_config/dbconnect.php";
require_once "../../../_config/dbconnect.trait.php";
require_once "../../../includes/constant.inc.php";

require_once "../../currency-convert.php";

require_once "../../../classes/gp-order.class.php";
require_once "../../../classes/customer.class.php";
require_once "../../../classes/utility.class.php";
require_once "../../../classes/countries.class.php";



$customer   = new Customer();
$utility	= new Utility();
$gp			= new Gporder();
$country	= new Countries();

$typeM		= $utility->returnGetVar('typeM','');
$cusId	    = $utility->returnSess('userid', 0);//user id
$cusDtl		= $customer->getCustomerData($cusId);


if (!isset($_SESSION['package-order-id'])) {
    header("Location ".$_SESSION['reorder-page']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $paymentData    = $_POST['paymentData'];
    $package_id     = $_POST['package-type'];
    $niche        	= $_POST['niche'];
    $package_amount = $_POST['amount'];
    $customerId   	= $_POST['customer_id'];
    $customerName   = $_POST['package-name'];
    $contact        = $_POST['contact-no'];
    $customerEmail  = $_POST['package-email'];
    $customerAddr   = $_POST['package-add'];
    $customerZip    = $_POST['package-pin'];
    $customerCntry  = $_POST['packageCountry'];
    $customerNotes  = $_POST['package-Note'];
    $paypal_ordKey  = "";
    $cc_ordered_key = "";
    $status         = "pending";
    $paymentType    = "ccavenue";

    $insertPackData = $gp->insertPackageOrder($package_id,$niche, $customerId, $customerName, $customerEmail,$customerAddr,$customerZip, $customerCntry, $customerNotes, $paymentType, $paypal_ordKey,$cc_ordered_key,$status);
        
    if($insertPackData){
        $_SESSION['package-order-id'] = $insertPackData;
        $_SESSION['order-amount']     = $package_amount;

        $amountinInr = currencyConvert($package_amount, "USD", "INR");

    }else{
        echo "<h1 style='text-aling= center;'>Something is Wrong !!</h1>";
    }

	$countriesDtls 	= $country->showCountry($customerCntry);
    $countryName    = $countriesDtls[0][0];

}else {
    header("Location: ../../../../"); // redirect no post request found
}



$state   = "GLOBAL";
if ($cusDtl[0][28] != '') {
    $state = $cusDtl[0][28];
}
if ($contact == '') {
    $contact = '0000000000';
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
    <meta name="viewport" content="width=device-width, initial-scale=1">


</head>

<body>

    <style>
    body {
        height: 100vh;
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


    <div class="rrdiv">
        <h1>Please do not refresh this page!</h1>
        <h4><span><img src="../../../images/icons/loading.gif" alt="loading"></span>Taking you to the payment page.</h4>
    </div>


    <form method="post" name="customerData" action="pay-now.php" style="visibility: collapse" id="ccavForm">
        <input type="text" name="tid" id="tid" readonly />  
        <input type="text" name="merchant_id"   value="284544" />  
        <input type="text" name="order_id"      value="<?php echo $insertPackData; ?>" />  
        <input type="text" name="amount"        value="<?php echo $amountinInr; ?>" />  
        <input type="text" name="currency"      value="INR" />  

        <input type="text" name="redirect_url"
                        value="https://www.leelija.com/payments/packagePayments/ccAvenue-payment/payment-status.php" />
        <input type="text" name="cancel_url"
                        value="https://www.leelija.com/payments/packagePayments/ccAvenue-payment/payment-status.php" />
        <input type="text" name="language" value="EN" />  
        
        <!-- Billing Details : -->
        <input type="text" name="billing_name"    value="<?php echo $customerName; ?>" />  
        <input type="text" name="billing_address" value="<?php echo $customerAddr; ?>" />  
        <input type="text" name="billing_city"    value="<?php echo $customerAddr; ?>" />  
        <input type="text" name="billing_state"   value="<?php echo $state; ?>" />  
        <input type="text" name="billing_zip"     value="<?php echo $customerZip; ?>" />  
        <input type="text" name="billing_country" value="<?php echo $countryName; ?>" />  
        <input type="text" name="billing_tel"     value="<?php echo $contact; ?>" />  
        <input type="text" name="billing_email"   value="<?php echo $customerEmail; ?>" />  

        <input type="text" name="merchant_param1" value="<?php echo $_SESSION['userid'];?>" />
        <input type="text" name="merchant_param2" value="<?php echo $_SESSION['return_url']; ?>" />
        <input type="text" name="merchant_param3" value="" />
        <input type="text" name="merchant_param4" value="" />
        <input type="text" name="merchant_param5" value="<?php echo $_SESSION['reorder-page']; ?>" />


        <input type="text" name="promo_code" value="" />  
        <input type="text" name="customer_identifier" value="" />  
        <input type="text" name="integration_type" value="iframe_normal" />  
        
        <INPUT TYPE="submit" value="CheckOut">

    </form>

    <script>
        document.getElementById("ccavForm").submit();
    </script>

</body>

</html>