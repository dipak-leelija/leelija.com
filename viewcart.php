<?php
session_start();
//include_once('checkSession.php');
// require_once("_config/connect.php");
require_once "_config/dbconnect.php";

require_once("includes/constant.inc.php");
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");

require_once("classes/products.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/domain.class.php");
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

$product		= new Products();
$blogMst		= new BlogMst();
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################

$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);


//declare vars
$typeM			= $utility->returnGetVar('typeM','');
//$seo_url		= $utility->returnGetVar('seo_url','');

$_SESSION['reorder-page'] = $utility->currentUrl();

?>

<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Cart: <?php echo COMPANY_S; ?></title>
    <link rel="icon" href="<?php echo FAVCON_PATH; ?>" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo FAVCON_PATH; ?>" />
    
    <meta name="keywords" content="Ready Website, Ready Blogs, Ready Websites Sales, Ready Blogs sales,
	Domain selling, Low Budget Websites, Good Metrics ready blogs sales, web design" />

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">

    <!-- Custom CSS -->

    <link rel="stylesheet" href="css/leelija.css">
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/shoppingcart.css" rel='stylesheet' type='text/css' />

    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- //header -->
        <div class="container my-4">
		<form method="post">

            <div class="row justify-content-evenly p-3 p-sm-0">

                <?php
				if(isset($_SESSION["domain"]))
					{
				?>
                    <?php
						$total = 0;
						$totalAmt = 0;
						//echo '<ol>';
						foreach ($_SESSION["domain"] as $cart_itm){
							$domainDtl		= $domain->showDomainsById($cart_itm['code']);
							$subtotal 		= $cart_itm["qty"];
							$total 			= ($total + $subtotal);
							$nicheDtls	 	= $blogMst->showBlogNichMst($domainDtl[1]);
							foreach($nicheDtls as $rownicheDtls){
								$rownicheDtls[1];
						    }
							
						$totalAmt		= $totalAmt + $domainDtl[8];
									
					?>

                    <div class="product_card col-lg-5 row border rounded shadow py-2 mb-3">
                        <div class="col-4 d-flex text-center aling-middle">
                            <img src="images/domains/<?php echo $domainDtl[10];?>" alt="<?php echo $domainDtl[0];?>">
                        </div>
                        <div class="card ccolcd col-8 col-md-8" style="border: none;">
                            <h3 class="product-title text-capitalize"><?php echo $domainDtl[0]; ?></h3>
                            <div>
                                <span><i class="fa fa-angle-double-right"></i>Url:
                                    <a rel="nofollow" href="<?php echo $domainDtl[9];?>" target="_blank">
                                        <?php echo $domainDtl[9];?></a></span>
                                <br>
                                <span><i class="fa fa-angle-double-right"></i>Niche:
                                    <?php echo $rownicheDtls[1];?></span>
                                <br>

                                <span><i class="fa fa-angle-double-right"></i>DA: <?php echo $domainDtl[2];?></span>
                                <span><i class="fa fa-angle-double-right"></i>PA: <?php echo $domainDtl[3];?></span>
                                <br>

                                <span><i class="fa fa-angle-double-right"></i>Alexa: <?php echo $domainDtl[6];?></span>
                                <span><i class="fa fa-angle-double-right"></i>Organic Traffic:
                                    <?php echo $domainDtl[7];?></span>

                            </div>
                            <div class="row rw_twobtn justify-content-between py-2">
                                <div class="col-12 col-sm-6 text-end">
                                    <p class="fs-5 fw-bolder">$<span><?php echo $domainDtl[8];?></span></p>
                                </div>
                                <div class="col-12 col-sm-6 text-end pt-2">
                                    <a href="removecart.php?removep=<?php echo $domainDtl[19];?>"
                                        class="btn btn-danger btn-sm">Remove</a>
                                </div>


                            </div>
                        </div>
                    </div>



                    <?php
								}
								}
							?>
                <div class="border  rounded p-2 ">
					<h4 class="text-end">$<?php if (isset($_SESSION["domain"] )) {
													if ($totalAmt > 0) {
														echo $totalAmt; 
													}
													}else{
														echo "00";
													} 
											?></h4>
                    <div class="finalslect d-flex justify-content-between">
                        <a href="domains.php" class="btn btn-info btn-block continue_atag"><i class="fa fa-angle-left"></i>Continue
                            Shopping</a>
                        <a href="checkout.php" class="btn btn-primary btn-block continue_atag">Checkout <i
                                class="fa fa-angle-right"></i></a>
                    </div>
                </div>

            </div>
			</form>


        </div>

        <!-- Footer -->
        <?php require_once 'partials/footer.php'; ?>
        <!-- /Footer -->
    </div>
    <!-- js-->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- js-->
    <script src="js/cart.js"></script>
    <!-- js-->
    <!-- Scrolling Nav JavaScript -->
    <!-- <script src="js/scrolling-nav.js"></script> -->
    <!-- //fixed-scroll-nav-js -->
    <!-- <script>
		$(window).scroll(function () {
			if ($(document).scrollTop() > 70) {
				$('nav.pagescrollfix,nav.RWDpagescrollfix').addClass('shrink');
			} else {
				$('nav.pagescrollfix,nav.RWDpagescrollfix').removeClass('shrink');
			}
		});
	</script> -->
    <!-- Banner text Responsiveslides -->
    <!-- <script src="../../js/responsiveslides.min.js"></script> -->
    <!-- <script>
		// You can also use"$(window).load(function() {"
		$(function () {
			// Slideshow 4
			$("#slider3").responsiveSlides({
				auto: true,
				pager: true,
				nav: false,
				speed: 500,
				namespace: "callbacks",
				before: function () {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
					$('.events').append("<li>after event fired.</li>");
				}
			});

		});
	</script> -->
    <!-- //Banner text  Responsiveslides -->
    <!-- start-smooth-scrolling -->
    <!-- <script src="../../js/move-top.js"></script>
	<script src="../../js/easing.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();

				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script> -->
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <!-- <script>
		$(document).ready(function () {
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
	</script> -->
    <!-- <script src="../../js/SmoothScroll.min.js"></script> -->
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="../../js/bootstrap.js"></script> -->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>

    <!-- ==== js for smooth scrollbar ==== -->
    <script src="plugins/smooth-scrollbar.js"></script>
    <script>
    var Scrollbar = window.Scrollbar;
    Scrollbar.init(document.querySelector('body'));
    </script>
    <!-- ==== js for smooth scrollbar End ==== -->
    <!-- //Bootstrap Core JavaScript -->
</body>

</html>