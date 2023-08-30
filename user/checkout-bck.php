<?php 
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";
require_once ROOT_DIR. "includes/alert-constant.inc.php";
require_once ROOT_DIR. "includes/paypal.inc.php";

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
$dateUtil      	= new DateUtil();
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
	header("Location: login.php");
	exit;
}

$customerCountryId      = $cusDtl[0][30];
$customerStateId        = $cusDtl[0][28];
$customerEmail          = $cusDtl[0][3];
$customerBillingName    = $cusDtl[0][37];
$customerContactNo      = $cusDtl[0][32];
$customerCityId         = $cusDtl[0][27];
$customerZipCode        = $cusDtl[0][29];

$StateDtls 	= $Location->getStateData($customerStateId);

$countriesDtls 	= $Location->getCountyById($customerCountryId);


//Current Url
$current_url 	= base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

// get the current current url into session 
$_SESSION['reorder-page'] = $utility->currentUrl();

// print_r($_REQUEST);
// exit;

// if(!isset($_SESSION["domain"])){
//     header("Location: domains.php");
// }

$productId = $_REQUEST['data'];

$total 		= 0;
$totalAmt 	= 0;
            
$domainDtl		= $domain->showDomainsById($productId);
$subtotal 		= $cart_itm["qty"];
$total 			= ($total + $subtotal);
$nicheDtls	 	= $Niche->showBlogNichMst($domainDtl['niche']);
//$Amt			= $domainDtl[8];
$totalAmt		= $totalAmt + $domainDtl['sprice'];
// echo $domainDtl[17];

if(isset($_POST['btnSubmit'])){
    if($_POST['btnSubmit'] == 'paypalData'){

    
        //post var
        $txtBillingName 			= $_POST['txtBillingName'];
        $phoneNo 			        = $_POST['contact-no'];
        $txtBillingEmail	  		= $customerEmail;
        $txtBillingAdd 				= $_POST['txtBillingAdd'];
        $billingState 			    = $_POST['txtBillingState'];
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

            $myError->showErrorTA($action, $id, $id_var, $url, ERORDERL007, $typeM, $anchor);

        }else if(($invalidEmail == '')||(preg_match("/^ER/i",$invalidEmail))){

            $myError->showErrorTA($action, $id, $id_var, $url, ERREG005, $typeM, $anchor);

        }else if($billingState == '') {

            $myError->showErrorTA($action, $id, $id_var, $url, ERREG011, $typeM, $anchor);
            
        }else if($txtPostCode == '') {

            $myError->showErrorTA($action, $id, $id_var, $url, ERREG0016, $typeM, $anchor);
        
        }else{

            $client_dtl		= $customer->getCustomerData($cusId);

            
            //Update Customer details
            $customer->editCustomerDtls($cusId, $txtBillingName);

            // $customer->updateBillingNumber($cusId, $phoneNo);
            // $customer->updateBillingState($cusId, $billingState);
            
            $customer->updateCusAddress($cusId, $txtBillingAdd, $client_dtl[0][25], $client_dtl[0][26], $client_dtl[0][27], $client_dtl[0][28], $txtPostCode, $txtCountry, $client_dtl[0][31], $client_dtl[0][32], $client_dtl[0][33], $client_dtl[0][34]);
            
            //Add Orders
            $ordId	= $order->addOrder($cusId, $txtBillingName, $_SESSION['tAmount'], $client_dtl[0][5], $txtBillingAdd, $client_dtl[0][25], $client_dtl[0][26], $client_dtl[0][29], 
            $phoneNo, $billingState, $txtCountry, $txtBillingEmail, $txtNotes);
            
            $totalAmt = 0;
            $ordProdIds = array();
            foreach ($_SESSION["domain"] as $cart_itm){

                $domainDtl		= $domain->showDomainsById($cart_itm['code']);
                $ordProdIds[]	= $checkout->addOrdProd($ordId, 'domain', $domainDtl['id'], '', $domainDtl['domain'], $domainDtl['sprice'], $domainDtl['sprice'], 0.0, 1);
                $totalAmt		= $totalAmt + $domainDtl['sprice'];
            }
            
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
        
        }

	}else {
        header("Location: ./");
    }
}

?>
<!DOCTYPE HTML>
<html lang="zxx">

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

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php // require_once  "partials/navbar.php"; ?>
        <!-- //header -->
        <!-- banner -->
        <div class="banner1">

        </div>
        <!-- //banner -->
        <!-- Main Content -->
        <div class="container text-center">
            <!-- Start Row-->
            <div class="row">
                <!-- Items List/Details  -->
                <div class="col-lg-6">

                    <!--Start Row-->
                    <div class="row coutrow">
                        <!--Start Row-->
                        <div class="col-lg-10 card ckoutcol">

                            <h2 class="stat-title text-center  pb-lg-3"><?= $domainDtl['domain']; ?></h2>
                            <h3 class="sub-title2"><i class="fa-solid fa-angles-right"></i>URL :<a rel="nofollow"
                                    href="<?php echo $domainDtl['durl'];?>" target="_blank">
                                    <?php echo $domainDtl['durl'];?></a>
                            </h3>
                            <h3 class="sub-title1 fs-4 fw-bold">
                                <i class="fa-solid fa-right-long"></i>
                                Price :<?= CURRENCY.$domainDtl['price'];?>
                            </h3>

                        </div>
                        <div class="col-lg-2 pb-2">
                            <a href="removecart.php?removep=<?php echo $domainDtl['id'];?>"
                                class="btn btn-danger btn-sm">
                                Remove
                            </a>
                        </div>
                    </div>
                    <!--end Row-->


                    <p class="text-end fs-4 fw-bolder">
                        Total: <?php echo CURRENCY.'<span id="totalAmount">'.$totalAmt.'</span>';
								$_SESSION['tAmount']	= $totalAmt;
							?>
                    </p>

                    <div class="payment-sec d-flex flex-column">
                        <div class="cl"></div>

                        <div id="item-subbmit-btn">

                            <p class="py-2 text-center"><input type="checkbox" id="checkForm" name="checkForm"
                                    value="checkForm" onclick="checkForm()">
                                I agree with <a href="#">Terms & conditiond</a> and <a href="#">Refund Policy</a>
                            </p>
                            <p class="text-center text-danger fs-6 fw-bold pb-2 d-none" id="acceptForm">Please read
                                the terms and conditions</p>

                            <div id="smart-button-container">
                                <div style="text-align: center;">
                                    <div id="paypal-button-container" onclick="paypalOrder()"></div>
                                </div>
                            </div>
                            <!-- <div class="container"> -->
                            <div class="form-group">
                                <button type="submit"
                                    class="btn border border-primary border-1 bg-transparent w-100 mt-2"
                                    name="orderNowCcavenue" onclick="ccAvenueOrder()">
                                    <span class="masterCard"><img src="<?= IMG_PATH?>payments/masterCard.png"></span>
                                    <span class="visaCard"><img src="<?= IMG_PATH ?>payments/visaCard.png"></span>
                                    <span> Credit Card or Debit Card</span>
                                </button>
                            </div>

                        </div>
                        <div class="cl"></div>
                    </div>
                </div>
                <!-- Items List/Details End -->

                <!-- Customer Details Start -->
                <div class="col-lg-6">
                    <!----------------------start login area-------------------------------->

                    <div title="regsitration" class="billing-details" id="form-login">
                        <h2 class="text-primary fw-normal pb-2">Billing Details</h2>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data"
                            autocomplete="off" name="billingForm" id="billingForm">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="billing-name" placeholder=" "
                                    name="txtBillingName" value="<?= $customerBillingName; ?>">
                                <label for="floatingInput">Billing Name</label>
                            </div>
                            <p id="noName" class="text-danger text-start"></p>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="contact-no" placeholder=" "
                                    name="contact-no" value="<?php echo $customerContactNo; ?>">
                                <label for="floatingInput">Contact No</label>
                            </div>
                            <p id="noContact" class="text-danger text-start"></p>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="billing-email" placeholder=" "
                                    name="txtBillingEmail" value="<?= $customerEmail; ?>" disabled>
                                <label for="floatingInput">Email address</label>
                            </div>
                            <p id="noEmail" class="text-danger text-start"></p>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="city" name="txtBillingAdd">
                                    <option selected disabled value="">Please select state first</option>
                                    <?php
                                    if ($customerStateId != '') {
                                        // $utility->populateDropDown($customerCityId, 'id', 'name', 'cities');
                                        $utility->populateDropDown2($customerCityId, 'id', 'name', 'state_id', $customerStateId, 'cities');

                                    }
                                    ?>
                                </select>
                                <label for="city">Billing City</label>
                            </div>
                            <p id="noAdd" class="text-danger text-start"></p>


                            <div class="form-floating mb-3">
                                <select class="form-select" id="stateId" name="txtBillingState"
                                    onchange="getCitiesList(this)">
                                    <?php
                                        if ($customerCountryId!= '') {
                                            echo '<option selected disabled value="">Select</option>';
                                            $utility->populateDropDown2($customerStateId, 'id', 'name', 'country_id', $customerCountryId, 'states');
                                        }else {
                                            echo '<option selected disabled value="">Please select state first</option>';
                                        }
                                    ?>
                                </select>
                                <label for="billing-state">State</label>
                            </div>
                            <p id="noState" class="text-danger text-start"></p>


                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="billing-zip" placeholder=" "
                                    name="txtPostCode" value="<?= $customerZipCode; ?>">
                                <label for="floatingInput">Billing Zip</label>
                            </div>
                            <p id="noZipCode" class="text-danger text-start"></p>


                            <div class="form-floating">
                                <select class="form-select" id="billing-cntry" name="txtCountry"
                                    onchange="getStateList(this)">
                                    <?php
                                    if ($customerCountryId != '') {
                                        echo '<option selected disabled value="">Select</option>';
                                    } 
										$utility->populateDropDown($customerCountryId, 'id', 'name', 'countries');
									?>
                                </select>
                                <label for="floatingSelect">Country</label>
                            </div>
                            <p class="blnkReg text-danger text-start" id="noCntry"></p>

                            <div class="form-floating">
                                <textarea class="form-control" id="txtNotes" name="txtNotes" style="height: 150px"
                                    placeholder=" "></textarea>
                                <label for="floatingTextarea">Write your requirements here</label>
                            </div>
                            <p id="noNotes" class="text-danger text-start"></p>

                            <input type="hidden" name="paymentData" id="paymentData" value="">

                            <input type="hidden" name="btnSubmit" id="btnSubmit">
                            <!-- <button hidden name="" id="paybtn">paybtn</button> -->
                        </form>
                    </div>

                    <!----------------------------------- eof Form login Area ----------------------------------->
                </div>
                <!-- Customer Details End -->

            </div>
            <!-- end Row-->

        </div>

    </div>
    <!-- js-->
    <script src="<?= URL ?>plugins/jquery-3.6.0.min.js"></script>
    <script src="<?= URL ?>js/location.js"></script>

    <script>
    $("#contact-no").keyup(function() {
        num = $("#contact-no").val();
        // alert(num.length);
        if (num.length < 10) {
            $("#noContact").html("Please verify the length");
        } else {

            $("#noContact").css("display", "none");
        }
    });
    </script>
    <script>
    const checkForm = () => {

        var name = $("#billing-name").val();
        var email = $("#billing-email").val();
        var contNum = $("#contact-no").val();
        var addrs = $("#billing-addr").val();
        var state = $("#billing-state").val();
        var zipCo = $("#billing-zip").val();
        var cntry = $("#billing-cntry").val();
        var notes = $("#txtNotes").val();
        // var niche = $("#niche-choosed").html();
        // var package_id = $("#package_id").html();
        // let typeOfPayment = 'paypal';
        // alert(name);

        if (name == '' || name == '0') {
            $("#noName").html("Please Enter a Name");
            alert("Please Enter a Name");
        }

        $("#billing-name").keyup(function() {
            $("#noName").css("display", "none");
        });

        if (contNum == '' || contNum == '0') {
            $("#noContact").css("display", "block");
            $("#noContact").html("Please Enter Contact Number!");
            alert("Enter Contact Number!");
        }


        if (email == '' || email == '0') {
            $("#noEmail").html("Please Enter an Email");
            alert("Please Enter an Email");
        }

        $("#billing-email").keyup(function() {
            $("#noEmail").css("display", "none");
        });


        if (addrs == '' || addrs == '0') {
            $("#noAdd").html("Please Enter Your Address");
            alert("Please Enter Your Address");
        }

        $("#billing-addr").keyup(function() {
            $("#noAdd").css("display", "none");
        });


        if (state == '' || state == '0') {
            $("#noState").html("Please Enter Your State Name");
            alert("Please Enter Your State Name");
        }


        $("#billing-state").keyup(function() {
            $("#noState").css("display", "none");
        });



        if (zipCo == '' || zipCo == '0') {
            $("#noZipCode").html("Please Enter Your Zip Code");
            alert("Please Enter Your Zip Code");
        }

        $("#billing-zip").keyup(function() {
            $("#noZipCode").css("display", "none");
        });

        if (cntry == '') {
            alert("Please Enter Your Country");
            $("#noCntry").html("Please Enter Your Country")
        }

        $("#billing-cntry").keyup(function() {
            $("#noCntry").css("display", "none");
        });

        if (notes == '' || notes == '0') {
            $("#noNotes").html("Please Add Some Notes");
            alert("Please Add Some Notes");
        }

        $("#txtNotes").keyup(function() {
            $("#noNotes").css("display", "none");
        });

        if (name == '' || name == '0' || email == '' || email == '0' || addrs == '' || addrs ==
            '0' || zipCo == '' || zipCo == '0' || cntry == '' || cntry == '0' || notes == '' || notes == '0') {
            $(".blnkReg").css("display", "block");

            document.getElementById("checkForm").checked = false;

        }


        const cb = document.getElementById("checkForm");
        if (cb.checked == true) {
            document.getElementById('acceptForm').classList.add('d-none');

        } else {
            document.getElementById('acceptForm').classList.remove('d-none');
        }

    }
    </script>


    <script
        src="https://www.paypal.com/sdk/js?client-id=<?= PAYPAL_CLIENT_ID;?>&disable-funding=credit,card&currency=USD"
        data-sdk-integration-source="button-factory"></script>
    <script>
    let totalAmount = document.getElementById('totalAmount').innerText;
    let paymentData = document.getElementById('paymentData');
    btnSubmit = document.getElementById('btnSubmit');



    // alert(totalAmount);

    function initPayPalButton() {
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'blue',
                layout: 'vertical',
                label: 'paypal',

            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        "amount": {
                            "currency_code": "USD",
                            "value": totalAmount
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    // Full available details
                    // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    // var transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    paymentData.value = JSON.stringify(orderData);

                    // paybtn.setAttribute("name", "paypalData");
                    btnSubmit.value = "paypalData";
                    // Show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';

                    // Or go to another URL:  actions.redirect('thank_you.html');
                    document.getElementById('billingForm').submit();

                });
            },
            onCancel: function(data) {
                // alert('Cancled');
            },
            onError: function(err) {
                console.log(err);
                alert('error');
                window.location.href = "./payments/error-pay.php";
            }
        }).render('#paypal-button-container');
    }
    initPayPalButton();
    </script>


    <script>
    const ccAvenueOrder = () => {

        const cb = document.getElementById("checkForm");
        if (cb.checked == true) {
            document.getElementById('acceptForm').classList.add('d-none');

            document.getElementById('billingForm').action = "payments/itemPayment/ccAvenue-payment/payment.php";
            document.getElementById('billingForm').submit();


        } else {
            document.getElementById('acceptForm').classList.remove('d-none');
        }

    }
    </script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= URL?>plugins/bootstrap-5.2.0/js/bootstrap.js"></script>

</body>

</html>