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
$services		= new Services();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$portpolio = new Portfolio();


$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);

$sercat		= $services->ShowServicesCatData();
// define('WP_USE_THEMES', false);
// require('blog/wp-load.php');
// $portfolioBlogs = new WP_Query(array(
// 	'post_type' => 'posts'
//
// ));

?>

<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<?php include('head-section.php');?>
	<title>View Our Work portfolio:<?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Leelija Work in differnt platform here few web development portfolio, SEO portfolio, Wordpress customization portfolio and web design portfolio" />
	<meta charset="utf-8">
	<meta name="keywords" content="portfolio, SEO portfolio, Web Development portfolio, Wordpress customization portfolio, Work portfolio template, best web design portfolio" />

</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<div id="home"><!--home start-->
		<!-- header -->
		<?php require_once "partials/navbar.php"; ?>

		<div class="main_service_page pt-4"><!--Main div start-->
			<div class="service_page_banner_portfolio text-center banner py-5" >
			  <h1 class="blue_color_class_portfolio text-uppercase font-weight-bold" >portfolio</h1>
			  <h3 class="py-3 mons-font">Take a look to our services for you. </h3>
			  <p>We are providing you the best quality online and Business Development services.</p><p> Our Expert Team always helps you bring your goal closer to you. </p>
			</div>
			<!--Banner Dividor-->

			<!--/End of baneer Dividor-->
			<div class="service_page_body py-5"><!-- service page body start-->
<div class="container"><!-- container start-->

  <div class="portfolio-page">
    <div class="portfolio-top-head">
      <ul class="portfolio-services">
        <li>
        <p class="portfolio-head port-active start-ups">start ups</p>
        </li>
        <li>
          <p class="portfolio-head port-digital">digital marketing</p>
        </li>
      </ul>
      <ul class="portfolio-service-details development-portfolio" style="margin-top: 4px;">
				<li class="portfolio-service-li"><button type="button" name="button" class="protfolioServiceBtn all-ports portActive">All</button></li>
				<?php
				$portTypeGetId = $portpolio->showSinglePortfolioTypeId('Development');

				foreach ($portTypeGetId as $singleportID) {
					$portDetailsById = $portpolio->showDtlsPortById($singleportID['id']);
					if (count($portDetailsById) > 0 ) {
						// print_r($portDetailsById);
				?>
					<li class="portfolio-service-li"><button type="button" name="button" class="protfolioServiceBtn"> <?php echo $portDetailsById[1];  ?> </button></li>
				<?php
					}
				}
				 ?>

      </ul>
      <!-- <ul class="portfolio-service-details digital-portfolio">
				<li class="portfolio-service-li"><button type="button" name="button" class="protfolioServiceBtn all-ports portActive">All</button></li>
				<?php
				$portTypeGetId = $portpolio->showSinglePortfolioTypeId('SEO');

				foreach ($portTypeGetId as $singleportID) {
					$portDetailsById = $portpolio->showDtlsPortById($singleportID['id']);
					?>
					<li  class="portfolio-service-li"><button type="button" name="button" class="protfolioServiceBtn"> <?php echo $portDetailsById[1];  ?> </button></li>
		<?php		}
				 ?>

      </ul> -->
      <ul class="portfolio-service-details seo-portfolio">
        <li><button type="button" name="button" class="protfolioServiceBtn">web design</button></li>
        <li><button type="button" name="button" class="protfolioServiceBtn">web development</button></li>
        <li><button type="button" name="button" class="protfolioServiceBtn">sell</button></li>
      </ul>
    </div>
		<div class="portfolio-body">
			<div class="container">


	<div class="row start-ups-blog common-port-cls">
		<?php
		$portDetails = $portpolio->showSinglePortfolioTypeId('Development');
		//$portDetails = $portpolio->showPortfolioById(2);
			foreach ($portDetails as $portValue) { ?>
				<div class="col-sm-12 col-md-12 col-lg-4 all-port-single text-center <?php $string = $portValue['niche'];
				$string = preg_replace("/[^\w]+/", "-", $string);
					echo strtolower($string);?>">
					<div class="card single-portfolio">
						<a href="<?php echo $portValue['url'];?>">
						<img class="portfolio-img port-img " src="images/portfolio/<?php echo $portValue['image'];?> " alt="">
					<div class="portfolio-single-detls"></a>
						<h3 class="text-uppercase"><a href="<?php echo $portValue['url'];?>"> <?php echo $portValue['name']; ?></a></h3>
						<p><?php echo $portValue['description']; ?></p>
					</div>
					</div>
				</div>
		<?php	}
		?>
 </div>

 

<div class="row buy-sell-port">

</div>


</div>

		</div>

  </div>

</div><!-- //container end-->
			</div><!-- //service page body end-->


			<?php include('seller-action.php') ?>




		</div><!-- //Main div end-->
		<?php require_once "partials/footer.php"; ?>
		<!-- /Footer -->

	</div><!-- //home end-->
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

	$(".EndQuote").on('click',function(){
		$(".leelijaQuote").css("display","block!important");

	});

	$(".EndQuote").click(function(){
		$(".leelijaQuote").css("display","block!important");
	});

	$("#EndQuote").click(function(){
		$(".leelijaQuote").css("display","block");
	});

	$(".quote-close").click(function(){
		$(".leelijaQuote").css("display","none");
	});

$(".portfolio-service-li .protfolioServiceBtn").click(function(){
	var getNiche = $(this).html();
	getNiche = getNiche.trim();
	getNiche = getNiche.replace(/ +/g, '-').toLowerCase();
	var getClass = $(".all-port-single").hasClass(getNiche);
	var addClas = $(this).hasClass('portActive');
	if(addClas){
	$(".protfolioServiceBtn").not(this).removeClass('portActive');
	}
	else {
		$(".protfolioServiceBtn").removeClass('portActive');
		$(this).addClass('portActive');
	}
	$(".all-port-single").css("display","none");
	$('.'+getNiche).css('display','block');
	var allPorts = $(this).hasClass('all-ports');
	if(allPorts){
		$(".all-port-single").css("display","block");
	}

	// if(getClass){
	// 	$(".all-port-single").css("display","none");
	// }
})

	});

</script>
<script src="js/SmoothScroll.min.js"></script>
<!-- //smooth-scrolling-of-move-up -->
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js">
</script>
<script type="text/javascript">

	$(document).ready(function(){
		function hideNseek(sec1,sec2,sec3){
			$(sec1).css("display","flex");
			$(sec2).css("display","none");
			$(sec3).css("display","none");
		}
	$(".portfolio-head").click(function(){
		var hasActive =$(this).hasClass("port-active");
		$(".all-ports").addClass('portActive');
		if(!hasActive){
			$(".portfolio-head").not(this).removeClass("port-active");
			$(this).addClass("port-active");

			if($(this).hasClass("start-ups")){

			hideNseek(".development-portfolio",".seo-portfolio",".digital-portfolio");
			$(this).addClass("port-active");
			hideNseek(".start-ups-blog",".seo-blogs-port",".buy-sell-port");

			}
			else if($(this).hasClass("port-digital")){
				hideNseek(".digital-portfolio",".development-portfolio",".seo-portfolio");
				$(this).addClass("port-active");
				hideNseek(".seo-blogs-port",".buy-sell-port",".start-ups-blog");
			}
			else if ($(this).hasClass('buy-n-sell')) {
				hideNseek(".seo-portfolio",".digital-portfolio",".development-portfolio");
				$(this).addClass("port-active");
				hideNseek(".buy-sell-port",".seo-blogs-port",".start-ups-blog");
			}
		}
		else {

		}
	})
	})
</script>
<!-- //Bootstrap Core JavaScript -->
</body><!--// end body -->

</html>
