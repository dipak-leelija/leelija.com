<?php 
session_start();
require_once "_config/dbconnect.php";
require_once "_config/dbconnect.trait.php";

require_once "includes/paypal.inc.php";
require_once "includes/constant.inc.php";

require_once "classes/customer.class.php";
require_once "classes/content-order.class.php";
include "Crypto.php";

$ContentOrder     = new ContentOrder();
$Customer         = new Customer();



$clientUserId             = $_SESSION['userid'];
$clientName               = $_SESSION['name'];
$clientEmail              = $_SESSION['USERcontinuecontent_ecom_SESS2016'];

$clientOrderedSite        = $_REQUEST['domainName'];
$_SESSION['orderedSite']  = $_REQUEST['domainName'];
$clientOrderPrice         = $_REQUEST['sitePrice'];

// $cusDtl = $Customer->getCustomerData($clientUserId);
// print_r($cusDtl[0][5]);
// print_r($cusDtl[0][6]);


// echo "payment page need configuration";
// exit;

if(isset($_POST['OrderNowPaypal']) || isset($_POST['orderNowCcavenue'])){
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary | <?php echo COMPANY_S; ?></title>

    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700;900&display=swap" rel="stylesheet">
</head>

<body>
    <section class="container d-flex align-items-center flex-column" >
        <!-- <p class="text-center text-warning py-5 mb-0"><img src="images/icons/loading.gif" alt=""> Don't Click anywhere
            or go back, redirecting you to the payment page...</p> -->
        <div class="border px-2 mt-2">
            <div class="row justify-content-center">
                <div class="col-12 py-3 d-flex justify-content-center">
                    <img src="images/logo/logo.png" alt="">
                </div>
                <div class="col-11 pb-2 text-dark border bg-primary bg-opacity-10 ">
                    <div class="row">
                        <p class="row p-4 py-1 mb-0 fw-bolder">Product</p>
                        <div class="col-8 fw-semibold"><small><i class="far fa-circle text-primary"></i></small><span
                                class="fs-5"><?php echo $clientOrderedSite; ?></span></div>
                        <div class="col-4 fw-semibold text-center">Price: $<?php echo $clientOrderPrice;?></div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-12 col-md-6 mt-2 mt-md-3">
                    <label for="formGroupExampleInput" class="form-label fw-semibold">Customer Name:</label>
                    <input type="text" class="form-control rounded-0 border-primary bg-light "
                        style="--bs-border-opacity: 0.2;" id="customer-name" value="<?php echo $clientName;?>" disabled>
                </div>
                <div class="col-12 col-md-6 mt-2 mt-md-3">
                    <label for="formGroupExampleInput2" class="form-label fw-semibold">Seller Acount:</label>
                    <input type="text" class="form-control rounded-0 border-primary bg-light"
                        style="--bs-border-opacity: 0.2;" id="formGroupExampleInput2"
                        value="<?php echo PAYPAL_BUSINESS; ?>" disabled>
                </div>

                <div class="col-12 col-md-6 mt-2 mt-md-3">
                    <label for="formGroupExampleInput" class="form-label fw-semibold">Target Url:</label>
                    <input type="text" class="form-control rounded-0 border-primary bg-light"
                        style="--bs-border-opacity: 0.2;" id="formGroupExampleInput"
                        value="<?php echo $clientTargetUrl;?>" disabled>
                </div>
                <div class="col-12 col-md-6 mt-2 mt-md-3">
                    <label for="formGroupExampleInput2" class="form-label fw-semibold">Anchor Text:</label>
                    <input type="text" class="form-control rounded-0 border-primary bg-light"
                        style="--bs-border-opacity: 0.2;" id="formGroupExampleInput2"
                        value="<?php echo $clientAnchorText; ?>" disabled>
                </div>


                <div class="col-12 col-md-6 mt-2 mt-md-3">
                    <label for="formGroupExampleInput" class="form-label fw-semibold">Your Content:</label>
                    <textarea class="form-control rounded-0 border-primary bg-light" style="--bs-border-opacity: 0.2;"
                        name="" id="" cols="30" rows="5" disabled><?php echo $clientContent1; ?></textarea>
                </div>
                <div class="col-12 col-md-6 mt-2 mt-md-3">
                    <label for="formGroupExampleInput2" class="form-label fw-semibold">Special Requirement:</label>
                    <textarea class="form-control rounded-0 border-primary bg-light" style="--bs-border-opacity: 0.2;"
                        name="" id="" cols="30" rows="5" disabled><?php echo $clientRequirement; ?></textarea>
                </div>

            </div>

            <hr>

            <div class="p-1">
                <div class="row border border-2 bg-primary text-light fs-5 fw-semibold my-auto py-2">
                    <div class="col-6 col-md-8">
                        <p class="mb-0">Payable:</p>
                    </div>
                    <div class="col-6 col-md-4 text-center">
                        <p class="mb-0">Price: $ <span id="amount"> <?php echo $clientOrderPrice;?></span></p>
                    </div>
                </div>
            </div>

    </section>

    <div class="d-flex justify-content-end">
        <div id="paypal-payment-button">
        </div>
    </div>

    <form action="pay-success.php" method="post" id="send-data" class="d-none">
        <input type="text" name="data" id="form-inp">
        <input type="text" name="blogId" id="blogId" value="<?php echo $blogId; ?>">
    </form>


    <script
        src="https://www.paypal.com/sdk/js?client-id=Ad-k2bukRixHHQ6YLq08lkeobaQU8EJtuiiW6vuuthWJIOdqEpUlpz73mKZBxU_pvTPy9q086XgtFw2d&disable-funding=credit,card&currency=USD">
    </script>
    <!-- <script>paypal.Buttons().rander('#paypal-payment-button');</script> -->
    <script>
    let amount = document.getElementById("amount").innerText;
    let customerName = document.getElementById("customer-name").innerText;


    let formInp = document.getElementById('form-inp');
    let form = document.getElementById('send-data');


    paypal.Buttons({
        style: {
            layout: 'vertical',
            color: 'silver',
            shape: 'pill',
            label: 'paypal'
        },
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: amount
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.

                formInp.value = JSON.stringify(details);
                form.submit();

            });
        },
        onCancel: function(data) {
            // Show a cancel page, or return to cart
            // alert(data)
            console.log(data);
            sessionStorage.setItem('orderStatus', 'Cancled');
            if (sessionStorage.getItem('orderStatus') == 'Cancled') {
                alert('cancled');
            }
        },
        onError: function(err) {
            // For example, redirect to a specific error page
            // window.location.href = "/your-error-page-here";
            alert(`Error: ${err}`);
        }
    }).render('#paypal-payment-button');
    // .render('#paypal-button-container');
    </script>
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
</body>

</html>


<script>

window.onload = setInterval(()=> {
        let paypalBtn = document.querySelector('paypal-button-label-container')
        if(paypalBtn){
            console.log('dom manipulation')
        }
    },100)
</script>
<!-- ======================================================================================================================= 
===================================================== For Paypal Payment ===================================================== 
======================================================================================================================== -->

<?php

if(isset($_POST['OrderNowPaypal'])){ 

?>

<!-- <form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmPaypal">
    <input type="text" name="cmd" value="_xclick">

    <input type="text" name="business" value="<?php echo PAYPAL_BUSINESS; ?>">

    <input type="text" name="receiver_id" value="VW5QDW95ZPFYG">

    <input type="text" name="item_name" value="<?php echo $clientOrderedSite; ?>">

    <input type="text" name="item_number" value="<?php echo $clientUserId; ?>">

    <input type="text" name="amount" value="<?php echo $clientOrderPrice; ?>">

    <input type="text" name="currency_code" value="<?php echo PAYPAL_CURRENCY_CODE; ?>">

    >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>><input type="hidden" name="shipping" 		value="0">


    <input type="text" name="no_shipping" value="<?php echo PAYPAL_DISPLAY_SHIPPING_ADDRESS; ?>">

    <input type="text" name="handling" value="0">

    <input type="text" name="image_url" value="">

    <input type="text" name="return" value="<?php echo  PAYPAL_SITE_URL . PAYPAL_NOTIFY_URL; ?>">

    <input type="text" name="cancel_return" value="<?php echo  PAYPAL_SITE_URL . PAYPAL_CANCEL_URL; ?>">

    <input type="text" name="notify_url" value="<?php echo  PAYPAL_SITE_URL . PAYPAL_NOTIFY_URL; ?>">

    <input type="text" name="first_name" value="<?php echo $clientName ; ?>">

    <input type="text" name="last_name" value="">

    <input type="text" name="address1" value="">

    <input type="text" name="address2" value="">

    <input type="text" name="city" value="">

    <input type="text" name="state" value="">

    <input type="text" name="zip" value="">

    <input type="text" name="day_phone_a" value="">

    <input type="text" name="email" value="">

    <div style="padding:10px;">
        <img src="images/icon/ajax-loader.gif" width="220" height="19" alt="Page Loading. Please Wait..." />
    </div>
</form> -->

<!-- <script language="JavaScript" type="text/javascript">
window.onload = function() {
    window.document.frmPaypal.submit();
}
</script> -->












<!-- ======================================================================================================================= 
===================================================== For Card Payment ===================================================== 
======================================================================================================================== -->

<?php 

}elseif(isset($_POST['orderNowCcavenue'])){

    $x = file_get_contents("http://api.currencylayer.com/live?access_key=8a2f585d514c46191c359ccab7f7ebaf");
    $response_data = json_decode($x);
    $val = $response_data->quotes->USDINR;

    $inrUsd =$val*$clientOrderPrice;
   
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

<form method="post" name="redirect"
    action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> <?php 
echo  "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";  
?>
</form>
<script language='javascript'>
document.redirect.submit();
</script>


<?php  } ?>