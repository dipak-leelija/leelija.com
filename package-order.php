<!--
Author: Safikul Islam
Author URL: https://webtechhelp.org
-->
<?php
session_start();
// var_dump($_SESSION);


if(!isset($_GET['package-type']) && !isset($_GET['niche'])){
    header("Location: /");
}


if($_GET['package-type'] && $_GET['niche']){
	$packageType 	 = $_GET['package-type'];
	$niche 			 = $_GET['niche'];

	$_SESSION['package-type'] = $packageType;
	$_SESSION['niche'] 		  = $niche;
}
else{
	$packageType = 'Silver';
	$niche 			 = 'Multi';
}

//include_once('checkSession.php');
// require_once("_config/connect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");
require_once("classes/services.class.php");

//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");
require_once("classes/gp-order.class.php");
require_once("classes/countries.class.php");

/* INSTANTIATING CLASSES */
$dateUtil       = new DateUtil();
$error 			= new Error();
$search_obj	    = new Search();
$customer		= new Customer();
$logIn			= new Login();
$service		= new Services();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$gp				= new Gporder();
$country		= new Countries();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId	= $utility->returnSess('userid', 0);
$cusDtl			= $customer->getCustomerData($cusId);

//Get Single package All Details
$singlePackage = $gp->singlePackageDetails($packageType);

// get the current current url into session 
$_SESSION['reorder-page'] = $utility->currentUrl();


if(isset($_SESSION['customer-id'])){
	$_SESSION['customer-id'] = $cusDtl[1];
}

if(isset($_SESSION['userid'])){
	$countriesDtls 	= $country->showCountry($cusDtl[0][30]);
	// print_r($countriesDtls[0][0]);
}


if(isset($_GET['seo_url'])){
	 $seo_url			  		= $_GET['seo_url'];
		// $return_url 	= base64_decode($_GET["return_url"]); //get return url
}

// echo $_SERVER['PHP_SELF'];
// exit;
if(isset($_POST['btnSubmit'])){
    if($_POST['btnSubmit'] == 'paypalData'){
    
    $paymentData    = $_POST['paymentData'];
    $package_id     = $_POST['package-type'];
    $niche        	= $_POST['niche'];
    $package_amount = $_POST['amount'];
    $customerId   	= $_POST['customer_id'];
    $customerName   = $_POST['package-name'];
    $customerEmail  = $_POST['package-email'];
    $contactNo      = $_POST['contact-no'];
    $customerAddr   = $_POST['package-add'];
    $customerZip    = $_POST['package-pin'];
    $customerCntry  = $_POST['packageCountry'];
    $customerNotes  = $_POST['package-Note'];
    $paypal_ordKey  = "";
    $cc_ordered_key = "";
    $status         = "pending";
    $paymentType    = "Paypal";

    
    $customer->updateBillingNumber($cusId, $contactNo); // update phone2 of customer

    $insertPackData = $gp->insertPackageOrder($package_id,$niche, $customerId, $customerName, $customerEmail,$customerAddr,$customerZip, $customerCntry, $customerNotes, $paymentType, $paypal_ordKey, $cc_ordered_key, $status);
        
    if($insertPackData){
        $_SESSION['package-order-id'] = $insertPackData;
        $_SESSION['order-amount']     = $package_amount;

        header("Location: payments/packagePayments/paypal-payment-response.php?data=".base64_encode($paymentData));
        exit();

    }else{
        echo "<h1 style='text-aling= center;'>Something is Wrong !!</h1>";
    }

    

    }    
}
?>
<?php
/*
define('WP_USE_THEMES', false);
require('blog/wp-load.php');
query_posts('showposts=3');
*/
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <link rel="icon" href="<?php echo FAVCON_PATH; ?>" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo FAVCON_PATH; ?>" />

    <title>Package Order ::<?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Leelija is an online product selling agency based in India. We are enhancing our business with the same tactics that we employ to our clients.">
    <meta charset="utf-8">
    <meta name="keywords" content="Web Design, Web Development, Apps Development, SEO Services, Guest Post Services, Domain name with Ready Website,
		Ready website for business, High Quality website sales, High quality blogs sales, expired domain sales" />

    <!-- Bootstrap Core CSS -->
    <link href="plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />

    <!-- Custom CSS -->
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/form.css" rel='stylesheet' type='text/css' />
    <link href="css/custom.css" rel='stylesheet' type='text/css' />

    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">

</head>

<body>
    <?php
	if($cusId == 0){
		include('partials/navbar.php');
	}
	else {
		require_once "partials/navbar.php";
	}
	 ?>

    <div class="package-order-section">
        <div class="container">
            <p class="packLog-h1">Welcome : <span id="welcome-client"><?php if(isset($_SESSION['welcome_name'])){
				echo $_SESSION['welcome_name'];
			}?></span>
            </p>
            <div class="package-order-main package-order">
                <!-- <form class="p-0 package-order" action="" method="post" id="<?php echo $cusId;?>"> -->
                <div class="row m-0">
                    <div class="col-lg-6 contact_right_row">

                        <p class="price-box-title text-center billing-head">Package : <span
                                id="package_id"><?php echo $singlePackage[8];  ?></p>
                        <div class="what-client-choose">
                            <p class="nicheclass"> <span class="spanisd"> Niche : </span> <span id="niche-choosed">
                                    <?php echo $niche;?></span></p>
                            <ul class="">
                                <li class="package-p"><i class="far fa-check-circle"></i><span class="dollar">
                                        Cost : $</span> <span
                                        id="singlePackagePrice"><?php echo $singlePackage[0];  ?></span>
                                </li>
                                <li class="package-p"><i class="far fa-check-circle"></i>
                                    <span>Blog Post :</span> <?php echo $singlePackage[1];  ?>
                                </li>
                                <li class="package-p"><i class="far fa-check-circle"></i>
                                    Blog Type : <?php echo $singlePackage[2];  ?></li>
                                <li class="package-p"><i class="far fa-check-circle"></i>
                                    Link Type: <?php echo $singlePackage[3];  ?></li>
                                <li class="package-p"><i class="far fa-check-circle"></i>
                                    Content : <?php echo $singlePackage[4];  ?></li>
                                <li class="package-p"><i class="far fa-check-circle"></i>
                                    DA : <?php echo $singlePackage[5];  ?></li>
                                <li class="package-p"><i class="far fa-check-circle"></i>
                                    TF : <?php echo $singlePackage[6];  ?></li>
                                <li class="package-p"><i class="far fa-check-circle"></i>
                                    CF : <?php echo $singlePackage[7];  ?></li>
                            </ul>
                        </div>




                    </div>


                    <div class="col-lg-6 contact_left_row">

                        <div class="ifNotLoggedIn">
                            <p class="price-box-title text-center billing-head">Login to Leelija</p>
                            <p id="package-login-error"></p>

                            <form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>"
                                name="formContactform" method="POST" enctype="multipart/form-data" autocomplete="off">
                                <b
                                    style="color: red;"><?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?></b>

                                <div class="form-group">
                                    <label for="txtUser" class="col-sm-3 d-none control-label"></label>
                                    <div class="col-sm-12 p-0">
                                        <input type="text" id="pack-username" name="txtUser"
                                            placeholder="Your Registered Email" class="form-control" autofocus>
                                        <div id="err-usename">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtPass" class="col-sm-3 control-label d-none">Password</label>
                                    <div class="col-sm-12  p-0">
                                        <input type="password" id="pack-password" name="txtPass"
                                            placeholder="Your Password" class="form-control" autofocus>
                                        <div id="err-pass">

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12 col-sm-offset-3">
                                        <button type="submit" name="btnLogin" class="btn  float-right main_login_btn"
                                            id="btnLogin"><i class="fas fa-sign-in-alt pr-2"></i> Login</button>
                                    </div>
                                    <div class="clearfix">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="create_account pr-3 text-right">
                                        <button type="button" name="register-pack-new"
                                            class="main_login_btn text-capitalize" id="register-pack-new">Create
                                            Account For New User</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="ifloggedIn">
                            <p class="price-box-title text-center billing-head">Billing Details</p>

                            <form action="" method="post" id="billingForm" >

                                <input type="hidden" name="btnSubmit" value="paypalData">
                                <input type="hidden" name="paymentData" id="paymentData" value="">

                                <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $cusId?>">
                                <input type="hidden" name="package-type" value="<?php echo $singlePackage[8];  ?>">
                                <input type="hidden" name="niche" value="<?php echo $niche;  ?>">
                                <input type="hidden" name="amount" value="<?php echo $singlePackage[0];  ?>">


                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="package-name" id="package-name" value="<?php
                                if(!empty($cusDtl)){ echo $cusDtl[0][5]." ".$cusDtl[0][6]; }?>" class="form-control">
                                    <p class="blnkReg text-danger" id="noName"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Contact</label>
                                    <input type="number" name="contact-no" id="contact-no"
                                        value="<?php if(!empty($cusDtl)){ echo $cusDtl[0][32]; }?>" class="form-control" maxlength="10" minlength="10">
                                    <p class="blnkReg text-danger" id="noContact"></p>
                                </div>

                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="package-email" id="package-email"
                                        value="<?php if(!empty($cusDtl)){ echo $cusDtl[0][3]; }?>" class="form-control">
                                    <p class="blnkReg text-danger" id="noEmail"></p>
                                </div>

                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="package-add" id="package-add"
                                        value="<?php if(!empty($cusDtl)){ echo $cusDtl[0][24]; }?>"
                                        class="form-control">
                                    <p class="blnkReg text-danger" id="noAdd"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Zip Code</label>
                                    <input type="text" name="package-pin" id="package-pin"
                                        value="<?php if(!empty($cusDtl)){ echo $cusDtl[0][29]; }?>"
                                        class="form-control">
                                    <p class="blnkReg text-danger" id="noZipCode"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <select id="packageCountry" name="packageCountry"
                                        class="form-control clients-country">
                                        <option value="<?php if(!empty($cusDtl)){ echo $cusDtl[0][30]; }?>"
                                            id="packCun"><?php
									if(!empty($countriesDtls)){
										echo $countriesDtls[0][0];
									} ?></option>
                                        <?php
                                if(isset($_SESSION['userid'])){
                                    //$utility->genDropDown($_SESSION['txtCountriesId'], $arr_val, $arr_label);
                                    $utility->populateDropDown($cusDtl[0][24], 'countries_id', 'countries_name', 'countries');
                                }else{
                                    //$utility->genDropDown(0, $arr_val, $arr_label);
                                    $utility->populateDropDown(0, 'countries_id', 'countries_name', 'countries');
                                }
                                ?>

                                    </select>
                                    <p class="blnkReg" id="noCntry"></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Notes</label>
                                    <textarea name="package-Note" rows="4" cols="80" id="package-Note"
                                        class="form-control"></textarea>
                                    <p id="noNotes" class="text-danger"></p>
                                </div>


                                <!-- <button type="submit">submit</button> -->
                            </form>
                            <div id="package-subbmit-btn">

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

                        </div>
                        <div class="ifNotRegPack">
                            <p class="price-box-title text-center billing-head">Register Form</p>
                            <p id="regFormError"></p>
                            <form class="form-horizontal" role="form" action="" name="formContactform" method="post"
                                enctype="multipart/form-data" autocomplete="off">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" id="firstName" name="firstName"
                                                placeholder="Your First Name" class="form-control" autofocus>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" id="lastName" name="lastName"
                                                placeholder="Your Last Name" class="form-control" autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="email" id="txtemail" name="txtemail"
                                                placeholder="Email (yourname@email.com)" class="form-control">
                                        </div>
                                        <div class="col-12 ">
                                            <div class="already_a_member">
                                                <span style="color:rgb(155, 155, 155);">Already a member?</span> <a
                                                    href="login.php" class="purple-text ">login</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="password" id="txtPassword" name="txtPassword"
                                                placeholder="Password (Must Have 6 Characters)" class="form-control">
                                            <span class="help-block d-none">At Least 6 Character</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3 ">
                                        <!--<div class="checkbox">
									<label>
										<input type="checkbox">I accept <a href="#">terms</a>
									</label>
								</div>-->
                                    </div>
                                </div> <!-- /.form-group -->
                                <div class="form-group">
                                    <div class="col-sm-12 col-sm-offset-3 pr-0">
                                        <button type="submit" name="btnSubmit"
                                            class="float-right btn btn-block main_register_btn" id="packRegistr"><i
                                                class="fas fa-sign-in-alt pr-2"></i>Register</button>
                                        <div class="clearfix">

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <?php //include('seller-action.php') ?>
    </div>



    <!-- Footer -->
    <?php require_once "partials/footer.php"; ?>
    <!-- /Footer -->
    <!-- <script src="js/jquery-2.2.3.min.js"></script> -->
    <script src="plugins/jquery-3.6.0.min.js"></script>

    <script>
    const checkForm = () => {


        // e.preventDefault();
        var name = $("#package-name").val();
        var email = $("#package-email").val();
        var contNum = $("#contact-no").val();
        var addrs = $("#package-add").val();
        var zipCo = $("#package-pin").val();
        var cntry = $("#packageCountry").val();
        var notes = $("#package-Note").val();
        var niche = $("#niche-choosed").html();
        var package_id = $("#package_id").html();
        let typeOfPayment = 'paypal';
        // alert(name);

        if (name == '' || name == '0') {
            $("#noName").html("Please Enter a Name");
            alert("Please Enter a Name");
        }

        $("#package-name").keyup(function() {
            $("#noName").css("display", "none");
        });

        if (contNum == '' || contNum == '0') {
            $("#noContact").html("Please Enter Contact Number!");
            alert("Enter Contact Number!");
        }

        $("#contact-no").keyup(function() {
            num = $("#contact-no").val();
            // alert(num.length);
            if (num.length < 10) {
                $("#noContact").html("Please verify the length");
            }else{

                $("#noContact").css("display", "none");
            }
        });

        if (email == '' || email == '0') {
            $("#noEmail").html("Please Enter an Email");
            alert("Please Enter an Email");
        }

        $("#package-email").keyup(function() {
            $("#noEmail").css("display", "none");
        });


        if (addrs == '' || addrs == '0') {
            $("#noAdd").html("Please Enter Your Address");
            alert("Please Enter Your Address");
        }

        $("#package-add").keyup(function() {
            $("#noAdd").css("display", "none");
        });

        if (zipCo == '' || zipCo == '0') {
            $("#noZipCode").html("Please Enter Your Zip Code");
            alert("Please Enter Your Zip Code");
        }

        $("#package-pin").keyup(function() {
            $("#noZipCode").css("display", "none");
        });
        if (cntry == '') {
            alert("Please Enter Your Country");
            $("#noCntry").html("Please Enter Your Country")
        }

        $("#packageCountry").keyup(function() {
            $("#noCntry").css("display", "none");
        });

        if (notes == '' || notes == '0') {
            $("#noNotes").html("Please Add Some Notes");
            alert("Please Add Some Notes");
        }

        $("#package-Note").keyup(function() {
            $("#noNotes").css("display", "none");
        });

        if (name == '' || name == '0' || email == '' || email == '0' || addrs == '' || addrs ==
            '0' || zipCo == '' || zipCo == '0' || cntry == '' || cntry == '0' || notes == '' || notes == '0') {
            $(".blnkReg").css("display", "block");

            document.getElementById("checkForm").checked = false;

        } else {
            const cb = document.getElementById("checkForm");
            if (cb.checked == true) {
                document.getElementById('acceptForm').classList.add('d-none');

            } else {
                document.getElementById('acceptForm').classList.remove('d-none');
            }
        }
        // return true;




    }
    </script>



    <script
        src="https://www.paypal.com/sdk/js?client-id=Ad-k2bukRixHHQ6YLq08lkeobaQU8EJtuiiW6vuuthWJIOdqEpUlpz73mKZBxU_pvTPy9q086XgtFw2d&disable-funding=credit,card&currency=USD"
        data-sdk-integration-source="button-factory"></script>
    <script>
    let totalAmount = document.getElementById('singlePackagePrice').innerText;
    let paymentData = document.getElementById('paymentData');
    // btnSubmit = document.getElementById('btnSubmit');



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

                const cb = document.getElementById("checkForm");
                if (cb.checked == true) {
                    document.getElementById('acceptForm').classList.add('d-none');

                    return actions.order.create({
                        purchase_units: [{
                            "amount": {
                                "currency_code": "USD",
                                "value": totalAmount
                            }
                        }]
                    });


                } else {
                    document.getElementById('acceptForm').classList.remove('d-none');
                    return false;
                }


                // return actions.order.create({
                //     purchase_units: [{
                //         "amount": {
                //             "currency_code": "USD",
                //             "value": totalAmount
                //         }
                //     }]
                // });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    // Full available details
                    // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    // var transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    paymentData.value = JSON.stringify(orderData);

                    // paybtn.setAttribute("name", "paypalData");
                    // btnSubmit.value = "paypalData";
                    // Show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';

                    // Or go to another URL:  actions.redirect('thank_you.html');
                    document.getElementById('billingForm').action = window.location.href;
                    document.getElementById('billingForm').submit();

                });
            },
            onCancel: function(data) {
                // alert('Cancled');
            },
            onError: function(err) {
                console.log(err);
                // alert('error');
                // window.location.href = "./payments/error-pay.php";
            }
        }).render('#paypal-button-container');
    }
    initPayPalButton();
    </script>




    <script>
    const ccAvenueOrder = () => {
        const cb = document.getElementById("checkForm");

        if (cb.checked == true) {
            // billingSubmit;
            var host = window.location.origin;

            document.getElementById('billingForm').action =
                `${host}/payments/packagePayments/ccAvenue-payment/payment.php`;
            document.getElementById('billingForm').submit();
        } else {
            document.getElementById('acceptForm').classList.remove('d-none');

        }
    }
    </script>



    <script type="text/javascript">
    $(document).ready(function() {
        var welCome = $("#welcome-client").html();
        welCome = welCome.replace(/\s\s+/g, ' ');
        if (welCome) {
            $(".ifNotLoggedIn").css("display", "none");
            $(".ifloggedIn").css("display", "block");
            $(".package-paypal").css("display", "block");
            $(".packLog-h1").css("display", "block");
        } else if (welCome == '' || welCome == null) {
            $(".ifNotLoggedIn").css("display", "block");
            $(".ifloggedIn").css("display", "none");
        }
        $("#btnLogin").click(function(e) {

            e.preventDefault();
            var username = $("#pack-username").val();
            var password = $("#pack-password").val();
            var package = $("#package_id").val();
            if (username == '' || username == '0') {
                $("#err-usename").html("Please Enter Your Username");
            }
            if (password == '' || password == '0') {
                $("#err-pass").html("Please Enter Your Password");
            }

            var formData = 'user=' + username + '&pass=' + password;

            $.ajax({

                url: 'package-login.php?' + formData,
                success: function(message) {
                    var data = message.split(",");
                    // console.log(data);
                    var result1 = data[0];
                    var result2 = data[1];
                    var cusNme1 = data[2];
                    var cusNme2 = data[3];
                    var email = data[4];
                    var adderss1 = data[5];
                    var cuszip = data[6];
                    var cusCunt = data[7];
                    var cuntName = data[8];
                    var cusId = data[9];
                    //alert(message);
                    if (result1 == 'success' && result2 != 0) {
                        $(".packLog-h1").css("display", "block");
                        $(".ifNotLoggedIn").remove();
                        $(".package-paypal").css("display", "block");
                        $(".ifloggedIn").css("display", "block");
                        $(".afterLoginCls").css("display", "block");
                        $(".signInCls").css("display", "none");

                        $("#package-name").val(cusNme1 + ' ' + cusNme2);
                        $("#package-email").val(email);
                        $("#package-add").val(adderss1);
                        $("#package-pin").val(cuszip);
                        $("#packageCountry").val(cusCunt);
                        $("#packCun").val(cusCunt).html(cuntName);
                        $("#customer_id").val(cusId);
                        location.reload();
                        // $("#welcome-client").html(clntName);
                    } else if (message == 'Invalid') {
                        // alert("Working");
                        $("#package-login-error").html("Invalid Credentials");
                    } else {

                        $("#package-login-error").html("Invalid Credentials");
                    }

                }
            })
        });

        $("#register-pack-new").click(function() {
            $(".ifNotLoggedIn").css("display", "none");
            $(".ifNotRegPack").css("display", "block");
        });

        //Package Register
        $("#packRegistr").click(function(e) {
            e.preventDefault();
            var fName = $("#firstName").val();
            var lName = $("#lastName").val();
            var email = $("#txtemail").val();
            var pass = $("#txtPassword").val();
            var cuntry = $("#selectCountry").val();
            var prof = $("#txtProfession").val();

            var formData = 'fName=' + fName + '&lName=' + lName + '&email=' + email + '&pass=' + pass;
            $.ajax({
                url: 'package-register.php?' + formData,
                success: function(message) {
                    if (message == 'insert') {
                        $(".ifNotRegPack").remove();
                        $(".ifNotLoggedIn").css("display", "block");
                        $("#package-login-error").html(
                            "Thank You for Your Registration. Use your Email and Password to Login"
                        );
                    } else if (message == 'duplicate') {
                        $("#regFormError").html("This email is already used");
                    } else {
                        $("#regFormError").html(message);
                    }
                }
            })
        })


    })
    </script>


    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>