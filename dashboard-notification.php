<?php
session_start();
//include_once('checkSession.php');
// require_once("_config/connect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
// require_once("classes/date.class.php");
// require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
// require_once("classes/login.class.php");
require_once("classes/domain.class.php");

//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
// require_once("classes/utilityMesg.class.php");
// require_once("classes/utilityImage.class.php");
// require_once("classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
// $dateUtil      	= new DateUtil();
// $error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
// $logIn			= new Login();
$domain			= new Domain();

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$utility		= new Utility();
// $uMesg 			= new MesgUtility();
// $uImg 			= new ImageUtility();
// $uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);

if($cusDtl[0][0] == 0){
	header("Location: index.php");
}

if($cusDtl[0][0] == 1){ 
	header("Location: app.client.php");
}

$blogsDtls 	= $blogMst->ShowUserBlogData($cusDtl[0][2]);
$domainDtls	= $domain->ShowUserDomainData($cusDtl[0][2]);

?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>Seller Dashboard :: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <script>
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>

    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link href="plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />

    <!-- Custom CSS -->
    <link href="css/my-orders.css" rel='stylesheet' type='text/css' />
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/partials.css">
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/form.css" rel='stylesheet' type='text/css' />
    <link href="css/dashboard.css" rel='stylesheet' type='text/css' />
    <link href="css/dashboard-notification.css" rel='stylesheet' type='text/css' />
    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">

    <style>
    .toast:not(.show) {
        display: inherit !important;
    }

    .toast {
        --bs-toast-padding-x: 0.75rem;
        --bs-toast-padding-y: 0.5rem;
        --bs-toast-spacing: 1.5rem;
        --bs-toast-max-width: 350px;
        --bs-toast-box-shadow: none !important;
        width: 100% !important;
        --bs-toast-border-color: none;
    }
    </style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once 'partials/navbar.php'; ?>
        <!-- //header -->
        <!-- banner -->
        <div class="edit_profile" style="overflow: hidden;">
            <div class="container-fluid1">
                <div class=" display-table">
                    <div class="row ">
                        <!--Row start-->
                        <div class="col-md-3 hidden-xs display-table-cell v-align" id="navigation">
                            <div class="client_profile_dashboard_left">
                                <?php include("dashboard-inc.php");?>

                            </div>

                        </div>
                        <div class="col-md-9  display-table-cell v-align client_profile_dashboard_right">
                            <div class="toast">
                                <h2 class="notice-title">Notifications <i class="fa-solid fa-bell fa-shake"></i></h2>
                                <!-- notification-1 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/emps/rozy-begum.jpg"
                                                    class="notify-person-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Rozy hayat</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/team/2.jpg" class="notify-post-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-1 end-->
                                <!-- notification-2 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/portfolio/author.jpeg"
                                                    class="notify-person-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Hande Ircel</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/team/1.jpg" class="notify-post-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-2 end-->
                                <!-- notification-3 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/team/2.jpg" class="notify-person-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Rahul </strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/emps/rozy-begum.jpg"
                                                    class="notify-post-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-3 end -->
                                <!-- notification-4 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/team/1.jpg" class="notify-person-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Krusal</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/portfolio/author.jpeg"
                                                    class="notify-post-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-4 end -->
                                <!-- notification-5 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/emps/rozy-begum.jpg"
                                                    class="notify-person-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Rozy hayat</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/team/2.jpg" class="notify-post-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-5 end-->
                                <!-- notification-6 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/portfolio/author.jpeg"
                                                    class="notify-person-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Hande Ircel</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/team/1.jpg" class="notify-post-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-6 end-->
                                <!-- notification-7 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/team/2.jpg" class="notify-person-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Rahul </strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/emps/rozy-begum.jpg"
                                                    class="notify-post-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-7 end -->
                                <!-- notification-8 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/team/1.jpg" class="notify-person-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Krusal</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/portfolio/author.jpeg"
                                                    class="notify-post-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-8 end -->
                                <!-- notification-9 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/emps/rozy-begum.jpg"
                                                    class="notify-person-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Rozy hayat</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/team/2.jpg" class="notify-post-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-9 end-->
                                <!-- notification-10 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/portfolio/author.jpeg"
                                                    class="notify-person-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Hande Ircel</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/team/1.jpg" class="notify-post-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-10 end-->
                                <!-- notification-11 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/team/2.jpg" class="notify-person-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Rahul </strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/emps/rozy-begum.jpg"
                                                    class="notify-post-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-11 end -->
                                <!-- notification-12 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/team/1.jpg" class="notify-person-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Krusal</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/portfolio/author.jpeg"
                                                    class="notify-post-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-12 end -->
                                <!-- notification-13 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/emps/rozy-begum.jpg"
                                                    class="notify-person-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Rozy hayat</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/team/2.jpg" class="notify-post-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-13 end-->
                                <!-- notification-14 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/portfolio/author.jpeg"
                                                    class="notify-person-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Hande Ircel</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/team/1.jpg" class="notify-post-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-14 end-->
                                <!-- notification-15 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/team/2.jpg" class="notify-person-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Rahul </strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/emps/rozy-begum.jpg"
                                                    class="notify-post-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-15 end -->
                                <!-- notification-16 -->
                                <div class="notification-main-division my-2 item_order_bx coloring-cd">
                                    <div class="row">
                                        <div
                                            class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                            <div>
                                                <img src="images/team/1.jpg" class="notify-person-img rounded me-2"
                                                    alt="...">
                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                            <div class="notification-para">
                                                <p class="notify-body">
                                                    <strong class="person-name">Krusal</strong> created a new
                                                    website.
                                                </p>
                                                <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit amet
                                                    consectetur adipisicing elit.</p>
                                                <p class="notify-body"> <small class="notify-time">11 mins ago</small>
                                                </p>
                                            </div>

                                        </div>
                                        <div
                                            class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                            <div style=" text-align: end;">
                                                <img src="images/portfolio/author.jpeg"
                                                    class="notify-post-img rounded me-2" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- notification-16 end -->
                            </div>
                        </div>
                        <!--Row end-->
                    </div>

                    <!-- Modal -->
                    <div id="add_project" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header login-header">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    <h4 class="modal-title">Add Project</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="text" placeholder="Project Title" name="name">
                                    <input type="text" placeholder="Post of Post" name="mail">
                                    <input type="text" placeholder="Author" name="passsword">
                                    <textarea placeholder="Desicrption"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                                    <button type="button" class="add-project" data-dismiss="modal">Save</button>
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
        <!-- js-->
        <!-- <script src="js/jquery-2.2.3.min.js"></script> -->
        <script src="plugins/jquery-3.6.0.min.js"></script>
        <!-- alax custom library  -->
        <script src="js/ajax.js"></script>
        <script src="js/customerSwitchMode.js"></script>





        <!-- js-->
        <!-- Scrolling Nav JavaScript -->
        <script src="js/scrolling-nav.js"></script>
        <script>
        $(document).ready(function() {
            $('[data-toggle="offcanvas"]').click(function() {
                $("#navigation").toggleClass("hidden-xs");
            });
        });
        </script>


        <!-- //fixed-scroll-nav-js -->
        <script src="js/pageplugs/fixedNav.js"></script>


        <!-- Banner text Responsiveslides -->

        <!-- //Banner text  Responsiveslides -->
        <!-- start-smooth-scrolling -->
        <script src="js/move-top.js"></script>
        <script src="js/easing.js"></script>
        <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
        </script>
        <script>
        /* jQuery Pagination */

        (function($) {

            var paginate = {
                startPos: function(pageNumber, perPage) {
                    // determine what array position to start from
                    // based on current page and # per page
                    return pageNumber * perPage;
                },

                getPage: function(items, startPos, perPage) {
                    // declare an empty array to hold our page items
                    var page = [];

                    // only get items after the starting position
                    items = items.slice(startPos, items.length);

                    // loop remaining items until max per page
                    for (var i = 0; i < perPage; i++) {
                        page.push(items[i]);
                    }

                    return page;
                },

                totalPages: function(items, perPage) {
                    // determine total number of pages
                    return Math.ceil(items.length / perPage);
                },

                createBtns: function(totalPages, currentPage) {
                    // create buttons to manipulate current page
                    var pagination = $('<div class="pagination" />');

                    // add a "first" button
                    pagination.append('<span class="pagination-button">&laquo;</span>');

                    // add pages inbetween
                    for (var i = 1; i <= totalPages; i++) {
                        // truncate list when too large
                        if (totalPages > 5 && currentPage !== i) {
                            // if on first two pages
                            if (currentPage === 1 || currentPage === 2) {
                                // show first 5 pages
                                if (i > 5) continue;
                                // if on last two pages
                            } else if (currentPage === totalPages || currentPage === totalPages - 1) {
                                // show last 5 pages
                                if (i < totalPages - 4) continue;
                                // otherwise show 5 pages w/ current in middle
                            } else {
                                if (i < currentPage - 2 || i > currentPage + 2) {
                                    continue;
                                }
                            }
                        }

                        // markup for page button
                        var pageBtn = $('<span class="pagination-button page-num" />');

                        // add active class for current page
                        if (i == currentPage) {
                            pageBtn.addClass('active');
                        }

                        // set text to the page number
                        pageBtn.text(i);

                        // add button to the container
                        pagination.append(pageBtn);
                    }

                    // add a "last" button
                    pagination.append($('<span class="pagination-button">&raquo;</span>'));

                    return pagination;
                },

                createPage: function(items, currentPage, perPage) {
                    // remove pagination from the page
                    $('.pagination').remove();

                    // set context for the items
                    var container = items.parent(),
                        // detach items from the page and cast as array
                        items = items.detach().toArray(),
                        // get start position and select items for page
                        startPos = this.startPos(currentPage - 1, perPage),
                        page = this.getPage(items, startPos, perPage);

                    // loop items and readd to page
                    $.each(page, function() {
                        // prevent empty items that return as Window
                        if (this.window === undefined) {
                            container.append($(this));
                        }
                    });

                    // prep pagination buttons and add to page
                    var totalPages = this.totalPages(items, perPage),
                        pageButtons = this.createBtns(totalPages, currentPage);

                    container.after(pageButtons);
                }
            };

            // stuff it all into a jQuery method!
            $.fn.paginate = function(perPage) {
                var items = $(this);

                // default perPage to 5
                if (isNaN(perPage) || perPage === undefined) {
                    perPage = 5;
                }

                // don't fire if fewer items than perPage
                if (items.length <= perPage) {
                    return true;
                }

                // ensure items stay in the same DOM position
                if (items.length !== items.parent()[0].children.length) {
                    items.wrapAll('<div class="pagination-items" />');
                }

                // paginate the items starting at page 1
                paginate.createPage(items, 1, perPage);

                // handle click events on the buttons
                $(document).on('click', '.pagination-button', function(e) {
                    // get current page from active button
                    var currentPage = parseInt($('.pagination-button.active').text(), 10),
                        newPage = currentPage,
                        totalPages = paginate.totalPages(items, perPage),
                        target = $(e.target);

                    // get numbered page
                    newPage = parseInt(target.text(), 10);
                    var i = currentPage;
                    i <= totalPages;
                    i++;
                    if (target.text() == '»') newPage = i++;
                    i--;
                    if (target.text() == '«') newPage = --i;
                    // ensure newPage is in available range
                    if (newPage > 0 && newPage <= totalPages) {
                        paginate.createPage(items, newPage, perPage);
                    }
                });
            };

        })(jQuery);

        /* This part is just for the demo,
        not actually part of the plugin */
        $('.item_order_bx').paginate(7);
        </script>

        <!-- //end-smooth-scrolling -->
        <!-- smooth-scrolling-of-move-up -->
        <script src="js/pageplugs/toPageTop.js"></script>

        <script src="js/SmoothScroll.min.js"></script>
        <!-- //smooth-scrolling-of-move-up -->
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.js">
        </script>
        <!-- //Bootstrap Core JavaScript -->






</body>

</html>