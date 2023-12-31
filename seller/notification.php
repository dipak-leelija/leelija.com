<?php
session_start();
$page = "Admin_notification";
require_once dirname(__DIR__)."/includes/constant.inc.php";
require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/search.class.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/domain.class.php";
require_once ROOT_DIR."classes/utility.class.php";

/* INSTANTIATING CLASSES */
$search_obj		= new Search();
$customer		= new Customer();
$domain			= new Domain();
$utility		= new Utility();
######################################################################################################################
$currentURL = $utility->currentUrl();

require_once 'seller-session.inc.php';

$domainDtls	= $domain->ShowUserDomainData($cusDtl[0][2]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">

    <!-- Title -->
    <title><?php echo COMPANY_FULL_NAME; ?>: Notifications</title>
    <link rel="shortcut icon" href="<?= FAVCON_PATH ?>" />

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/fontawesome-6.1.1/css/all.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/highlight/styles/github-gist.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/datatables/datatables.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/vendors/pagination/pagination.css" rel="stylesheet" >

    <!-- Theme Styles -->
    <link href="<?= URL ?>assets/portal-assets/css/main.min.css" rel="stylesheet">
    <link href="<?= URL ?>css/dashboard-notification.css" rel='stylesheet' type='text/css' />
    <style>
    .toast:not(.show) {
        display: inherit !important;
    }

    .toast:not(.showing):not(.show) {
        opacity: 1 !important;
    }

    .toast {
        border: none;
        background-color: transparent;
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

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <?php require_once ROOT_DIR."components/sidebar.php"; ?>
        <!-- sidebar ends -->
        <div class="app-container">
            <!-- navbar header starts -->
            <?php require_once ROOT_DIR."components/navbar.php"; ?>
            <!-- navbar header ends -->
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card page-description">
                                    <h2>Notifications <i class="fa-solid fa-bell fa-shake"></i></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="toast">

                                    <!-- notification-1 -->
                                    <div class="notification-main-division mb-2 item_order_bx coloring-cd">
                                        <div class="row">
                                            <div
                                                class="col-xl-1 ps-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 m-auto image-column-div">
                                                <div>
                                                    <img src="<?= URL ?>images/team/rozy-begum.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Rozy hayat</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/2.jpg"
                                                        class="notify-post-img rounded me-2" alt="...">
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
                                                    <img src="<?= URL ?>images/portfolio/author.jpeg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Hande Ircel</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/1.jpg"
                                                        class="notify-post-img rounded me-2" alt="...">
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
                                                    <img src="<?= URL ?>images/team/2.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Rahul </strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/rozy-begum.jpg"
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
                                                    <img src="<?= URL ?>images/team/1.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Krusal</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/portfolio/author.jpeg"
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
                                                    <img src="<?= URL ?>images/team/rozy-begum.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Rozy hayat</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/2.jpg"
                                                        class="notify-post-img rounded me-2" alt="...">
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
                                                    <img src="<?= URL ?>images/portfolio/author.jpeg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Hande Ircel</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/1.jpg"
                                                        class="notify-post-img rounded me-2" alt="...">
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
                                                    <img src="<?= URL ?>images/team/2.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Rahul </strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/rozy-begum.jpg"
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
                                                    <img src="<?= URL ?>images/team/1.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Krusal</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/portfolio/author.jpeg"
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
                                                    <img src="<?= URL ?>images/team/rozy-begum.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Rozy hayat</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/2.jpg"
                                                        class="notify-post-img rounded me-2" alt="...">
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
                                                    <img src="<?= URL ?>images/portfolio/author.jpeg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Hande Ircel</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/1.jpg"
                                                        class="notify-post-img rounded me-2" alt="...">
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
                                                    <img src="<?= URL ?>images/team/2.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Rahul </strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/rozy-begum.jpg"
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
                                                    <img src="<?= URL ?>images/team/1.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Krusal</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/portfolio/author.jpeg"
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
                                                    <img src="<?= URL ?>images/team/rozy-begum.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Rozy hayat</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/2.jpg"
                                                        class="notify-post-img rounded me-2" alt="...">
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
                                                    <img src="<?= URL ?>images/portfolio/author.jpeg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Hande Ircel</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/1.jpg"
                                                        class="notify-post-img rounded me-2" alt="...">
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
                                                    <img src="<?= URL ?>images/team/2.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Rahul </strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/team/rozy-begum.jpg"
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
                                                    <img src="<?= URL ?>images/team/1.jpg"
                                                        class="notify-person-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-9 info-column-div">
                                                <div class="notification-para">
                                                    <p class="notify-body">
                                                        <strong class="person-name">Krusal</strong> created a new
                                                        website.
                                                    </p>
                                                    <p class="notify-body">Lorem ipsum dolor sit,Lorem ipsum, dolor sit
                                                        amet
                                                        consectetur adipisicing elit.</p>
                                                    <p class="notify-body"> <small class="notify-time">11 mins
                                                            ago</small>
                                                    </p>
                                                </div>

                                            </div>
                                            <div
                                                class="col-xl-1 col-lg-2 col-md-2 col-sm-2 d-sm-inline-block    justify-content-end d-none m-auto">
                                                <div style=" text-align: end;">
                                                    <img src="<?= URL ?>images/portfolio/author.jpeg"
                                                        class="notify-post-img rounded me-2" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- notification-16 end -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="<?= URL ?>assets/portal-assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/pace/pace.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/highlight/highlight.pack.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/datatables/datatables.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/pages/datatables.js"></script>
    <script src="<?= URL ?>assets/vendors/pagination/pagination.js"></script>
    <script>
    $('.item_order_bx').paginate(7);
    </script>
</body>

</html>