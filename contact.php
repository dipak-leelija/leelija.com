<!--
Author: Safikul Islam
Author URL: https://webtechhelp.org
-->
<?php


session_start();
//include_once('checkSession.php');
// require_once("_config/connect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");

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
//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);


?>
<?php
if(isset($_POST['emailSubmit']))
{
	//post vars
	$txtEmail 				= $_POST['txtEmail'];
	$_SESSION['txtEmail']	= $txtEmail;
	//echo $txtEmail; exit;
}


// 
// define('WP_USE_THEMES', false);
// require('blog/wp-load.php');
// query_posts('showposts=3');

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<?php include('head-section.php');?>
	<title>LeeLija Global Support | Contact Us - LeeLija</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="LeeLija staff always available for your support. Our technical and SEO staffs always online, Leelija team provided free support for every one." />
	<meta charset="utf-8">
	<meta name="keywords" content="contact for SEO, contact for web development, support for on page SEO, support for technical SEO, contact for guest post" />
	<link href="css/contact.css" rel='stylesheet' type='text/css' />
	
</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<div id="home">
		<!-- header -->
		<?php require_once "partials/navbar.php"; ?>
		<!-- //header -->

		<!-- contact -->
		<?php require_once "contact-section.php"; ?>
		<!-- //contact -->

		<!-- Seller Action section -->

		<!-- //Seller Action section -->

		<!-- Footer -->
		<?php require_once "partials/footer.php"; ?>

		<!-- /Footer -->
	</div>
	<!-- js-->
	<!-- <script src="js/jquery-2.2.3.min.js"></script> -->
	<script src="plugins/jquery-3.6.0.min.js"></script>
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
	<!-- <script src="js/responsiveslides.min.js"></script> -->
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
	<!-- <script src="js/move-top.js"></script> -->
	<!-- <script src="js/easing.js"></script> -->
	<!-- <script>
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
	<!-- <script src="js/SmoothScroll.min.js"></script> -->
	<!-- //smooth-scrolling-of-move-up -->
	<!-- Bootstrap Core JavaScript -->
	<!-- <script src="js/bootstrap.js"></script> -->
	<script src="plugins/jquery-3.6.0.min.js"></script>
	<script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
	<script src="plugins/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
	<script>
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>

	 <!-- ==== js for smooth scrollbar ==== -->
	 <!-- <script src="plugins/smooth-scrollbar.js"></script>
    <script>
        var Scrollbar = window.Scrollbar;
        Scrollbar.init(document.querySelector('body'));
    </script> -->
    <!-- ==== js for smooth scrollbar End ==== -->
	<!-- //Bootstrap Core JavaScript -->
</body>

</html>
