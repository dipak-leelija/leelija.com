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

//Products Details

$prodDtl	= $product->ShowProdData();

	

$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);	

?>

<!DOCTYPE HTML>

<html lang="zxx">



<head>

	<title>Domain name with website or blogs ready for you | Domains :: w3layouts</title>

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

	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

	<!-- Custom CSS -->

	<link href="css/style.css" rel='stylesheet' type='text/css' />

	<link href="css/form.css" rel='stylesheet' type='text/css' />

	<link href="css/custom.css" rel='stylesheet' type='text/css' />

	<!-- font-awesome icons -->

	<link href="css/fontawesome-all.min.css" rel="stylesheet">

	<!-- //Custom Theme files -->

	<!--webfonts-->

	<link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

	<!--//webfonts-->

</head>



<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

	<div id="home">

		<!-- header -->

		<?php include('header.inc.php') ?>

		<!-- //header -->

		

		<!-- branches -->

		<section class="py-5 branches position-relative" id="explore">

			<div class="container py-md-5">

				<h2 class="stat-title text-center pb-lg-5">Your Domains and Blogs are Ready Different Niches Wise You Can Buy Any One</h2>

				<div class="branches">

					<div class="row ">

						<?php

						foreach($prodDtl as $eachRecord)

							{

							$prodTypeDtls 	=	$product->getProdTypeDetail($eachRecord['product_type_id']);

						?>

							<div class="col-lg-3">

								<!-- team-img -->

								<div class="prod-sec">

									<div class="prod-dtls">

										<div class="prod-img">

											<a href="">

												<img src="images/products/<?php echo $eachRecord['image'];?>" alt="<?php echo $eachRecord['product_name'];?>" class="img-fluid">

											</a>

											<div class="team-content">

											</div>

											<div class="overlay">

												<div class="text text-center">

													<p class="text-white">

														<?php echo $eachRecord['meta_description'];?>

													</p>

												</div>

											</div>

										</div>

										<div class="prod-content-sec">

											<h3><i class="fa fa-angle-double-right"></i><?php echo $prodTypeDtls[0];?></h3>

											<a href="product/<?php echo $eachRecord['seo_url'];?>"><h2 class="prodName-Sec"><?php echo $utility->word_teaser($eachRecord['product_name'],4);?></a>									

											</h2>

											<h3>$<?php echo $eachRecord['client_price'];?></h3>

											<p><i class="fa fa-check" aria-hidden="true"></i><?php echo $utility->word_teaser($eachRecord['meta_description'],10);?>...</p>

											<!--<a href="product.php?seo_url=<?php echo $eachRecord['seo_url'];?>">View Details</a>-->

											<a href="product/<?php echo $eachRecord['seo_url'];?>">View Details</a>

										</div>

									</div>

									<div class="buy-sec">

										

										<a href="#" class="buy-Btn">Buy Now</a>

									</div>

								</div>

							</div>

						<?php

							}

						?>		

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

	<script src="js/jquery-2.2.3.min.js"></script>

	<!-- js-->

	<!-- Scrolling Nav JavaScript -->

	<script src="js/scrolling-nav.js"></script>

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

	<script src="js/responsiveslides.min.js"></script>

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

	<script src="js/move-top.js"></script>

	<script src="js/easing.js"></script>

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

	<script src="js/SmoothScroll.min.js"></script>

	<!-- //smooth-scrolling-of-move-up -->

	<!-- Bootstrap Core JavaScript -->

	<script src="js/bootstrap.js">

	</script>

	<!-- //Bootstrap Core JavaScript -->

</body>



</html>