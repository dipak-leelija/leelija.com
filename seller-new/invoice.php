
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
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="card invoice">
                                    <div class="card-body">
                                        <div class="invoice-header">
                                            <div class="row">
                                                <div class="col-9">
                                                    <h3>Invoice</h3>
                                                </div>
                                                <div class="col-3">
                                                    <span class="invoice-issue-date">Date: 14 January</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p class="invoice-description">Maecenas vitae ornare leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras euismod diam nulla, pulvinar convallis tellus ullamcorper vel. In vel nulla quis ligula feugiat posuere vel sed arcu. Vestibulum consequat tellus quam, eu eleifend augue auctor ultrices. Donec ultricies elit sed magna maximus, vitae viverra magna consectetur.</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table invoice-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">description</th>
                                                            <th scope="col">Client</th>
                                                            <th scope="col">Issue Date</th>
                                                            <th scope="col">Total</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">3311</th>
                                                            <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                                            <td>Chloe Hawkins<img src="assets/portal-assets/images/avatars/avatar.png" alt=""></td>
                                                            <td>11 APR 2021</td>
                                                            <td>$3223</td>
                                                            <td><span class="badge bg-primary">Delivered</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2331</th>
                                                            <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                                            <td>Oskar Hudson<img src="assets/portal-assets/images/avatars/avatar.png" alt=""></td>
                                                            <td>7 APR 2021</td>
                                                            <td>$3422</td>
                                                            <td><span class="badge bg-info">Declined</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2344</th>
                                                            <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                                            <td>Sky Meyers<img src="assets/portal-assets/images/avatars/avatar.png" alt=""></td>
                                                            <td>7 APR 2021</td>
                                                            <td>$2415</td>
                                                            <td><span class="badge bg-primary">Delivered</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2345</th>
                                                            <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                                            <td>John Gay<img src="assets/portal-assets/images/avatars/avatar.png" alt=""></td>
                                                            <td>20 MAR 2021</td>
                                                            <td>$3034</td>
                                                            <td><span class="badge bg-warning">Processing</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2355</th>
                                                            <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry</td>
                                                            <td>Nina Stevens<img src="assets/portal-assets/images/avatars/avatar.png" alt=""></td>
                                                            <td>20 MAR 2021</td>
                                                            <td>$4337</td>
                                                            <td><span class="badge bg-success">Delivered</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row invoice-summary">
                                            <div class="col-lg-4">
                                                <div class="invoice-info">
                                                    <p>Invoice Number: <span>20191008-5689-87</span></p>
                                                    <p>Order ID: <span>870986</span></p>
                                                    <p>Issue Date: <span>October 8, 2019</span></p>
                                                    <p>Due Date: <span>December 8, 2019</span></p>
                                                    <div class="invoice-info-actions">
                                                        <a href="#" class="btn btn-info m-r-xs" type="button">Print Invoice</a>
                                                        <a href="#" class="btn btn-success m-l-xs" type="button">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5"></div>
                                            <div class="col-lg-3">
                                                <div class="invoice-info">
                                                    <p>Subtotal <span>$1700</span></p>
                                                    <p>Discount <span>$30</span></p>
                                                    <p>Tax <span>20%</span></p>
                                                    <p class="bold">Total <span>$1336</span></p>
                                                    <div class="invoice-info-actions">
                                                        <a href="#" class="btn btn-primary" type="button">Sign Invoice</a>
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
    </div>
    
    <!-- Javascripts -->
    <script src="<?= URL ?>assets/portal-assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/pace/pace.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>
</body>
</html>