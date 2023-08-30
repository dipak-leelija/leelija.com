<?php 
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";
require_once ROOT_DIR. "includes/alert-constant.inc.php";
require_once ROOT_DIR. "includes/paypal.inc.php";
require_once ROOT_DIR. "includes/order-constant.inc.php";

require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/date.class.php";  
require_once ROOT_DIR."classes/error.class.php"; 
require_once ROOT_DIR."classes/search.class.php";	
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/order.class.php"; 
require_once ROOT_DIR."classes/checkout.class.php";
require_once ROOT_DIR."classes/login.class.php"; 

require_once ROOT_DIR."classes/countries.class.php";
require_once ROOT_DIR."classes/location.class.php";
require_once ROOT_DIR."classes/niche.class.php"; 
require_once ROOT_DIR."classes/domain.class.php"; 
require_once ROOT_DIR."classes/utility.class.php"; 
require_once ROOT_DIR."classes/utilityMesg.class.php"; 
require_once ROOT_DIR."classes/utilityImage.class.php";
require_once ROOT_DIR."classes/utilityNum.class.php";

/* INSTANTIATING CLASSES */
$DateUtil      	= new DateUtil();
$myError 			= new MyError();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$order			= new Order();
$checkout		= new Checkout();

$country		= new Countries();
$Location       = new Location();
$Niche		    = new Niche();
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
#########################################################################################################

#########################################################################################################
$typeM			= $utility->returnGetVar('typeM','');
//user id
$cusId			= $utility->returnSess('userid', 0);

$cusDtl			= $customer->getCustomerData($cusId);

if ($cusDtl == NULL) {
	header("Location: ".URL."login.php");
	exit;
}

$customerCountryId      = $cusDtl[0][30];
$customerStateId        = $cusDtl[0][28];
$customerEmail          = $cusDtl[0][3];
$billingName            = $cusDtl[0][37];
$customerContactNo      = $cusDtl[0][32];
$customerCityId         = $cusDtl[0][27];
$customerZipCode        = $cusDtl[0][29];

$StateDtls 	= $Location->getStateData($customerStateId);

$countriesDtls 	= $Location->getCountyById($customerCountryId);


//Current Url
// $current_url 	= base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$current_url        = $utility->currentUrl();

// get the current current url into session 
$_SESSION['reorder-page'] = $current_url;

// print_r($_REQUEST);
// exit;

// if(!isset($_SESSION["domain"])){
//     header("Location: domains.php");
// }

$productId = $_REQUEST['data'];

$domainDtl		= $domain->showDomainsById($productId);
$itemName       = $domainDtl['domain'];
$nicheId        = $domainDtl['niche'];
$itemCost       = $domainDtl['price'];
$SellingPrice   = $domainDtl['sprice'];
$itemImage      = $domainDtl['dimage'];
$itemURL        = $domainDtl['durl'];
$sellingStatus  = $domainDtl['selling_status'];
$itemSeller     = $domainDtl['added_by'];


$subtotal 		= $SellingPrice;
$totalAmt 	    = $SellingPrice;


$city       = '';
$state      = '';
$country    = '';

if (!empty($cusDtl[0][27])) {
    $city = $Location->getCityDataById($cusDtl[0][27])['name'];
}

if (!empty($cusDtl[0][28])) {
    $state = $Location->getStateName($cusDtl[0][28]);
}

if (!empty($cusDtl[0][30])) {
    $country = $Location->getCountyById($cusDtl[0][30])['name'];
}

$addressArr = array(
    'address1' => $cusDtl[0][24],
    'address2' => $cusDtl[0][25],
    'address3' => $cusDtl[0][26],
    'city' => $city,
    'state' => $state,
    'country' => $country,
    'zipcode' => $cusDtl[0][29]
    
);


if(isset($_POST['btnSubmit'])){
    if($_POST['btnSubmit'] == 'paypalData'){

    
        // $txtNotes  					= $_POST['txtNotes'];
        $txtNotes  					= '';
        $paymentData                = $_POST['paymentData'];


        $client_dtl		= $customer->getCustomerData($cusId);

        //Add Orders
        $ordId	= $order->addOrder($cusId, $billingName, $totalAmt, 
        $client_dtl[0][5], $client_dtl[0][24], $client_dtl[0][25], $client_dtl[0][26], $client_dtl[0][29], $customerContactNo, $state, $country, $customerEmail, $txtNotes);
            
        $ordProdIds = array();
        $domainDtl		= $domain->showDomainsById($productId);
        $ordProdIds[]	= $checkout->addOrdProd($ordId, 'domain', $domainDtl['id'], '', $itemName, $SellingPrice, $SellingPrice, 0.0, 1);
        
            
        //generate order key
        $ordKey = $order->generateOrderCode('ORDER', $ordId);
            
        //order amount
        $ordAmt	= $totalAmt; //0.01;//$totalPrice;//0.01
            
        //update order code
        $order->updateOrderCode($ordId, $ordKey, $ordAmt);
               
        //update order status
        $order->updateOrderStatus($ordId, PENDINGCODE);

        //hold order values in session
        $_SESSION['ordId']	= $ordId;
        $_SESSION['ordKey']	= $ordKey;
        $_SESSION['ordAmt']	= $ordAmt;

        //forward to payment page
        header("Location: ".URL."payments/paypal-payment-response.php?data=".base64_encode($paymentData));
        exit();
        

	}else {
        header("Location: ./");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CheckOut: <?php echo COMPANY_FULL_NAME; ?></title>

    <link rel="icon" href="<?php echo FAVCON_PATH; ?>" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo FAVCON_PATH; ?>" />

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?= URL ?>plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="<?= URL ?>plugins/fontawesome-6.1.1/css/all.css">
    <!-- Custom CSS -->
    <link href="<?= URL ?>css/leelija.css" rel="stylesheet">
    <link href="<?= URL ?>css/style.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/cheakout.css" rel="stylesheet" type='text/css'>

    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">

    <!-- <script src="js/ajax.js"></script> -->

    <!-- custom css  -->
    <link rel="stylesheet" href="<?= URL; ?>/css/checkout.css">
</head>

<body>
    <section class="paylater-main-section">
        <!-- logo codes -->
        <div class="logos-section">
            <div class="text-center">
                <img src="<?php echo LOGO_WITH_PATH; ?>" alt="<?php echo COMPANY_FULL_NAME; ?>" class="main_logo">
            </div>
        </div>
        <!-- cards for customers details -->
        <div class="second-main-div-for-details">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="customer-details-section">
                        <div class="card customer-d-card">
                            <h5>Customer Details</h5>
                            <p><label><?= $billingName;?></label></p>
                            <p><label><?= $customerEmail;?></label></p>
                            <p><label><?= $customerContactNo;?></label>
                            <p><label><?= $Location->printAddress($addressArr);?></label></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="Client-details-section">
                        <div class="card customer-d-card">
                            <h5>Bill Details</h5>
                            <p><label>Invoice Date : <?php echo $DateUtil->todayDate("/"); ?> </label></p>
                            <p><label>Due Date : <?php echo $DateUtil->todayDate("/"); ?><label></p>
                            <p><label>Payment Mode : Paypal<label></p>
                        </div>
                    </div>
                </div>
            </div>

            <form method="post" id="orderForm">
                <input type="hidden" name="blogId" id="blogId" value="<?php echo $blogId; ?>">

                <div class=" display-table text-center">
                    <!-- <div class="features_grids table-responsive"> -->
                    <table class="table detailing-table">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b><?= $itemName; ?></b> </td>
                                <td><?= count($domainDtl); ?></td>
                                <td><?php echo CURRENCY.$SellingPrice; ?></td>
                                <td> <?php echo CURRENCY.$SellingPrice; ?></span>
                                </td>
                            </tr>
                            <?php if (isset($_POST['order-name2'])): ?>
                            <tr>
                                <td><b><?= 'Content' ?></b> </td>
                                <td><?= 1; ?></td>
                                <td><?= CURRENCY.CONTENTPRICE; ?></td>
                                <td><?= CURRENCY.CONTENTPRICE; ?></td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <!-- </div> -->
                </div>

                <!-- invoice table -->
                <div class="mt-5">
                    <div class="row" style="display: flex; justify-content: end;">
                        <div class="col-md-5  ">
                            <table class="table table-responsive">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="text-center" scope="col">Invoice Summary</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-6">Subtotal</div>
                                                <div class="col-6 text-end fw-semibold">
                                                    <?= CURRENCY.$subtotal;?></div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-6">Total</div>
                                                <div class="col-6 text-end fw-semibold">
                                                    <?= CURRENCY; ?><span id="amount"><?= $totalAmt;?></span>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-12 text-end" id="payBtn">
                                                    <div id="paypal-payment-button">
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center" id="payBtn">
                                                    <a href="#" onclick="history.back()">Cancel</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <form action="<?= $current_url ?>" method="post" id="send-data" class="d-none">
        <input type="hidden" name="paymentData" id="paymentData">
        <input type="hidden" name="btnSubmit" value="paypalData">
    </form>


    <script
        src="https://www.paypal.com/sdk/js?client-id=<?= PAYPAL_CLIENT_ID; ?>&disable-funding=credit,card&currency=USD">
    </script>
    <script>
    let amount = document.getElementById("amount").innerText;

    let paymentData = document.getElementById('paymentData');
    let form = document.getElementById('send-data');



    paypal.Buttons({
        style: {
            height: 45,
            layout: 'vertical',
            color: 'blue',
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

                document.getElementById('payBtn').innerHTML =
                    `<div class="bg-secondary border border-info rounded text-center"><p class="fw-bold py-2 mb-0"><span><img src="../images/icons/loading-2.gif" alt="loading"></span> Please Wait..</p></div>`;
                paymentData.value = JSON.stringify(details);
                form.submit();

            });
        },
        onCancel: function(data) {

            console.log(data);
            sessionStorage.setItem('orderStatus', 'Cancled');
            if (sessionStorage.getItem('orderStatus') == 'Cancled') {
                alert('cancled');
            }
        },
        onError: function(err) {
            alert(`Error: ${err}`);
        }
    }).render('#paypal-payment-button');

    const paylaterOrder = () => {
        orderForm = document.getElementById("orderForm");
        orderForm.action = "paylater-order-success.php";
        orderForm.submit();
    }
    </script>
    <script src="<?= URL; ?>/plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
</body>

</html>