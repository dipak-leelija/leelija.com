<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";
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
    <title>Neptune - Responsive Admin Dashboard Template</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL ?>assets/portal-assets/plugins/fontawesome-6.1.1/css/all.min.css">
    <link href="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/highlight/styles/github-gist.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="<?= URL ?>assets/portal-assets/css/main.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="assets/portal-assets/images/neptune.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/portal-assets/images/neptune.png" />
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
                                <div class="page-description text-center">
                                    <h1>Pricing Tables</h1>
                                    <span>Elegant, responsive and simple pricing tables.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-12 col-sm-offset-2 col-sm-10 col-lg-offset-2 col-lg-10 mx-auto">
                                <div class="row">
                                    <div class="col-12 col-xl-4">
                                        <div class="card pricing-basic">
                                            <div class="card-body">
                                                <h3 class="plan-title">Standard</h3>
                                                <div class="plan-price">
                                                    <span class="plan-price-value">$49</span>
                                                    <span class="plan-price-period">/ month</span>
                                                </div>
                                                <span class="plan-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                                                <ul class="plan-list">
                                                    <li>Up to 10 Devices</li>
                                                    <li>250GB of SSD Storage</li>
                                                    <li>500GB Monthly Bandwidth</li>
                                                    <li>50 Email Accounts</li>
                                                    <li>30 Form Submissions</li>
                                                    <li>24/7 Online Support</li>
                                                </ul>
                                                <div class="m-t-md d-grid">
                                                    <button class="btn btn-secondary btn-lg" type="button">Buy Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="card pricing-basic pricing-selected">
                                            <div class="card-body">
                                                <h3 class="plan-title">Premium<span class="badge badge-info badge-style-light">Popular</span></h3>
                                                <div class="plan-price">
                                                    <span class="plan-price-value">$79</span>
                                                    <span class="plan-price-period">/ month</span>
                                                </div>
                                                <span class="plan-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                                                <ul class="plan-list">
                                                    <li>Up to 50 Devices</li>
                                                    <li>500GB of SSD Storage</li>
                                                    <li>Unlimited Monthly Bandwidth</li>
                                                    <li>100 Email Accounts</li>
                                                    <li>300 Form Submissions</li>
                                                    <li>24/7 Online Support</li>
                                                </ul>
                                                <div class="m-t-md d-grid">
                                                    <button class="btn btn-primary btn-lg" type="button">Buy Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="card pricing-basic">
                                            <div class="card-body">
                                                <h3 class="plan-title">Enterprise</h3>
                                                <div class="plan-price">
                                                    <span class="plan-price-value">$149</span>
                                                    <span class="plan-price-period">/ month</span>
                                                </div>
                                                <span class="plan-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                                                <ul class="plan-list">
                                                    <li>Unlimited Devices</li>
                                                    <li>5TB of SSD Storage</li>
                                                    <li>Unlimited Monthly Bandwidth</li>
                                                    <li>Unlimited Email Accounts</li>
                                                    <li>Unlimited Form Submissions</li>
                                                    <li>Private Support</li>
                                                </ul>
                                                <div class="m-t-md d-grid">
                                                    <button class="btn btn-secondary btn-lg" type="button">Buy Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>
</body>

</html>