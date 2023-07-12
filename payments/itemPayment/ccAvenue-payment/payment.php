<?php
session_start();
// header("Pragma: no-cache");
// header("Cache-Control: no-cache");
// header("Expires: 0");

//following files included to insert order into database
require_once "../../../_config/dbconnect.php";
require_once "../../../_config/dbconnect.trait.php";
require_once "../../../includes/constant.inc.php";

require_once "../../currency-convert.php";

// require_once "../../../classes/gp-order.class.php";
require_once "../../../classes/order.class.php"; 
require_once "../../../classes/domain.class.php"; 
require_once "../../../classes/error.class.php"; 
require_once "../../../classes/customer.class.php";
require_once "../../../classes/countries.class.php";
require_once "../../../classes/checkout.class.php";
require_once "../../../classes/countries.class.php"; 
require_once "../../../classes/utility.class.php";





/* INSTANTIATING CLASSES */
$checkout		= new Checkout();
$domain			= new Domain();
$order			= new Order();
$myError 		= new MyError();
$customer       = new Customer();
$utility	    = new Utility();
// $gp			= new Gporder();
$country	    = new Countries();


$typeM		= $utility->returnGetVar('typeM','');
$cusId	    = $utility->returnSess('userid', 0);//user id

$cusDtl		= $customer->getCustomerData($cusId);




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['btnSubmit'])){
        
            //post var
            $txtBillingName 			= $_POST['txtBillingName'];
            $phoneNo 			        = $_POST['contact-no'];
            $billingState 			    = $_POST['txtBillingState'];
            $txtBillingEmail	  		= $_POST['txtBillingEmail'];
            $txtBillingAdd 				= $_POST['txtBillingAdd'];
            $txtPostCode 				= $_POST['txtPostCode'];
            $txtCountry  				= $_POST['txtCountry'];	//''
            $txtNotes  					= $_POST['txtNotes'];
            $paymentData                = $_POST['paymentData'];
    
            //defining error variables
            $action		= 'order_now';
            $url		= $_SERVER['PHP_SELF'];
            $id			= 0; 
            $id_var		= '';
            $anchor		= 'ordForm';
            $typeM		= 'ERROR';
    
            //registering the post session variables
            $sess_arr	= array('txtBillingName','txtBillingEmail','txtBillingAdd', 'txtPostCode','txtCountry');
            $utility->addPostSessArr($sess_arr);
            
            //check validity
            $invalidEmail 	= $myError->invalidEmail($txtBillingEmail);
    
            if(($txtBillingName == '')){
    
                $myError->showErrorTA($action, $id, $id_var, $url, ERORDERL001, $typeM, $anchor);
    
            }else if(($txtBillingAdd == '')){
    
                $myError->showErrorTA($action, $id, $id_var, $url, ERORDERL002, $typeM, $anchor);
    
            }else if(($invalidEmail == '')||(preg_match("/^ER/i",$invalidEmail))){
    
                $myError->showErrorTA($action, $id, $id_var, $url, ERORDERL003, $typeM, $anchor);
    
            }else if($txtPostCode == '') {
    
                $myError->showErrorTA($action, $id, $id_var, $url, ERORDERL004, $typeM, $anchor);
    
            }else{

                $client_dtl		= $customer->getCustomerData($cusId);

                //Update Customer details
                $customer->editCustomerDtls($cusId, $txtBillingName);
                
                $customer->updateCusAddress($cusId, $txtBillingAdd, $client_dtl[0][25], $client_dtl[0][26], $client_dtl[0][27], $client_dtl[0][28], $txtPostCode, $txtCountry, $client_dtl[0][31], $client_dtl[0][32], $client_dtl[0][33], $client_dtl[0][34]);
                
                //Add Orders
                $ordId	= $order->addOrder($cusId, $txtBillingName, $_SESSION['tAmount'], $client_dtl[0][5], $txtBillingAdd, $client_dtl[0][25], $client_dtl[0][26], $client_dtl[0][29], 
                $phoneNo, $billingState, $txtCountry, $txtBillingEmail, $txtNotes);
                
                $totalAmt = 0;
                $ordProdIds = array();
                foreach ($_SESSION["domain"] as $cart_itm){
    
                    $domainDtl		= $domain->showDomains($cart_itm['code']);
                    $ordProdIds[]	= $checkout->addOrdProd($ordId, 'domain', $domainDtl[19], '', $domainDtl[0], $domainDtl[17], $domainDtl[17], 0.0, 1);
                    $totalAmt		= $totalAmt + $domainDtl[17];
                }
                
                //generate order key
                $ordKey = $order->generateOrderCode('ORDER', $ordId);
                //order amount
                $ordAmt	= $totalAmt; //0.01;//$totalPrice;//0.01
                
                //update order code
                $order->updateOrderCode($ordId, $ordKey, $ordAmt);
               
                
                //update order status
                /**
                     * 
                     * ORDER STATUS CODE
                     * 1 = Delivered
                     * 2 = Pending
                     * 3 = Processing
                     * 4 = Oedered
                     * 
                     *  */ 
                $order->updateOrderStatus($ordId, 2);
    
                // delete some unnecessury sessions
                $sess_arr = array('tAmount','txtBillingName','txtBillingEmail','txtBillingAdd','txtPostCode','txtCountry','ordId');
                $utility->delSessArr($sess_arr);


                //hold order values in session
                $_SESSION['ordKey']	= $ordKey;

                // converting order amount from USD to INR
                $amountinInr = currencyConvert($ordAmt, "USD", "INR");

        }
    }else {
        // header("Location: ../../../../");
        echo "Error";
    }

    
	$countriesDtls 	= $country->showCountry($txtCountry);
    $countryName    = $countriesDtls[0][0];

}else {
    header("Location: ../../../"); // redirect no post request found
}


$state   = "GLOBAL";
if ($cusDtl[0][28] != '') {
    $state = $cusDtl[0][28];
}
$contact = '';
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
    <!--  -->
    <form method="post" name="customerData" action="pay-now.php" style="visibility: collapse" id="ccavForm">

        <input type="text" name="tid" id="tid" readonly />
        <input type="text" name="merchant_id"   value="284544" />
        <input type="text" name="order_id"      value="<?php echo $ordId; ?>" />
        <input type="text" name="amount"        value="<?php echo $amountinInr; ?>" />
        <input type="text" name="currency"      value="INR" />
        <input type="text" name="redirect_url"
            value="<?php echo URL; ?>/payments/itemPayment/ccAvenue-payment/payment-status.php" />
        <input type="text" name="cancel_url"
            value="<?php echo URL; ?>/payments/itemPayment/ccAvenue-payment/payment-status.php" />
        <input type="text" name="language"          value="EN" />

        <input type="text" name="billing_name"      value="<?php echo $txtBillingName; ?>" />
        <input type="text" name="billing_address"   value="<?php echo $txtBillingAdd; ?>" />
        <input type="text" name="billing_city"      value="<?php echo $txtBillingAdd; ?>" />
        <input type="text" name="billing_state"     value="<?php echo $state; ?>" />
        <input type="text" name="billing_zip"       value="<?php echo $txtPostCode; ?>" />
        <input type="text" name="billing_country"   value="<?php echo $countryName; ?>" />
        <input type="text" name="billing_tel"       value="<?php echo $contact; ?>" />
        <input type="text" name="billing_email"     value="<?php echo $txtBillingEmail; ?>" />

        <input type="text" name="delivery_name"         value="<?php echo $txtBillingName; ?>" />
        <input type="text" name="delivery_address"      value="<?php echo $txtBillingAdd; ?>" />
        <input type="text" name="delivery_city"         value="<?php echo $txtBillingAdd; ?>" />
        <input type="text" name="delivery_state"        value="<?php echo $state; ?>" />
        <input type="text" name="delivery_zip"          value="<?php echo $txtPostCode; ?>" />
        <input type="text" name="delivery_country"      value="<?php echo $countryName; ?>" />
        <input type="text" name="delivery_tel"          value="<?php echo $contact; ?>" />

        <input type="text" name="merchant_param1"     value="<?php echo $_SESSION['userid'];?>" />
        <input type="text" name="merchant_param2"     value="<?php echo $_SESSION['return_url']; ?>" />
        <input type="text" name="merchant_param3"     value="<?php echo $ordKey; ?>" />
        <input type="text" name="merchant_param4"     value="" />
        <input type="text" name="merchant_param5"     value="<?php echo $_SESSION['reorder-page']; ?>" />
        <input type="text" name="promo_code"          value="" />
        <input type="text" name="customer_identifier" value="" />
        <input type="text" name="integration_type"    value="iframe_normal" />

        <INPUT TYPE="submit" value="CheckOut">
    </form>


    <?php
// $_SESSION['return_url'];
// $_SESSION['USERcontinuecontent_ecom_SESS2016'];
// $_SESSION['name']; $_SESSION['welcome_name'];
// $_SESSION['userid']; $_SESSION['usertypeid'];
// $_SESSION['customer_type'];
// $_SESSION['package-type'];
// $_SESSION['niche'];
// $_SESSION['reorder-page'];
?>




    <script>
    document.getElementById("ccavForm").submit();
    </script>

</body>

</html>