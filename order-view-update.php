<?php
session_start();
//var_dump($_SESSION);
//include_once('checkSession.php');
require_once "_config/dbconnect.php";
require_once "_config/dbconnect.trait.php";

require_once "includes/constant.inc.php";
require_once "classes/date.class.php";
require_once "classes/error.class.php";
require_once "classes/search.class.php";
require_once "classes/customer.class.php";
require_once "classes/login.class.php";
require_once "classes/domain.class.php";

//require_once("../classes/front_photo.class.php");
require_once "classes/blog_mst.class.php";
require_once "classes/utility.class.php";
require_once "classes/utilityMesg.class.php";
// require_once "classes/utilityImage.class.php";
// require_once "classes/utilityNum.class.php";
require_once "classes/gp-order.class.php";

require_once "classes/content-order.class.php";
require_once "classes/orderStatus.class.php";


/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$domain			= new Domain();

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$ContentOrder   = new ContentOrder();
$OrderStatus    = new OrderStatus();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
// $uImg 			= new ImageUtility();
// $uNum 			= new NumUtility();
$gp				  = new Gporder();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);

// print_r($cusDtl);exit;

$currentUrl = $utility->currentUrl();

if($cusId == 0){
	header("Location: index.php");
}

if($cusDtl[0][0] == 1){
	header("Location: app.client.php");
}

if (!isset($_GET['id'])) {
	header("Location: dashboard.php");
}

$orderId = base64_decode($_GET['id']);

if (isset($_POST['reject-order'])) {
                                
    $orderStatus    = 10; // Rejected
    $reasion        = $_POST['cancellation-reason'];

    $rejected = $ContentOrder->ClientOrderOrderUpdate($orderId, $orderStatus, '', $reasion);
    if ($rejected) {
        $uMesg->showSuccessT('success', 0, '', ''.$currentUrl.'', "Order Rejected", 'SUCCESS');
    }
}

if (isset($_POST['accept-order'])) {
    
    $orderStatus    = 3; // Processing 

    $accepted = $ContentOrder->ClientOrderOrderUpdate($orderId, $orderStatus, '', '');
    if ($accepted) {
        $uMesg->showSuccessT('success', 0, '', ''.$currentUrl.'', "Order Accepted", 'SUCCESS');
    }
}

if (isset($_POST['delivered'])) {
    $orderStatus    = 1; // Deliverd 
    $deliveredLink  = $_POST['post-link'];
    $deliveredLink  = rawurlencode($deliveredLink);

    $delivered = $ContentOrder->ClientOrderOrderUpdate($orderId, $orderStatus, 'deliveredLink', $deliveredLink);
    if ($delivered) {
        $uMesg->showSuccessT('success', 0, '', ''.$currentUrl.'', "Order Delivered", 'SUCCESS');
    }
}

$order = $ContentOrder->clientOrderById($orderId);



?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>User Dashboard | Dashboard :: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="icon" href="images/logo/favicon.png" type="image/png">


    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link href="plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />

    <!-- Custom CSS -->
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/dashboard.css" rel='stylesheet' type='text/css' />
    <!-- <link href="css/sidenav.css" rel='stylesheet' type='text/css' /> -->

    <link href="css/order-list.css" rel='stylesheet' type='text/css' />
    <link href="css/my-orders.css" rel='stylesheet' type='text/css' />

    <!-- font-awesome icons -->
    <!-- <link href="css/fontawesome-all.min.css" rel="stylesheet"> -->
    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">
    <style>
    .updating-botn {
        width: 35%;
    }

    @media (max-width: 500px) {
        .updating-botn {
            width: fit-content;
        }
    }

    @media (min-width: 1280px) {
        .client_profile_dashboard_right {
            padding-right: 2rem !important;
            padding-left: -1rem !important;
        }
    }

    @media (min-width: 767px) and (max-width:1280px) {
        .client_profile_dashboard_right {
            padding-right: 2rem !important;

        }
    }

    @media (max-width: 350px) {
        .p-kage-de-tails {
            background: aliceblue;
            padding: 1rem 1rem;
        }

        .ordered-details-table-css {
            font-size: 1rem;
            font-weight: 500;
        }
    }
    </style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once 'partials/navbar.php'; ?>
        <!-- //header -->
        <!-- banner -->
        <div class="edit_profile">
            <div class="container-fluid1">
                <div class=" display-table">
                    <div class="row ">
                        <!--Row start-->
                        <div class="col-md-3 hidden-xs display-table-cell v-align" id="navigation">

                            <div class="client_profile_dashboard_left">
                                <?php include("dashboard-inc.php");?>
                                <hr>
                            </div>

                        </div>
                        <div class="col-md-9  display-table-cell v-align client_profile_dashboard_right">

                            <!-- Details section Start  -->
                            <div class="p-kage-de-tails">
                                <div class="">
                                    <!-- Order Details Start -->
                                    <?php
                                            $showOrder  = $ContentOrder->clientOrderById($orderId);
                                            $buyer = $customer->getCustomerData($showOrder[0]['clientUserId']);
                                            $statusName = $OrderStatus->singleOrderStatus($showOrder[0]['clientOrderStatus']);

                                        ?>
                                    <h5 class="pkage-title border-bottom pb-2">Order Details:</h5>
                                    <h5 class="pkage-headline pt-3">
                                        <?php echo $showOrder[0]['clientOrderedSite']; ?><span
                                            class="ms-2 badge <?php echo $statusName[0][1]; ?>"><?php echo $statusName[0][1]; ?></span>
                                    </h5>
                                    <!-- <p class="fs-6 fw-semibold"><?php echo $showOrder[0]['niche']; ?></p> -->
                                    <table class="ordered-details-table-css ">
                                        <tr>
                                            <td>Order Id</td>
                                            <td>:</td>
                                            <td><?php echo "#".$showOrder[0]['id']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Transection Id</td>
                                            <td>:</td>
                                            <td style="word-break: break-word;">
                                                <?php echo "#".$showOrder[0]['clientTransactionId']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Price</td>
                                            <td>:</td>
                                            <td><?php echo "$".$showOrder[0]['clientOrderPrice']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Payment</td>
                                            <td>:</td>
                                            <td><?php echo $showOrder[0]['paymentStatus']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Payment</td>
                                            <td>:</td>
                                            <td><?php echo date('l jS \of F Y h:i:s A', strtotime($showOrder[0]['added_on'])); ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- <ul class="listing-adrs">
                                            <li> Order Id : <?php echo "#".$showOrder[0]['id']; ?>
                                            </li>
                                            <li> Transection Id : <?php echo $showOrder[0]['clientTransactionId']; ?>
                                            </li>
                                            <li> Price : <?php echo '$'.$showOrder[0]['clientOrderPrice']; ?></li>
                                            <li> Order : <?php echo $statusName[0][1]; ?></li>
                                            <li> Payment : <?php echo $showOrder[0]['paymentStatus']; ?></li>
                                            <li> Date :
                                                <?php echo date('l jS \of F Y h:i:s A', strtotime($showOrder[0]['added_on'])); ?>
                                            </li>
                                        </ul> -->
                                    <!-- Order Details End -->

                                </div>
                            </div>
                            <!-- Details section End -->

                            <?php
                                $delivered = false;
                                if($showOrder[0]['clientOrderStatus'] == 4 ){
                                    $fieldStatus = '';
                                }elseif($showOrder[0]['clientOrderStatus'] == 3 ){
                                    $fieldStatus = '';
                                }elseif($showOrder[0]['clientOrderStatus'] == 1 ){
                                    $fieldStatus = 'disabled';
                                    $delivered = true;
                                }else {
                                    $fieldStatus = 'disabled';
                                }

                                if ($delivered) {
                                    echo '<div class="delivered_sec container mt-4">
                                            <h3>Your ordered article link is: </h3>
                                            <div class="text-wrap">
                                                <input type="text" class="form-control" id="articleLink" value="'. rawurldecode($showOrder[0]['deliveredLink']).'">
                                                <div id="copyArticleLink" class="clipboard icon"></div>
                                            </div>
                                        </div>';
                                }
                            ?>


                            <div class="card rounded-0 shadow-sm mt-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <p class="text-primary fw-bold">Anchor Text</p>
                                            <div class="text-wrap">
                                                <input type="text" class="form-control" id="anchor-text"
                                                    value="<?php echo $order[0]['clientAnchorText'];?>">
                                                <div id="copyAnchorText" class="clipboard icon"></div>
                                            </div>

                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <p class="text-primary fw-bold">Target URL</p>
                                            <div class="text-wrap">
                                                <input type="text" class="form-control" id="target-url"
                                                    value="<?php echo $order[0]['clientTargetUrl'];?>">
                                                <div id="copyTargetUrl" class="clipboard icon"></div>
                                            </div>

                                        </div>
                                        <div class="col-12 mt-3">
                                            <p class="text-primary fw-bold">Content <span
                                                    class="text-danger fw-light"><small> Drag the right down corner of
                                                        the textarea to get the complete content</small></span></p>
                                            <div class="text-wrap">

                                                <textarea class="form-control" id="content"
                                                    rows="6"><?php echo $order[0]['clientContent'];?></textarea>
                                                <div id="copyContent" class="clipboard icon"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <p class="text-primary fw-bold">Special Requirements</p>
                                            <div class="text-wrap">
                                                <textarea class="form-control" id="special-requirements"
                                                    rows="6"><?php echo $order[0]['clientRequirement'];?></textarea>
                                                <div id="copyRequirements" class="clipboard icon"></div>
                                            </div>

                                        </div>


                                    </div>
                                    <?php

                                    if ($order[0]['clientOrderStatus'] == 10) { //if Rejected
                                        
                                    ?>
                                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post"
                                        class="d-flex justify-content-evenly py-4">
                                        <button class="btn w-50 contact_button" name="">Contact Leelija</button>
                                    </form>
                                    <?php
                                    }elseif($order[0]['clientOrderStatus'] == 3) {   // if processing
                                    ?>
                                    <div class="text-center py-4">
                                        <button class="btn updating-botn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#deliverModal">Update Deliver</button>
                                    </div>
                                    <?php
                                    }elseif($order[0]['clientOrderStatus'] == 1) {   // if delivered
                                        ?>
                                    <div class="text-center py-4">
                                        <p class="text-light bg-primary fs-4 fw-bold">Order Delivered.</p>
                                    </div>
                                    <?php
                                    }else {
                                    ?>
                                    <div class="d-flex justify-content-evenly p-4 p-md-5">
                                        <div class="col-sm-6 d-flex justify-content-evenly"
                                            style="padding-bottom: inherit;">
                                            <button class="btn btn-danger w-50" data-bs-toggle="modal"
                                                data-bs-target="#rejectModal">Reject</button>
                                        </div>
                                        <div class="col-sm-6">

                                            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post"
                                                class="d-flex justify-content-evenly">
                                                <button class="btn btn-primary w-50" name="accept-order">Accept</button>
                                            </form>
                                        </div>

                                    </div>
                                    <?php
                                    }
                                    ?>

                                    <!-- Start Reject Modal -->
                                    <div class="modal fade" id="rejectModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                                                        <div class="mb-3">
                                                            <label for="cancellation-reason" class="form-label">Reason
                                                                of cancellation</label>
                                                            <textarea class="form-control" id="cancellation-reason"
                                                                name="cancellation-reason" rows="3"></textarea>
                                                        </div>
                                                        <div class="text-center">
                                                            <button class="btn btn-sm btn-danger"
                                                                name="reject-order">Reject</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Reject Modal  -->

                                    <!-- Deliver Update Modal -->
                                    <div class="modal fade" id="deliverModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header py-1">
                                                    <h3>Successfull Link</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form name="deliverForm"
                                                        action="<?php echo $_SERVER['REQUEST_URI']; ?>"
                                                        onsubmit="return validateForm()" method="POST"
                                                        class="text-center">

                                                        <input type="text" class="form-control" name="post-link">
                                                        <span class="text-danger d-block" id="blank-msg"></span>
                                                        <button class="btn btn-sm btn-danger mt-3"
                                                            name="delivered">Delivered</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Deliver Update Modal -->



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //end display table-->

                <!-- Footer -->
                <?php require_once 'partials/footer.php'; ?>
                <!-- /Footer -->
            </div>
        </div>


        <script>
        document.getElementById('copyAnchorText').addEventListener('click', function() {

            var text = document.getElementById('anchor-text');
            text.select();
            document.execCommand('copy');

        })


        document.getElementById('copyTargetUrl').addEventListener('click', function() {

            var text = document.getElementById('target-url');
            text.select();
            document.execCommand('copy');

        })


        document.getElementById('copyRequirements').addEventListener('click', function() {

            var text = document.getElementById('special-requirements');
            text.select();
            document.execCommand('copy');

        })

        document.getElementById('copyContent').addEventListener('click', function() {

            var text = document.getElementById('content');
            text.select();
            document.execCommand('copy');

        })


        function validateForm() {

            let postUrl = document.forms["deliverForm"]["post-link"].value;
            if (postUrl == "") {
                document.getElementById('blank-msg').innerText = "Link Can't be blank";
                return false;
            } else {
                // function isValidHttpUrl(postUrl) {
                let url;
                try {
                    url = new URL(postUrl);
                } catch (_) {
                    document.getElementById('blank-msg').innerText = "Link is not valid";
                    return false;
                }
                return url.protocol === "http:" || url.protocol === "https:";
                // }
            }
            // console.log("http://example.com: " + isValidHttpUrl("https://example.com"));
            // console.log("example.com: " + isValidHttpUrl("example.com"));
        }
        </script>


        </script>
        <!-- //fixed-scroll-nav-js -->
        <script src="plugins/jquery-3.6.0.min.js"></script>
        <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
        <script src="js/pageplugs/fixedNav.js"></script>
        <script src="plugins/sweetalert/sweetalert2.all.js"></script>
        <!-- Switch Customer Type -->
        <script src="js/customerSwitchMode.js"></script>
</body>

</html>