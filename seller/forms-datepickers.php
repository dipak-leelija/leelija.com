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
    <link href="<?= URL ?>assets/portal-assets/plugins/flatpickr/flatpickr.min.css" rel="stylesheet">

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
                                <div class="page-description">
                                    <h1>Datepickers</h1>
                                    <span>flatpickr is a lightweight and powerful datetime picker.</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Basic</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="example-container">
                                            <div class="example-content">
                                                <input class="form-control flatpickr1" type="text" placeholder="Select Date..">
                                            </div>
                                            <div class="example-code">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="html-tab" data-bs-toggle="tab" data-bs-target="#htmlCode" type="button" role="tab" aria-controls="htmlCode" aria-selected="true">HTML</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="js-tab" data-bs-toggle="tab" data-bs-target="#jsCode" type="button" role="tab" aria-controls="jsCode" aria-selected="false">JS</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="htmlCode" role="tabpanel" aria-labelledby="html-tab">
                                                        <pre><code class="html">&lt;input class=&quot;form-control flatpickr1&quot; type=&quot;text&quot; placeholder=&quot;Select Date..&quot;&gt;</code></pre>
                                                    </div>
                                                    <div class="tab-pane fade" id="jsCode" role="tabpanel" aria-labelledby="js-tab">
                                                        <pre><code class="js">$(".flatpickr1").flatpickr();</code></pre>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">DateTime</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="example-container">
                                            <div class="example-content">
                                                <input class="form-control flatpickr2" type="text" placeholder="Select Date..">
                                            </div>
                                            <div class="example-code">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="html-tab4" data-bs-toggle="tab" data-bs-target="#htmlCode4" type="button" role="tab" aria-controls="htmlCode4" aria-selected="true">HTML</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="js-tab4" data-bs-toggle="tab" data-bs-target="#jsCode4" type="button" role="tab" aria-controls="jsCode4" aria-selected="false">JS</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="htmlCode4" role="tabpanel" aria-labelledby="html-tab4">
                                                        <pre><code class="html">&lt;input class=&quot;form-control flatpickr2&quot; type=&quot;text&quot; placeholder=&quot;Select Date..&quot;&gt;</code></pre>
                                                        </div>
                                                    <div class="tab-pane fade" id="jsCode4" role="tabpanel" aria-labelledby="js-tab4">
                                                        <pre><code class="js">$(".flatpickr2").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});</code></pre>
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
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/pace/pace.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/highlight/highlight.pack.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/flatpickr/flatpickr.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/pages/datepickers.js"></script>
</body>

</html>