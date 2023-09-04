<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";
require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/date.class.php";
require_once ROOT_DIR."classes/error.class.php";
require_once ROOT_DIR."classes/search.class.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/login.class.php";

//require_once("../classes/front_photo.class.php");
require_once ROOT_DIR."classes/niche.class.php";
require_once ROOT_DIR."classes/domain.class.php";
require_once ROOT_DIR."classes/utility.class.php";
require_once ROOT_DIR."classes/utilityMesg.class.php";
require_once ROOT_DIR."classes/utilityImage.class.php";
require_once ROOT_DIR."classes/utilityNum.class.php";

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();

//$ff				= new FrontPhoto();
$Niche		    = new Niche();
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);
if($cusId == 0)
	{
		header("Location: index.php");
	}
$domainDtls		= $domain->ShowUserDomainData($cusDtl[0][2]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= URL ?>css/style.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/font-awesome/free/css/all.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= URL ?>assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= URL ?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- NAVBAR -->
        <?php require_once ROOT_DIR."components/navbar.php"; ?>
        <!-- NAVBAR END -->
        <div class="container-fluid page-body-wrapper">
            <!-- SETTING PANEL -->
            <?php require_once ROOT_DIR."components/settings-panel.php"; ?>
            <!-- SETTING PANEL END-->
            <!-- SIDEBAR -->
            <?php require_once ROOT_DIR."components/sidebar.php"; ?>
            <!-- SIDEBAR END -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="my_domain_section">
                        <!--<section class="py-5 branches position-relative" id="explore">-->
                            <div class="card">
                        <div class="row justify-content-center">
                            <?php
					if ($domainDtls != NULL) {
						foreach($domainDtls as $eachRecord)
							{
								$nicheDtls	 	= $Niche->showBlogNichMst($eachRecord['niche']);
						?>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="card indivisual_blogs my-3" style="border: none;">
                                    <!-- team-img -->
                                    <div class="prod-sec">
                                        <div class="prod-dtls">
                                            <div class="prod-img">
                                                <a href="">
                                                    <img src="<?= URL?>images/domains/<?php echo $eachRecord['dimage'];?>"
                                                        alt="<?php echo $eachRecord['domain'];?>" class="img-fluid">
                                                </a>
                                                <div class="team-content">
                                                </div>
                                                <div class="overlay">
                                                    <div class="text text-center">
                                                        <p class="text-white">
                                                            <?php echo $eachRecord['domain'];?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="prod-content-sec text-left">
                                                <h3><i
                                                        class="fa fa-angle-double-right"></i><?php echo $nicheDtls[0][1];?>
                                                </h3>
                                                <a href="domain/<?php echo $eachRecord['seo_url'];?>">
                                                    <h2 class="prodName-Sec"><?php echo $eachRecord['durl'];?></h2>
                                                </a>
                                                <p><i class="fas fa-long-arrow-alt-right"></i>
                                                    Domain Authority:<span
                                                        class="float-right"><?php echo $eachRecord['da'];?></span>
                                                </p>
                                                <p><i class="fas fa-long-arrow-alt-right"></i>
                                                    Page Authority: <span
                                                        class="float-right"><?php echo $eachRecord['pa'];?></span>
                                                </p>
                                                <p><i class="fas fa-long-arrow-alt-right"></i>
                                                    Alexa Traffic:<span
                                                        class="float-right"><?php echo $eachRecord['alexa_traffic'];?>
                                                    </span>
                                                </p>
                                                <p><i class="fas fa-long-arrow-alt-right"></i>
                                                    Organic Traffic:<span class="float-right">
                                                        <?php echo $eachRecord['organic_traffic'];?></span>
                                                </p>
                                                <h3><i class="fas fa-long-arrow-alt-right"></i> Price <span
                                                        class="float-right">$<?php echo $eachRecord['price'];?></span>
                                                </h3>
                                                <p>
                                                    <?php
													$domFeatures 	= $domain->ShowDfeattwo($eachRecord['id']);
													foreach($domFeatures as $eachRec)
														{
												?>
                                                    <i class="fas fa-long-arrow-alt-right"></i>
                                                    <?php echo $utility->word_teaser($eachRec['featured'],4);?><br>
                                                    <?php
													}
												?>
                                                    ...
                                                </p>
                                                <!--<a href="product.php?seo_url=<?php echo $eachRecord['seo_url'];?>">View Details</a>-->
                                                <div class="d-block py-2">
                                                    <a href="domain/<?php echo $eachRecord['seo_url'];?>"
                                                        class="btn  view_details" role="button">View Details</a>
                                                    <a href="#" class="btn edit_details float-right">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
							}
						}
						?>
                            </div>
                     
                        </div>
                        <!-- end Row-->

                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="<?= URL ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= URL ?>assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= URL ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= URL ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= URL ?>assets/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= URL ?>assets/js/off-canvas.js"></script>
    <script src="<?= URL ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= URL ?>assets/js/template.js"></script>
    <script src="<?= URL ?>assets/js/settings.js"></script>
    <script src="<?= URL ?>assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= URL ?>assets/js/dashboard.js"></script>
    <script src="<?= URL ?>assets/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>