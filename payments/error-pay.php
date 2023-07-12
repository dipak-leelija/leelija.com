<?php
session_start();

require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";

require_once "../includes/constant.inc.php";
require_once "../classes/gp-order.class.php";
require_once "../classes/customer.class.php";
require_once "../classes/utility.class.php";


$utility	= new Utility();
$customer   = new Customer();
$gp 		= new Gporder();


$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId	= $utility->returnSess('userid', 0);


?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Payment Error - Order can not be processed</title>

    <link rel="shortcut icon" href="../images/logo/favicon.png" type="image/png"/>
    <link rel="apple-touch-icon" href="../images/logo/favicon.png" />

    <link rel="stylesheet" href="../plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="../plugins/fontawesome-6.1.1/css/all.css">
    <link rel="stylesheet" href="../css/leelija.css">
    <link rel="stylesheet" href="../css/style.css">

</head>


<body>

    <!-- Start  Header -->
    <?php require_once '../partials/navbar.php'; ?>
    <!-- End  Header -->

    <!-- Start  MainWrap -->
    <div id="mainWrap" class="d-flex justify-content-center py-5">
        <div class="card rounded shadow border-0 w-75">
            <div class="row">
                <div class="col-12 col-sm-4 img">
                    <div class="title-text" title="Payment Error" align="center">
                        <img src="<?php echo URL;?>/images/icons/error.png" width="250" height="250" alt="Payment Error" />
                    </div>
                </div>
                <div class=" col-12 col-sm-8 card-body">
                    <h2 class="card-title text-primary">Payment Error - Order can not be processed</h2>

                    
                    <!-- <div class="row p-3 w-md-50">
                    <?php
                        if (isset($_GET['gpdata'])) {
                            echo '<div class="col-12 col-sm-6"><b>Order ID :</b></div>
                            <div class="col-12 col-sm-6"> #'.base64_decode($_GET['gpdata']).'</div>';
                        }
                        if (isset($_GET['paypalgpData'])) {
                            echo '<div class="col-12 col-sm-6"><b>Order ID :</b></div>
                            <div class="col-12 col-sm-6"> #'.base64_decode($_GET['paypalgpData']).'</div>';
                        }
                    ?>
                    </div> -->

                    <?php
                    $pending = false;
                        if (isset($_GET['msg'])) {
                            $msg = base64_decode($_GET['msg']);
                            if ($msg == 'Pending') {
                                $pending = true;
                            }
                        }
                    ?>
                    <?php
                        if ($pending == true) {
                            echo '<p class="card-text align-middle ">Your payment is abroted. It may be internal issue or network issue please stay with us, we will update you soon.</p>';
                        }else {
                            echo '<p class="card-text align-middle ">There was problem during the payment. Either you have cancelled it or the information you have entered are invalid.</p>';
                        }
                    ?>
                    
                    <p class="text-danger">
                        If this problem continues, write an email to <span class="text-primary fw-semibold"><?php echo SITE_BILLING_EMAIL;?></span> We are sorry if there is
                        any
                        problem in our system.
                    </p>
                    <div class="d-flex justify-content-evenly py-3">
                        <?php

                        if (isset($_SESSION['reorder-page'])) {
                            echo '<a class="update_btn" href="'.$_SESSION['reorder-page'].'">Order Again</a>';
                        }else {
                            echo '<a class="update_btn" href="'.URL.'">Home</a>';
                        }
                        ?>
                        
                        <a class="cancel_btn" href="<?php echo CLIENT_AREA;?>">My Account</a>
                    </div>
                    
                </div>
            </div>

        </div>

    </div>
    </div>

    <!-- Start Foter -->
    <?php require_once "../partials/footer.php"; ?>

    <!-- End Foter -->
</body>

</html>