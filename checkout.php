<?php 
session_start(); 
require_once("_config/dbconnect.php");

require_once("includes/constant.inc.php");
require_once("classes/date.class.php");  
require_once("classes/error.class.php"); 
require_once("classes/search.class.php");	
require_once("classes/customer.class.php");
require_once("classes/order.class.php"); 
require_once("classes/checkout.class.php");
require_once("classes/login.class.php"); 

require_once("classes/countries.class.php"); 
require_once("classes/blog_mst.class.php"); 
require_once("classes/domain.class.php"); 
require_once("classes/utility.class.php"); 
require_once("classes/utilityMesg.class.php"); 
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$myError 			= new MyError();
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

foreach($cusDtl as $rowCusDtl){
	$rowCusDtl[30];
}




$countriesDtls 	= $country->showCountry($rowCusDtl[30]); //countries_id
// print_r($countriesDtls[0][0]); exit;
$domainDtls		= $domain->ShowDomainData();

//Current Url
$current_url 	= base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

// get the current current url into session 
$_SESSION['reorder-page'] = $utility->currentUrl();

if(!isset($_SESSION["domain"])){
    header("Location: domains.php");
}

if(isset($_POST['btnSubmit'])){
    if($_POST['btnSubmit'] == 'paypalData'){

    
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

            // $customer->updateBillingNumber($cusId, $phoneNo);
            // $customer->updateBillingState($cusId, $billingState);
            
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

            //hold order values in session
            $_SESSION['ordId']	= $ordId;
            $_SESSION['ordKey']	= $ordKey;
            $_SESSION['ordAmt']	= $ordAmt;

            //forward to payment page
            header("Location: payments/itemPayment/paypal-payment-response.php?data=".base64_encode($paymentData));
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
    
    <meta name="description" content="LeeLija can Instantly find the Domain Name and Ready Blogs Or Websites that you have been looking for. Find the right Blog or Website today.">
    <meta name="keywords" content="Precedence Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/leelija.css">
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/cheakout.css" type='text/css'>

    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">

    <!-- <script src="js/ajax.js"></script> -->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- //header -->
        <!-- banner -->
        <div class="banner1">

        </div>
        <!-- //banner -->
        <!-- Main Content -->
        <!--<section class="py-5 branches position-relative" id="explore">-->
        <div class="container text-center">
            <div class="row">
                <!-- Start Row-->
                <div id="msg">
                    <?php //$uMesg->dispMessage($typeM, 'images/icon/', 'blackLarge');?>
                </div>
                <div class="col-lg-6">
                    <!----------------------start login area-------------------------------->


                    <div title="regsitration" class="billing-details" id="form-login">
                        <h2 class="text-primary fw-normal pb-2">Billing Details</h2>
                        <?php
							if($cusId !="")
								{
							?>

                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data"
                            autocomplete="off" name="billingForm" id="billingForm">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="billing-name" placeholder=" "
                                    name="txtBillingName" value="<?php echo $cusDtl[0][37]; ?>">
                                <label for="floatingInput">Billing Name</label>
                            </div>
                            <p id="noName" class="text-danger text-start"></p>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="contact-no" placeholder=" "
                                    name="contact-no" value="<?php echo $cusDtl[0][32]; ?>">
                                <label for="floatingInput">Contact No</label>
                            </div>
                            <p id="noContact" class="text-danger text-start"></p>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="billing-email" placeholder=" "
                                    name="txtBillingEmail" value="<?php echo $cusDtl[0][3]; ?>">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <p id="noEmail" class="text-danger text-start"></p>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="billing-addr" placeholder=" "
                                    name="txtBillingAdd" value="<?php echo $cusDtl[0][24]; ?>">
                                <label for="floatingInput">Billing Address</label>
                            </div>
                            <p id="noAdd" class="text-danger text-start"></p>


                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="billing-state" placeholder=" "
                                    name="txtBillingState" value="<?php echo $cusDtl[0][28]; ?>">
                                <label for="floatingInput">Billing State</label>
                            </div>
                            <p id="noState" class="text-danger text-start"></p>


                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="billing-zip" placeholder=" "
                                    name="txtPostCode" value="<?php echo $cusDtl[0][29]; ?>">
                                <label for="floatingInput">Billing Zip</label>
                            </div>
                            <p id="noZipCode" class="text-danger text-start"></p>


                            <div class="form-floating">
                                <select class="form-select" id="billing-cntry" title="Countries" name="txtCountry">
                                    <option selected value="<?php echo $cusDtl[0][30]; ?>">
                                        <?php echo $countriesDtls[0][0]; ?></option>
                                    <?php 
										if(isset($_SESSION['userid'])){
											//$utility->genDropDown($_SESSION['txtCountriesId'], $arr_val, $arr_label);
											$utility->populateDropDown($cusDtl[24], 'countries_id', 'countries_name', 'countries');
										}else{
											//$utility->genDropDown(0, $arr_val, $arr_label);
											$utility->populateDropDown(0, 'countries_id', 'countries_name', 'countries');
										}
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


                        <?php	
								} else {
							?>
                        <div class="text-block2">
                            <p>Login Or Register</p>
                        </div>
                        <div class="fspace"></div>
                        <div class="row">
                            <!-- Start Row-->

                            <a href="login.php?return_url=<?php echo $current_url; ?>" class="btn btn-success btn-block"
                                onclick="loginForm()">Login</a>
                            OR
                            <a href="register.php?return_url=<?php echo $current_url; ?>"
                                class="btn btn-primary btn-block" onclick="loginForm()">Register</a>
                        </div>
                        <?php	
								}
							?>
                    </div>

                    <!----------------------------------- eof Form login Area ----------------------------------->
                </div>
                <div class="col-lg-6">
                    <?php
						if(isset($_SESSION["domain"])){
					?>

                    <?php		
										$total 		= 0;
										$totalAmt 	= 0;
										//echo '<ol>';
									foreach ($_SESSION["domain"] as $cart_itm)
									{
										$domainDtl		= $domain->showDomains($cart_itm['code']);
										$subtotal 		= $cart_itm["qty"];
										$total 			= ($total + $subtotal);
										$nicheDtls	 	= $blogMst->showBlogNichMst($domainDtl[1]);
										//$Amt			= $domainDtl[8];
										$totalAmt		= $totalAmt + $domainDtl[17];
                                        // echo $domainDtl[17];
								?>
                    <!--Start Row-->


                    <div class="row coutrow">
                        <!--Start Row-->
                        <div class="col-lg-10 card ckoutcol">

                            <h2 class="stat-title text-center  pb-lg-3"><?php echo $domainDtl[0]; ?></h2>
                            <h3 class="sub-title2"><i class="fa-solid fa-angles-right"></i>URL :<a rel="nofollow"
                                    href="<?php echo $domainDtl[9];?>" target="_blank">
                                    <?php echo $domainDtl[9];?></a>
                            </h3>
                            <h3 class="sub-title1 fs-4 fw-bold"><i class="fa-solid fa-right-long"></i> Price :
                                $<?php echo $domainDtl[8];?></h3>

                            <div class="ckoutdiv">

                                <h3 class="sub-title1"><i class="fa-solid fa-right-long"></i> Niche :
                                    <?php echo $nicheDtls[0][1];?></h3>
                                <h3 class="sub-title1"><i class="fa-solid fa-right-long"></i> DA :
                                    <?php echo $domainDtl[2];?>
                                </h3>
                                <h3 class="sub-title1">
                                    <i class="fa-solid fa-right-long"></i>
                                    PA : <?php echo $domainDtl[3];?>
                                </h3>
                                <h3 class="sub-title1"><i class="fa-solid fa-right-long"></i> TF :
                                    <?php echo $domainDtl[5];?>
                                </h3>
                                <h3 class="sub-title1">
                                    <i class="fa-solid fa-right-long"></i>
                                    CF : <?php echo $domainDtl[4];?>
                                </h3>
                                <h3 class="sub-title1"><i class="fa-solid fa-right-long"></i> Alexa :
                                    <?php echo $domainDtl[6];?>
                                </h3>
                                <h3 class="sub-title1">
                                    <i class="fa-solid fa-right-long"></i> Organic
                                    Traffic : <?php echo $domainDtl[7];?>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-2 pb-2">
                            <a href="removecart.php?removep=<?php echo $domainDtl[19];?>" class="btn btn-danger btn-sm">
                                Remove
                            </a>
                        </div>
                    </div>
                    <!--end Row-->


                    <?php
							}
								}
						?>
                    <p class="text-end fs-4 fw-bolder">
                        Total: $<?php echo '<span id="totalAmount">'.$totalAmt.'</span>';
								$_SESSION['tAmount']	= $totalAmt;
							?>
                    </p>
                    <?php 
								if($cusId !=""){
							?>

                    <div class="payment-sec d-flex flex-column">
                        <div class="cl"></div>

                        <div class="bGray"></div>


                        <!-- <div id="smart-button-container">
                            <div style="text-align: center;">
                                <div id="paypal-button-container"></div>
                            </div>
                        </div> -->


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
                                    <span class="masterCard"><img src="images/payments/masterCard.png"></span>
                                    <span class="visaCard"><img src="images/payments/visaCard.png"></span>
                                    <span> Credit Card or Debit Card</span>
                                </button>
                            </div>

                        </div>







                        <!-- <div class="buttons d-flex justify-content-evenly">

                                <a href="domains.php" class="btn btn-warning m-auto rounded-1"><i
                                        class="fa fa-angle-left"></i> Continue
                                    Shopping</a>

                                <input type="submit" class="proceed-btn m-auto" id="btnSubmit" name="btnSubmit"
                                    value="Proceed" />
                            </div> -->
                        <div class="cl"></div>
                    </div>

                    <?php 
								}
							?> <br>
                    <!-- <a href="domains.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a> -->
                </div>
            </div>
            <!-- end Row-->

        </div>


        <!-- Footer -->
        <?php require_once "partials/footer.php"; ?>
        <!-- /Footer -->
    </div>
    <!-- js-->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/cregistration.js"></script>

    <script>
        $("#contact-no").keyup(function() {
            num = $("#contact-no").val();
            // alert(num.length);
            if (num.length < 10) {
                $("#noContact").html("Please verify the length");
            }else{

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
        src="https://www.paypal.com/sdk/js?client-id=Ad-k2bukRixHHQ6YLq08lkeobaQU8EJtuiiW6vuuthWJIOdqEpUlpz73mKZBxU_pvTPy9q086XgtFw2d&disable-funding=credit,card&currency=USD"
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
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>

</body>

</html>


<!-- sandbox details  -->
<!-- https://www.paypal.com/sdk/js?client-id=Ad-k2bukRixHHQ6YLq08lkeobaQU8EJtuiiW6vuuthWJIOdqEpUlpz73mKZBxU_pvTPy9q086XgtFw2d&disable-funding=credit,card&currency=USD -->

<!-- rahulmajumdar client-id  -->
<!-- https://www.paypal.com/sdk/js?client-id=AZ_nrt4ttDxFLyCD6JFIM2lBKMLPTCyyVWY-_hREWz7keFGEQ3zPXeNMqmOVPUxCc1njzfdPG5-Ttcn1&enable-funding=venmo&disable-funding=credit,card&currency=USD -->