<?php 
session_start();
// require_once("_config/connect.php");
require_once "_config/dbconnect.php";
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
require_once("includes/user.inc.php");
require_once("includes/email.inc.php");
require_once("includes/registration.inc.php");
// require_once("includes/company_contact.inc.php");
// require_once("includes/order_landing.inc.php");
require_once("includes/paypal.inc.php");

require_once("classes/error.class.php"); 
require_once("classes/date.class.php"); 
require_once("classes/customer.class.php");

require_once("classes/order.class.php");

require_once("classes/utility.class.php"); 
require_once("classes/utilityMesg.class.php"); 
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");
require_once("classes/utilityStr.class.php");

/* INSTANTIATING CLASSES */
$error			= new Error();
$dateUtil		= new DateUtil();


$ordObj			= new Order();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$uStr 			= new StrUtility();
$customer		= new Customer();

$cusId		= $utility->returnSess('userid', 0);

$cusDtl		= $customer->getCustomerData($cusId);


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');


?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Payment Error - Order can not be processed</title>
    <link rel="stylesheet" href="<?php echo URL ?>style/ansysoft.css" type="text/css" />
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">
    <link rel="stylesheet" href="css/leelija.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- JavaScript -->

    <!-- eof JavaScript -->

</head>


<body>

    <!-- Start  Header -->
    <?php require_once 'partials/navbar.php'; ?>
    <!-- End  Header -->

    <!-- Start  MainWrap -->
    <div id="mainWrap" class="d-flex justify-content-center py-5">
        <div class="card rounded shadow border-0 w-75">
            <div class="row">
                <div class="col-12 col-sm-4 img">
                    <div class="title-text" title="Payment Error" align="center">
                        <img src="images/icons/error.png" width="250" height="250" alt="Payment Error" />
                    </div>
                </div>
                <div class=" col-12 col-sm-8 card-body">
                    <h2 class="card-title">Payment Error - Order can not be processed</h2>

                    <p class="card-text align-middle ">There was problem in the payment. Either you have cancelled it or
                        the information that you have entered are
                        invalid.</p>
                    <p class="text-warning">
                        If this problem continues, write an email to crabman@live.co.za. We are sorry if there is
                        any
                        problem in our system.
                    </p>
                    <div class="d-flex justify-content-evenly py-3">
                        <a class="update_btn" href="wishlist.php">Order Again</a>
                        <a class="cancel_btn" href="app.client.php">Go to Home Page</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>

    <!-- Start Foter -->
    <?php require_once "partials/footer.php"; ?>

    <!-- End Foter -->
</body>

</html>