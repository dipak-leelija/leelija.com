<!--
Author: Safikul Islam
Author URL: http://webtechhelp.org
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
<!DOCTYPE HTML>
<html lang="zxx">

<?php include('head-section.php');?>
<title>Start selling web products with us | Start Selling :: <?php echo COMPANY_S; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Great opportunity for all any one can sign up and add their ready blogs, websites, domain name, domain name with website,
	guest post service etc for selling">
<meta charset="utf-8">
<meta name="keywords" content="Web Design, Web Development, Apps Development, SEO Services, Guest Post Services, Domain name with Ready Website,
Ready website for business, High Quality website sales, High quality blogs sales, expired domain sales" />

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- //header -->
        <!-- banner -->
        <div class="banner1">

        </div>
        <div class="start-selling-banner text-center">
            <!-- Start Selling Banner sec-->
            <div class="content-contact-top">
                <br />
                <div class="grid_1">
                    <div class="container-fluid">
                        <h1 class="">The biggest marketplace to sell your blog, website, online business, domain or
                            digital marketing services.</h1><br>
                        <p class="w-75 mx-auto">Sales Your Products And Earning Easy</p>
                    </div>
                </div>
                <?php
					if($cusId == 0)
						{
				?>
                <a href="login.php" class="text-capitalize serv_link btn my-sm-5 my-3 become-a-seller-btn">Become a
                    Seller</a>
                <?php
					}else{
				?>
                <a href="dashboard.php" class="text-capitalize serv_link btn my-sm-5 my-3 become-a-seller-btn">Become a
                    Seller</a>
                <?php
				}
				?>

                <div class="grid_1">
                    <div class="container-fluid">
                        <h2>What are you selling?</h2>
                        <div class="row">
                            <div class="col-md-3 startsellingdiv">
                                <div class="box h-100">
                                    <div class="box-head">
                                        <div class="left-icon first-left-section">
                                            <i class="fas fa-signal"></i>
                                        </div>
                                        <div class="right-section-icon">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                    </div>
                                    <h3>Established blog or website</h3>
                                    <p class="box-bottom-text">Sell your established website or blog with leelija to
                                        generate a good revenue</p>
                                </div>
                            </div>
                            <div class="col-md-3 startsellingdiv">
                                <div class="box h-100">
                                    <div class="box-head">
                                        <div class="left-icon second-left-section">
                                            <i class="fas fa-th-large"></i>
                                        </div>
                                        <div class="right-section-icon">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                    </div>
                                    <h3>Guest post Service</h3>
                                    <p class="box-bottom-text">Sell guest post service with leelija to generate a good
                                        revenue</p>
                                </div>
                            </div>
                            <div class="col-md-3 startsellingdiv">
                                <div class="box h-100">
                                    <div class="box-head">
                                        <div class="left-icon third-left-section">
                                            <i class="fas fa-mouse-pointer"></i>
                                        </div>
                                        <div class="right-section-icon">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                    </div>
                                    <h3>domains name </h3>
                                    <p class="box-bottom-text">Sell your domain name with leelija to generate a good
                                        revenue</p>
                                </div>
                            </div>
                            <div class="col-md-3 startsellingdiv">
                                <div class="box h-100">
                                    <div class="box-head">
                                        <div class="left-icon fourth-left-section">
                                            <i class="fas fa-signal"></i>
                                        </div>
                                        <div class="right-section-icon">
                                            <i class="fas fa-flag"></i>
                                        </div>
                                    </div>
                                    <h3>Web Products</h3>
                                    <p class="box-bottom-text">Sell your ready web application, apps,etc with leelija to
                                        generate a good revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end Selling Banner sec //-->

        <!-- //banner -->
        <!-- branches -->
        <section class="py-5 branches position-relative" id="explore">
            <div class="container py-md-5 container-fluid text-center">
                <h2 class="stat-title text-center pb-lg-5 color-blue font-weight-bold">How It Works
                </h2>
                <div class="row slideanim">
                    <div class="col-sm-4 how_it_works">
                        <span>
                            <img src="images/icons/creativity.png" alt="website-design" class="services-icon" />
                        </span>
                        <h4>1. Add Products or Services</h4>
                        <p>Sign up for free, add your established blog, websites or domain name and offer to our global
                            audience.</p>
                    </div>
                    <div class="col-sm-4 how_it_works">
                        <span>
                            <img src="images/icons/sales.png" alt="website-design" class="services-icon" />
                        </span>
                        <h4>2. Sales</h4>
                        <p>Get notified when your product sale, notified also which product most popular .</p>
                    </div>
                    <div class="col-sm-4 how_it_works">
                        <span>
                            <img src="images/icons/paid.png" alt="website-design" class="services-icon" />
                        </span>
                        <h4>3. Get Paid</h4>
                        <p>Get paid after sales. Payment is transferred to you upon Sales completion.</p>
                    </div>
                </div>

            </div>
        </section>
        <!-- //branches -->
        <!-- Q&A Section -->
        <section class="qasection position-relative" id="qasection">
            <div class="container pb-md-5 container-fluid text-center">
                <h2 class="stat-title text-center pb-lg-5 color-blue font-weight-bold">Q&amp;A
                </h2>
                <div class="qstn_ans_section">
                    <div class="row slideanim">
                        <div class="col-sm-6">
                            <button class="accordion">What can I sell?</button>
                            <div class="panel">
                                <p>Your Established Web Products! You can sell your Blogs, Websites, domains, Apps,
                                    Business Development Software, WordPress Themes, Plugins, Guest Posting Services and
                                    any more </p>
                            </div>

                            <button class="accordion">How much price of my product?</button>
                            <div class="panel">
                                <p> It's totally up to you but one thins it's your last minimum price. <b>Sell depend on
                                        your products quality and selling rate.</b></p>
                            </div>

                            <button class="accordion">How can add my products?</button>
                            <div class="panel">
                                <p>Just get registered and take benefits of our exciting platform.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <button class="accordion">How Do I get Paid?</button>
                            <div class="panel">
                                <p>Once you complete a buyer's order or complete a sale your product, the money is
                                    transferred to your account. After that you can request for transfer to your bank or
                                    PayPal. Within 24 hours after your request will tranfer your bank or PayPal </p>
                            </div>

                            <button class="accordion">How much does it cost?</button>
                            <div class="panel">
                                <p>It's totaly free to join on LeeLija. There is no fees to add your web products or
                                    services. You keep 80% of each transaction.</p>
                            </div>

                            <button class="accordion">Any Special benefits?</button>
                            <div class="panel">
                                <p>Sure!! We offer fast and reliable payments that's earning without headache, Any one
                                    can't cheat with you. After join with LeeLija you can sell your any web products or
                                    Services through LeeLija or Promote also these products or services through LeeLija.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //Q&A Section -->

        <!-- Seller Action section -->
        <?php include('seller-action.php') ?>
        <!-- //Seller Action section -->

        <!-- Footer -->
        <?php require_once "partials/footer.php"; ?>
        <!-- /Footer -->
    </div><!-- home end //-->
    <!-- js-->
    <script src="js/jquery-2.2.3.min.js"></script>
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
    <!-- Accordion setting -->
    <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
    </script>
    <!-- <script src="js/SmoothScroll.min.js"></script> -->
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap Core JavaScript -->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js">
    </script>
    <!-- //Bootstrap Core JavaScript -->

</body>

</html>