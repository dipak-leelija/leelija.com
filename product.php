<!--
Author: Safikul Islam
Author URL: http://webtechhelp.org
-->
<?php 
session_start();
//include_once('checkSession.php');
require_once("_config/connect.php"); 
require_once("includes/constant.inc.php");
require_once("classes/date.class.php");  
require_once("classes/error.class.php"); 
require_once("classes/search.class.php");	
require_once("classes/customer.class.php"); 
require_once("classes/login.class.php"); 

require_once("classes/products.class.php"); 
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

$product		= new Products();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);
//$seo_url	= $utility->returnGetVar('seo_url','');
	
	if(isset($_GET['seo_url']))
		{
		 $seo_url			  		= $_GET['seo_url'];
		
		// $return_url 	= base64_decode($_GET["return_url"]); //get return url
		}
		
$productDtl		= $product->showProductSeoUrlWise($seo_url);	
$prodTypeDtls 	= $product->getProdTypeDetail($productDtl[0]);
$prodFeatured	= $product->ShowProdFtrdDtls($productDtl[26]);
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title><?php echo $productDtl[17]; ?> : <?php echo COMPANY_S; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Precedence Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script>
		addEventListener("load", function () {
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
	<!--//webfonts-->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<div id="home">
		<!-- header -->
		<?php include('header.incpro.php') ?>
		<!-- //header -->
		<!-- branches -->
		<section class="py-5 branches position-relative" id="explore">
			<div class="container py-md-5">
				<div class="branches">
					<div class="row py-lg-5 pt-sm-5">
						<div class="col-lg-6">
							<!-- team-img -->
							<div class="prod-dtls-sec">
								<div class="prod-dtls-img">
									<a href="">
										<img src="../../images/products/<?php echo $productDtl[8];?>" alt="<?php echo $productDtl[1];?>" class="img-fluid">
									</a>
								</div>	
								<div class="py-lg-5">
									<h3>About Product</h3>
									<p><?php echo $productDtl[7];?></p>
									<h3>Product Featured</h3>
									<?php
										foreach($prodFeatured as $eachRecord)
											{
									?>
										<p><i class="fa fa-check" aria-hidden="true"></i><?php echo $eachRecord['featured'];?></p>
									<?php
											}
									?>	
									<h3>Services:</h3>
									<p><i class="fa fa-angle-double-right"></i> <?php echo $productDtl[14];?></p>
									<div class="row">
										<div class="col-md-12">
											<div class="tab" role="tabpanel">
												<!-- Nav tabs -->
												<ul class="nav nav-tabs" role="tablist">
													<li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
													<li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Featured</a></li>
													<li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">More Information</a></li>
												</ul>
												<!-- Tab panes -->
												<div class="tab-content tabs">
													<div role="tabpanel" class="tab-pane fade in active" id="Section1">
														<h3>Description</h3>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius.</p>
													</div>
													<div role="tabpanel" class="tab-pane fade" id="Section2">
														<h3>Featured</h3>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius.</p>
													</div>
													<div role="tabpanel" class="tab-pane fade" id="Section3">
														<h3>More Information</h3>
														<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="pb-lg-5">
								<h2 class="stat-title text-center pb-lg-5"><?php echo $productDtl[17]; ?></h2>
								<h3>$<?php echo $productDtl[9];?></h3>
								<h3 class="sub-title"><i class="fa fa-angle-double-right"></i>Type: <?php echo $prodTypeDtls[0];?></h3>
								<h3 class="sub-title"><i class="fa fa-angle-double-right"></i>Platform: <?php echo $productDtl[3];?></h3>
								<h3 class="sub-title"><i class="fa fa-angle-double-right"></i>Language: <?php echo $productDtl[4];?></h3>
								<h3 class="sub-title"><i class="fa fa-angle-double-right"></i>Version: <?php echo $productDtl[5];?></h3>
								<h3 class="sub-title"><i class="fa fa-angle-double-right"></i>Services: <?php echo $productDtl[14];?></h3>
								<h3 class="sub-title"><i class="fa fa-angle-double-right"></i>Services Period: <?php echo $productDtl[12];?><?php echo $productDtl[13];?></h3>
							</div>
							<div class="buy-sec">
								<a href="#" class="buy-Btn">Buy Now</a>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- //branches -->
		<!-- contact top -->
		<div class="contact-top text-center">
			<div class="content-contact-top">
				<h3 class="stat-title text-white">for more information</h3>
				<a href="#contact" class="text-capitalize serv_link btn my-sm-5 my-3 scroll">stay in touch</a>
				<p class="text-white w-75 mx-auto">Donec mi nullDonec mi nulla, auctor nec sem a, ornare auctor mi. Sed mi tortor, commodo a felis in, fringilla tincidunt
					nulla. Vestibulum volutpat non eros ut vulpuuctor nec sem a, a auctor nec sem a ornare auctor mi.
				</p>
			</div>
		</div>
		<!-- //contact top -->
		
		<!-- Footer -->
		<?php include('footer.inc.php') ?>
		<!-- /Footer -->
	</div>
	<!-- js-->
	<script src="../../js/jquery-2.2.3.min.js"></script>
	<!-- js-->
	<!-- Scrolling Nav JavaScript -->
	<script src="../../js/scrolling-nav.js"></script>
	<!-- //fixed-scroll-nav-js -->
	<script>
		$(window).scroll(function () {
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
	</script>
	<!-- //Banner text  Responsiveslides -->
	<!-- start-smooth-scrolling -->
	<script src="../../js/move-top.js"></script>
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
	</script>
	<!-- //end-smooth-scrolling -->
	<!-- smooth-scrolling-of-move-up -->
	<script>
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
	</script>
	<script src="../../js/SmoothScroll.min.js"></script>
	<!-- //smooth-scrolling-of-move-up -->
	<!-- Bootstrap Core JavaScript -->
	<script src="../../js/bootstrap.js">
	</script>
	<!-- //Bootstrap Core JavaScript -->
</body>

</html>