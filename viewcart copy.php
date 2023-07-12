<?php
session_start();
//include_once('checkSession.php');
// require_once("_config/connect.php");
require_once "_config/dbconnect.php";
require_once "_config/dbconnect.trait.php";

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

//declare vars
$typeM			= $utility->returnGetVar('typeM','');
//$seo_url		= $utility->returnGetVar('seo_url','');

?>

<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>View Cart: <?php echo COMPANY_S; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Ready Website, Ready Blogs, Ready Websites Sales, Ready Blogs sales,
	Domain selling, Low Budget Websites, Good Metrics ready blogs sales, web design" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">

	<!-- Custom CSS -->
	
    <link rel="stylesheet" href="css/leelija.css">
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<!-- <link href="css/form.css" rel='stylesheet' type='text/css' /> -->
	<!-- <link href="css/custom.css" rel='stylesheet' type='text/css' /> -->
	<link href="css/shoppingcart.css" rel='stylesheet' type='text/css' />
	<!-- //Custom Theme files -->
	<!--webfonts-->
	<!-- <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet"> -->
	<!--//webfonts-->
	<link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
	<!-- <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet"> -->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<div id="home">
		<!-- header -->
		<?php require_once "partials/navbar.php"; ?>
		<!-- //header -->
		<!-- branches -->
		<!--<section class="py-5 branches position-relative" id="explore">-->
			<div class="container my-4">
				<div class="branches view_cart_page">
					<div class="row"><!--Start Row-->
						<div class="col-lg-12 table-responsive">
							<table id="cart" class="table table-hover table-condensed">
								<thead>
									<tr>
										<th style="width:20%"></th>
										<th style="width:20%">Domain</th>
										<th style="width:40%">Description</th>
										<th style="width:10%">Price</th>
										<th style="width:10%">Action</th>
									</tr>
								</thead>
							<?php
								if(isset($_SESSION["domain"]))
								{
							?>
							<form method="post">
							<?php
									$total = 0;
									$totalAmt = 0;
									//echo '<ol>';
								foreach ($_SESSION["domain"] as $cart_itm)
								{
									$domainDtl		= $domain->showDomains($cart_itm['code']);
									$subtotal 		= $cart_itm["qty"];
									$total 			= ($total + $subtotal);
									$nicheDtls	 	= $blogMst->showBlogNichMst($domainDtl[1]);
									foreach($nicheDtls as $rownicheDtls){
										$rownicheDtls[1];
									}
									//$Amt			= $domainDtl[8];
									// echo $domainDtl[8];exit;
									// if ($domainDtl[8] != NULL) {
										$totalAmt		= $totalAmt + $domainDtl[8];
									// }else{
									// 	$totalAmt = 0;
									// }

							?>

										<tbody>
											<tr>
												<td class="align-middle cart-prod-img">
													<img src="images/domains/<?php echo $domainDtl[10];?>" alt="<?php echo $domainDtl[0];?>" class="img-responsive">
												</td>
												<td class="align-middle text-capitalize">
													<h4 class="nomargin"><?php echo $domainDtl[0]; ?></h4>
												</td>
												<td class="align-middle" data-th="Product">
													<div class="row">
														<div class="col-sm-12">
															
															<div>
																<i class="fa fa-angle-double-right"></i>Url:<a rel="nofollow" href="<?php echo $domainDtl[9];?>" target="_blank"> <?php echo $domainDtl[9];?></a>
															</div>
															<div>
																<i class="fa fa-angle-double-right"></i>Niche: <?php echo $rownicheDtls[1];?>
															</div>
															<div>
																<i class="fa fa-angle-double-right"></i>DA: <?php echo $domainDtl[2];?>
															</div>
															<div>
																<i class="fa fa-angle-double-right"></i>PA:<?php echo $domainDtl[3];?>
															</div>
															<div>
																<i class="fa fa-angle-double-right"></i>Alexa: <?php echo $domainDtl[6];?>
															</div>
															<div>
																<i class="fa fa-angle-double-right"></i>Organic Traffic:<?php echo $domainDtl[7];?>
															</div>
														</div>
													</div>
												</td>
												<td class="font-weight-basic align-middle" data-th="Price">$<?php echo $domainDtl[8];?></td>

												<td class="actions align-middle" data-th="">
													<a href="removecart.php?removep=<?php echo $domainDtl[19];?>" class="btn btn-danger btn-sm">
														Remove
													</a>
												</td>
											</tr>
										</tbody>
								<?php
								}
								?>
							</form>
							<?php
								}
							?>
								<tfoot>
									<tr class="visible-xs">
										<td class="align-middle text-center"><strong>$
											<?php if (isset($_SESSION["domain"] )) {
													if ($totalAmt > 0) {
														echo $totalAmt; 
													}
													}else{
														echo "00";
													} 
											?>
										</strong></td>
									</tr>
									<tr>
										<td class="align-middle"><a href="domains.php" class="btn add-project add-project"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
										<td colspan="2" class="hidden-xs"></td>
										<td class="align-middle hidden-xs text-center"><strong>$
										<?php if (isset($_SESSION["domain"] )) {
													if ($totalAmt > 0) {
														echo $totalAmt; 
													}
													}else{
														echo "00";
													} 
											?>
										</strong></td>
										<td class="align-middle"><a href="checkout.php" class="btn add-project  btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div><!--end Row-->
				</div>
			</div>
		<!--</section>-->
		<!-- //branches -->

		<!-- contact top -->
		<!-- <div class="contact-top text-center">
			<div class="content-contact-top">
				<h3 class="stat-title text-white">for more information</h3>
				<a href="#contact" class="text-capitalize serv_link btn my-sm-5 my-3 scroll">stay in touch</a>
				<p class="text-white w-75 mx-auto">Donec mi nullDonec mi nulla, auctor nec sem a, ornare auctor mi. Sed mi tortor, commodo a felis in, fringilla tincidunt
					nulla. Vestibulum volutpat non eros ut vulpuuctor nec sem a, a auctor nec sem a ornare auctor mi.
				</p>
			</div>
		</div> -->
		<!-- //contact top -->

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
