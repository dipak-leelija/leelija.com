<!--
Author: Safikul Islam
Author URL: https://webtechhelp.org
-->
<?php
session_start();
//include_once('checkSession.php');
// require_once("_config/dbconnect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
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
require_once("classes/portfolio.class.php");


/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$service		= new Services();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################

$portpolio = new Portfolio();

$showFewPort = $portpolio->showPortfolio();

$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);

if(isset($_GET['seo_url']))
	{
		 $seo_url			  		= $_GET['seo_url'];
		 $seo_url = str_replace('/', '', $seo_url);
		// $return_url 	= base64_decode($_GET["return_url"]); //get return url
	}
	// echo $seo_url.'<br>';
$serviceDtl		= $service->showServicesSeoUrlWise($seo_url);
foreach($serviceDtl as $rowserviceDtl){
	// $rowserviceDtl[0];
	// $rowserviceDtl[1];
	// $rowserviceDtl[2];
	// $rowserviceDtl[0];
	// $rowserviceDtl[0];
	// $rowserviceDtl[0];
	// $rowserviceDtl[0];

}
// echo implode('', $serviceDtl[0]);
// exit;
$servFeatDtls	= $service->ShowServcFrdDtls($rowserviceDtl[0]);
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
    <title><?php echo $rowserviceDtl[2];?> ::<?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $rowserviceDtl[8];?>">
    <meta charset="utf-8">
    <meta name="keywords" content="<?php echo $rowserviceDtl[7];?>" />
    <script>
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>

    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="../../css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../css/form.css" rel='stylesheet' type='text/css' />
    <link href="../../css/custom.css" rel='stylesheet' type='text/css' />
    <!-- font-awesome icons -->
    <link href="../../css/fontawesome-all.min.css" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">
    <!--//webfonts-->


</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!--  Home sec start -->
        <!-- header -->
        <?php include('header.incpro.php') ?>

        <div class="main_service_page pt-4">
            <!--  Main service page start -->
            <div class="service_page_banner text-center banner py-4">
                <h1 class="blue_color_class text-uppercase font-weight-bold"><?php echo $rowserviceDtl[2];?></h1>
                <h3 class="py-3 mons-font">Take a look to our services for you. </h3>
                <p>We are providing you the best quality <?php echo $rowserviceDtl[2];?> services.</p>
                <p> Our Expert Team always helps you bring your goal closer to you. </p>
            </div>
            <!--Banner Dividor-->

            <?php include ('quote.php') ?>
            <!--/End of baneer Dividor-->

            <div class="single_service_page">
                <!--  Single service page start -->
                <div class="second_service_section">
                    <h2>What is <?php echo $rowserviceDtl[2];?>?</h2>
                    <p>
                        <?php echo $rowserviceDtl[3];?>
                    </p>
                </div>

                <!-- <div class="third_service_section">
                    <h2>LeeLija Focus On:</h2>
                    <div class="container">
                        <div class="row">
                            <?php
						//foreach($servFeatDtls as $eachRecord)
							//{
					?>
                            <div class="col-md-6 align-middle">
                                <h3><i class="fas fa-check-square"></i><?php// echo $eachRecord['featued_name'];?></h3>
                            </div>
                            <?php
							//}
					?>

                        </div>
                    </div>
                </div> -->


                <div class="third_service_section">
                    <h2>LeeLija Focus On:</h2>
                    <div class="semicontainer">
                        <ul class="our_focused">
                            <?php
								foreach($servFeatDtls as $eachRecord){
							?>
                            <li>
                                <p><i class="far fa-check-circle"></i> <?php echo $eachRecord['featued_name'];?>
                                </p>
                            </li>
                            <?php
								}
							?>

                        </ul>
                    </div>
                </div>
                <!-- ===================================================== -->

				<!--  Service With Image page start -->
                <!-- <div class="services_with_img">

                    <?php
						// foreach($servFeatDtls as $eachRecord)
						// 	{
						// 		if($eachRecord['images'] != '' AND $eachRecord['position'] == 'right'){ 
					?>
                    <div class="row background_blue_color">
                        <div class="col-lg-6">
                            <div class="container-fluid">
                                <div class="service_small_box">
                                    <h3><?php// echo $eachRecord['featued_name'];?></h3>
                                    <p>
                                        <?php //echo $eachRecord['desc'] ;?>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 service_single_big_img pl-0">
                            <img src="../../images/services/<?php //echo $eachRecord['images'];?>"
                                alt="<?php// echo $eachRecord['featued_name'];?>">
                        </div>
                    </div>
                    <?php
							
								//} elseif($eachRecord['images'] != '' AND $eachRecord['position'] == 'left'){
									
					?>

                    <div class="row align-items-center">
                        <div class="col-lg-6 pl-0">
                            <img src="../../images/services/<?php// echo $eachRecord['images'];?>"
                                alt="<?php// echo $eachRecord['featued_name'];?>">
                        </div>
                        <div class="col-lg-6">
                            <div class="container-fluid">
                                <div class="service_small_box">
                                    <h3><?php// echo $eachRecord['featued_name'];?></h3>
                                    <p>
                                        <?php// echo $eachRecord['desc'];?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php	
								//}else{
									
					?>

                    <div class="second_service_section ">
                        <h2><?php //echo $eachRecord['featued_name'];?></h2>
                        <p>
                            <?php //echo $eachRecord['desc'];?>
                        </p>
                    </div>

                    <?php	
							// 	}
							// }
							
					?>
                </div> -->
                <!--  Service With Image page end //-->
                <!-- ===================================================== -->


                <div class="container-fluid">
                <div class="services_with_img">
                    <!--  Service With Image page start -->

                    <?php
						foreach($servFeatDtls as $eachRecord){
							if($eachRecord['images'] != '' AND $eachRecord['position'] == 'right'){
						?>
                    <div class="we-reached-target">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="container-fluid">
                                    <div class="service_small_box">
                                        <h3><?php echo $eachRecord['featued_name'];?></h3>
                                        <p>
                                            <?php echo $eachRecord['desc'] ;?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 service_single_big_img pl-0">
                                <img src="../../images/services/<?php echo $eachRecord['images'];?>"
                                    alt="<?php echo $eachRecord['featued_name'];?>">
                            </div>
                        </div>
                    </div>

                    <?php

						} elseif($eachRecord['images'] != '' AND $eachRecord['position'] == 'left'){

					?>

                    <div class="row align-items-center">
                        <div class="col-lg-6 pl-0">
                            <img src="../../images/services/<?php echo $eachRecord['images'];?>"
                                alt="<?php echo $eachRecord['featued_name'];?>">
                        </div>
                        <div class="col-lg-6">
                            <div class="container-fluid">
                                <div class="service_small_box">
                                    <h3><?php echo $eachRecord['featued_name'];?></h3>
                                    <p>
                                        <?php echo $eachRecord['desc'];?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
}else{

?>

                    <div class="second_service_section ">
                        <h2><?php echo $eachRecord['featued_name'];?></h2>
                        <p>
                            <?php echo $eachRecord['desc'];?>
                        </p>
                    </div>

                    <?php
}
}
?>

                </div>
            </div>


            <!-- ========================================================= -->
            <!--  Portfollio Start -->
            <div class="port-few">
                <div class="container">
                    <div class="second_service_section" style="max-width:initial">
                        <h2>Portfolio</h2>

                        <div class="row start-ups-blog common-port-cls">
                            <?php foreach ($showFewPort as $portValue) { ?>
                            <div class="col-sm-3 all-port-single text-center">
                                <div class="single-portfolio">
                                    <a href="<?php echo $portValue['url'];?>">
                                        <img class="portfolio-img port-img"
                                            src="https://www.leelija.com/images/portfolio/<?php echo $portValue['image'];?>"
                                            alt="">
                                        <div class="portfolio-single-detls">
                                    </a>
                                    <h3><a href="<?php echo $portValue['url'];?>">
                                            <?php echo $portValue['name']; ?></a></h3>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="more-port">
                        <a href="https://www.leelija.com/portfolio.php" class="more-post-btn">More Portfolio</a>
                    </div>
                </div>
            </div>
            <!--//end  Portfollio -->

            <div class="mt-4">
                <?php include('seller-action.inc.php') ?>
            </div>

        </div><!--  Single service page end //-->

    </div><!--  Main service page end //-->

    <?php include('footer.inc.pro.php') ?>
    <!-- /Footer -->

    </div><!--  Home sec end // -->
    <!-- js-->
    <script src="../../js/jquery-2.2.3.min.js"></script>
    <!-- js-->
    <!-- Scrolling Nav JavaScript -->
    <script src="../../js/scrolling-nav.js"></script>
    <!-- //fixed-scroll-nav-js -->
    <script>
    $(window).scroll(function() {
        if ($(document).scrollTop() > 70) {
            $('nav.pagescrollfix,nav.RWDpagescrollfix').addClass('shrink');
        } else {
            $('nav.pagescrollfix,nav.RWDpagescrollfix').removeClass('shrink');
        }
    });
    </script>
    <!-- Banner text Responsiveslides -->
    <script src="../../js/responsiveslides.min.js"></script>
    <script>
    // You can also use"$(window).load(function() {"
    $(function() {
        // Slideshow 4
        $("#slider3").responsiveSlides({
            auto: true,
            pager: true,
            nav: false,
            speed: 500,
            namespace: "callbacks",
            before: function() {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function() {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });
    </script>
    <!-- //Banner text  Responsiveslides -->
    <!-- start-smooth-scrolling -->
    <script src="../../js/move-top.js"></script>
    <script src="../../js/easing.js"></script>
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
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script>
    $(document).ready(function() {
        /*
         var defaults = {
           containerID: 'toTop', // fading element id
           containerHoverID: 'toTopHover', // fading element hover id
           scrollSpeed: 1200,
           easingType: 'linear'
         };
         */

        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
    </script>
    <script src="../../js/SmoothScroll.min.js"></script>
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.js">
    </script>
    <!-- //Bootstrap Core JavaScript -->
</body>

</html>