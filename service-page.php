<!--
Author: Safikul Islam
Author URL: https://webtechhelp.org
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
/*
define('WP_USE_THEMES', false);
require('blog/wp-load.php');
query_posts('showposts=3');
*/
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<?php include('head-section.php');?>
	<title>Domain name with website or blogs ready for you | Domains :: LeeLija</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="LeeLija is a new web-based trust worthy platform that brought visibility and clarity to remote work. At LeeLija we provide a global e-store where practically anyone can buy products offered by us  to earn the valuable opportunity in this competitive market.">
	<meta charset="utf-8">
	<meta name="keywords" content="Web Design, Web Development, Apps Development, SEO Services, Guest Post Services, Domain name with Ready Website,
Ready website for business, High Quality website sales, High quality blogs sales, expired domain sales" />

</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<div id="home">
		<!-- header -->
		<?php include('header.inc.php') ?>

<div class="main_service_page pt-4">
  <div class="service_page_banner text-center banner py-4">
  <h1 class="blue_color_class text-uppercase font-weight-bold">Single Service Page</h1>
  <h3 class="py-3 mons-font">Take a look to our services for you. </h3>
  <p>We are providing you the best quality online and Business Development services.</p><p> Our Expert Team always helps you bring your goal closer to you. </p>
  </div>
  <!--Banner Dividor-->

<?php include ('quote.php') ?>
  <!--/End of baneer Dividor-->
<div class="single_service_page">
<div class="second_service_section">
  <h2>What is Lorem Ipsum?</h2>
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
</div>

<div class="third_service_section">
  <h2>What is Lorem Ipsum?</h2>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        </p>
      </div>
      <div class="col-md-6">
        <p> It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.
        </p>
      </div>
    </div>
  </div>
</div>

<div class="services_with_img">

	<div class="row">
		<div class="col-lg-6">
			<div class="container-fluid">
				<div class="service_small_box">
					<h3>What is Lorem Ipsum?</h3>
					<p>
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
					</p>
				</div>
			</div>

		</div>
		<div class="col-lg-6 service_single_big_img pl-0">
			<img src="images/service_page_side_1.jpeg" alt="">
		</div>
	</div>

<div class="row">
	<div class="col-md-6  background_blue_color">
		<div class="container-fluid">
		<div class="service_small_box">
		<h3>What is Lorem Ipsum?</h3>
		<p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
			</p>
		</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="container-fluid">
		<div class="service_small_box">
		<h3>What is Lorem Ipsum?</h3>
		<p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
			</p>
		</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="container-fluid">
		<div class="service_small_box">
		<h3>What is Lorem Ipsum?</h3>
		<p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
			</p>
		</div>
		</div>
	</div>
	<div class="col-md-6  background_blue_color">
		<div class="container-fluid">
		<div class="service_small_box">
		<h3>What is Lorem Ipsum?</h3>
		<p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
			</p>
		</div>
		</div>
	</div>
</div>
<div class="row align-items-center">
	<div class="col-lg-6 pl-0">
		<img src="images/service_page_side_1.jpeg" alt="">
	</div>
	<div class="col-lg-6">
		<div class="container-fluid">
		<div class="service_small_box">
		<h3>What is Lorem Ipsum?</h3>
		<p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
			</p>
		</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-6">
		<div class="container-fluid">
		<div class="service_small_box">
		<h3>What is Lorem Ipsum?</h3>
		<p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
			</p>
		</div>
		</div>
	</div>
	<div class="col-md-6  background_blue_color">
		<div class="container-fluid">
		<div class="service_small_box">
		<h3>What is Lorem Ipsum?</h3>
		<p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
			</p>
		</div>
		</div>
	</div>
</div>
<div class="row align-items-center">
	<div class="col-lg-6 pl-0">
		<img src="images/service_page_side_1.jpeg" alt="">
	</div>
	<div class="col-lg-6">
		<div class="container-fluid">
		<div class="service_small_box">
		<h3>What is Lorem Ipsum?</h3>
		<p>
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
			</p>
		</div>
	</div>
	</div>
</div>
</div>
<div class="mt-4">
	<?php include('seller-action.php') ?>
</div>

</div>

</div>
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
