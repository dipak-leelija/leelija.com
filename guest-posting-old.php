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
	<title>Guest Post, Guest Posting,Guest Post Service :<?php echo COMPANY_S; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="LeeLija provided Guest Post Service at reasonable prices on fashion blogs, beauty blogs, health blogs, travel blogs, fitness blogs, tech blogs, home improvement  or more.">
	<meta charset="utf-8">
	<meta name="keywords" content="Guest Post, Guest Posting,Guest Post Service, blogger outreach, guest posting services, guest posting blogs, fashion blogs, beauty blogs, health blogs, travel blogs, fitness blogs, tech blogs, home improvement blogs, CBD blogs, Casino Blogs" />
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

	<link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">
	<!--//webfonts-->

</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<div id="home">
		<!-- header -->
		<?php include('header.inc.php') ?>

<div class="guest_pricing">
  <div class="pricing-page_banner text-center banner py-4">
    <h1 class="blue_color_class text-uppercase font-weight-bold">choose best guest post plan</h1>
    <h3 class="py-3 mons-font">Take a look to our guest posting services for you. </h3>
    <p>We are providing you the best quality guest posting services for your Business.</p><p> Our Expert Team always helps you bring your goal closer to you. <b class="font-weight-bold">We have 8000+ different niches blogs.</b> </p>
  </div>
  <?php //include ('quote.php') ?>
<div class="container">
  <div class="guest_pricing_table my-4">
    <div class="row">
      <div class="col-lg-4">
        <div class="single_guest_pricing_table ">
          <div class="single_guest_pricing_head">
            <h3>Silver</h3>
            <p>Startup placement</p>
            <h4 class="service_price">$250</h4>
          </div>
          <div class="single_guest_pricing_body">
            <ul>
              <li><span class="guest_post_indivisual">10 Guest Posts</span></li>
              <li><span class="guest_post_indivisual">Domain Authority 20+</span></li>
              <li><span class="guest_post_indivisual">Trust Flow 10+</span></li>
              <li><span class="guest_post_indivisual">Citation  Flow 10+</span></li>
              <li><span class="guest_post_indivisual">10 quality Contents</span></li>
              <li><span class="guest_post_indivisual">600+ Words Contents</span></li>
              <li><span class="guest_post_indivisual">2 links per Contents</span></li>
			  <li><span class="guest_post_indivisual">Dofollow Links</span></li>
			  <li><span class="guest_post_indivisual">Low Spam Score</span></li>
			  <li><span class="guest_post_indivisual">Permanent Links</span></li>
			  <li><span class="guest_post_indivisual">SEO Friendly Content</span></li>
			  <li><span class="guest_post_indivisual">Get Quality Traffic</span></li>
            </ul>
          </div>
          <div class="single_guest_pricing_footer">
             <a href="contact.php" class="btn btn-explore-banner">Contact now <i class="fas pl-1 fa-long-arrow-alt-right"></i> </a>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="single_guest_pricing_table">
          <div class="single_guest_pricing_head">
            <h3>Gold</h3>
            <p>Business Placement</p>
            <h4 class="service_price">$400</h4>
          </div>
          <div class="single_guest_pricing_body">
            <ul>
              <li><span class="guest_post_indivisual">10 Guest Posts</span></li>
              <li><span class="guest_post_indivisual">Domain Authority 30+</span></li>
              <li><span class="guest_post_indivisual">Trust Flow 10+</span></li>
              <li><span class="guest_post_indivisual">Citation  Flow 20+</span></li>
              <li><span class="guest_post_indivisual">10 quality Contents</span></li>
              <li><span class="guest_post_indivisual">600+ Words Contents</span></li>
              <li><span class="guest_post_indivisual">2 links per Contents</span></li>
			  <li><span class="guest_post_indivisual">Dofollow Links</span></li>
			  <li><span class="guest_post_indivisual">Low Spam Score</span></li>
			  <li><span class="guest_post_indivisual">Permanent Links</span></li>
			  <li><span class="guest_post_indivisual">SEO Friendly Content</span></li>
			  <li><span class="guest_post_indivisual">Get Quality Traffic</span></li>
            </ul>
          </div>
          <div class="single_guest_pricing_footer">
             <a href="contact.php" class="btn btn-explore-banner">Contact now <i class="fas pl-1 fa-long-arrow-alt-right"></i> </a>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="single_guest_pricing_table">
          <div class="single_guest_pricing_head">
            <h3>Platinum</h3>
            <p>Agency Placement</p>
            <h4 class="service_price">$700</h4>
          </div>
          <div class="single_guest_pricing_body">
            <ul>
              <li><span class="guest_post_indivisual">10 Guest Posts</span></li>
              <li><span class="guest_post_indivisual">Domain Authority 40+</span></li>
              <li><span class="guest_post_indivisual">Trust Flow 20+</span></li>
              <li><span class="guest_post_indivisual">Citation  Flow 30+</span></li>
              <li><span class="guest_post_indivisual">10 quality Contents</span></li>
              <li><span class="guest_post_indivisual">600+ Words Contents</span></li>
              <li><span class="guest_post_indivisual">2 links per Contents</span></li>
			  <li><span class="guest_post_indivisual">Dofollow Links</span></li>
			  <li><span class="guest_post_indivisual">Low Spam Score</span></li>
			  <li><span class="guest_post_indivisual">Permanent Links</span></li>
			  <li><span class="guest_post_indivisual">SEO Friendly Content</span></li>
			  <li><span class="guest_post_indivisual">Get Quality Traffic</span></li>
			  
			  
            </ul>
          </div>
          <div class="single_guest_pricing_footer">
            <a href="contact.php" class="btn btn-explore-banner">Contact now <i class="fas pl-1 fa-long-arrow-alt-right"></i> </a>
          </div>
        </div>
      </div>


    </div>


  </div>
</div>
</div>

<?php include('seller-action.php') ?>

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
