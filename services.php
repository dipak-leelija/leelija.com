<?php
session_start();
require_once("includes/constant.inc.php");
require_once("_config/dbconnect.php");

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

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$services		= new Services();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);

$sercat		= $services->ShowServicesCatData();
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
    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">
    <!-- Custom CSS -->
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="css/services.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!-- <link href="css/form.css" rel='stylesheet' type='text/css' /> -->
    <!-- <link href="css/custom.css" rel='stylesheet' type='text/css' /> -->
    <!-- font-awesome icons -->
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!--webfonts-->
    <!-- <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

	<link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet"> -->
    <!--//webfonts-->

    <title><?php echo COMPANY_S; ?>: Best Web Development, Web Design and SEO Services</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="LeeLija provide web design, blogs making, SEO Services, blogs post, local online marketing, blogs design, Guest post services that you have been looking for.">
    <meta charset="utf-8">
    <meta name="keywords" content="Web Design, Web Development, Apps Development, SEO Services, Guest Post Services, Domain name, online marketing, digital marketing, brand promoting,
website for small business, blogs making, blogs sales, expired domain sales" />

    <script>
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require "partials/navbar.php"; ?>


        <div class="new_section service_page_banner1 text-center banner py-4">
            <div>
                <h1 class="text-uppercase fs_heading fw_800" style="color:white;">our services</h1>
                <h3 class="py-3 mons-font fw-semibold">Take a look to our services for you. </h3>
                <p class="srvc_p">We are providing you the best quality online and Business Development services.</p>
                <p> Our Expert Team always helps you bring your goal closer to you. </p>
            </div>

        </div>

        <!--Banner Dividor-->
        <?php //include ('quote.php') ?>
        <!--/End of baneer Dividor-->

        <div class="new_section py-4">
            <div class="container">
                <h1 class="text-center text-capitalize py-2 mb-2 fs_heading fw-bolder">Choose <span
                        class="pinkish-red-color"> best service</span> for your <span class="pinkish-red-color">
                        business</span></h1>
                <?php
						foreach($sercat as $eachRecord)
							{
								$serdtls		= $services->ShowSercsCatWise($eachRecord['id']);
					?>
                <h2 class="text-center text-uppercase fs_sub_heading fw-semibold mt-5 py-3 h-100">Services for <span
                        class="pinkish-red-color"><?php echo $eachRecord['cat_name'];?></span></h2>
                <div class="service_page_section_dividor"></div>
                <div class="row rows3 px-0">
                    <?php 
								foreach($serdtls as $eachRow)
									{
									$serFeatrddtls		= $services->ShowServcFrdDtls($eachRow['id']);
							?>
                    <div class="col-xl-4 col-lg-4 col-md-6 h-100 ">
                        <div class="services_card">
                            <div class="text-center">
                                <img src="images/services/<?php echo $eachRow['image'];?>" height="80" width='80'
                                    alt="">
                            </div>
                            <h3 class="h-100"><?php echo $eachRow['service_name'];?></h3>
                            <div class="service_devider"></div>
                            <p class=""><?php echo substr($eachRow['service_desc'],0,99);?>...</p>
                            <div class="service_page_section_dividor"></div>
                            <ul class="service_ul my-4 h-100">
                                <?php 
															foreach($serFeatrddtls as $eachRowFRd)
															{
														?>
                                <li><i class="fas fa-check-square"></i><?php echo $eachRowFRd['featued_name'];?></li>
                                <?php
															}
														?>
                            </ul>
                            <a href="<?php echo $eachRow['seo_url'];?>" class="btn read_more_service_btn"
                                role="button">Read More <i class="fas pl-1 fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                    <?php
								}//end loop for services
							?>
                </div><!-- //row end-->
                <?php
									
						}// end loop for service cat
					?>

            </div><!-- //container end-->
        </div><!-- //service page body end-->

        <div class="mt-4">
            <?php include('seller-action.php') ?>
        </div>


        <?php require_once "partials/footer.php"; ?>
        <!-- /Footer -->

    </div>
    <!-- //home end-->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
    <!-- ==== js for smooth scrollbar ==== -->
    <!-- <script src="plugins/smooth-scrollbar.js"></script> -->
    <!-- <script>
        var Scrollbar = window.Scrollbar;
        Scrollbar.init(document.querySelector('body'));
    </script> -->
    <!-- ==== js for smooth scrollbar End ==== -->
</body>
<!--// end body -->

</html>