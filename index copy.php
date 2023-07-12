<!--
Author: Safikul Islam
Author URL: https://webtechhelp.org
-->
<?php


session_start();
//include_once('checkSession.php');
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
//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$domain			= new Domain();

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
    <title><?php echo COMPANY_S; ?>: Create website, blogs sales, blogs for beginners</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Business solution to grow online. create a beautiful website, blogs for beginners, blogs sales, buy a domain name, digital marketing services, guest post and 24/7 support.">
    <meta charset="utf-8">
    <meta name="google-site-verification" content="yms7bEjruHA_-HFI2PfRho01yJhjM2PUQMuyYpXlZLM">
    <!-- <link rel="canonical" href="https://www.leelija.com" /> -->

    <meta name="keywords" content="Web Design, Web Development, Apps Development, SEO Services, Guest Post Services, Domain name with Ready Website,
Ready website for business, High Quality website sales, blogs sales, expired domain sales, blogs platforms" />

</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once "partials/header.incold.php"; ?>
        <!-- //header -->
        <!-- banner -->

        <div class="banner">
            <div class="">
                <div class="banner-text-agile" style="background-image: linear-gradient(90deg, #e5eef924, #ebf4fe)">
                    <div class="row m-0">
                        <div class="col-xl-6">
                            <div class="bd-example">
                                <h3 class="b-w3ltxt text-capitalize mt-md-2">
                                    <span class="">We will help you to <span
                                            class="text-uppercase  font-weight-bold dark-blue-color">dream Big</span>
                                        about your <span
                                            class="text-uppercase  font-weight-bold dark-blue-color">business</span>
                                </h3>

                                <!-- <table class="table">
												  <tbody>
												    <tr>
												      <td><i class="fas fa-check"></i>
															online reputation</td>
												      <td><i class="fas fa-check"></i>
															business branding</td>
												      <td><i class="fas fa-check"></i>
															blog sell</td>
												    </tr>
												    <tr>
												      <td><i class="fas fa-check"></i>
															application develpoment</td>
												      <td><i class="fas fa-check"></i>
															web Development</td>
												      <td>	<i class="fas fa-check"></i>
																website sell</td>
												    </tr>
												  </tbody>
												</table> -->

                                <ul class="banner-our-job">
                                    <li><i class="fas fa-check"></i>
                                        <a href="https://www.leelija.com/services.php">online reputation</a>
                                    </li>
                                    <li><i class="fas fa-check"></i>
                                        <a href="https://www.leelija.com/social-media-marketing-services.php">business
                                            branding</a>
                                    </li>
                                    <li><i class="fas fa-check"></i>
                                        <a href="https://www.leelija.com/domains.php">established blog sell</a>
                                    </li>
                                    <li><i class="fas fa-check"></i>
                                        <a href="https://www.leelija.com/web-development-services.php">application
                                            develpoment</a>
                                    </li>
                                    <li><i class="fas fa-check"></i>
                                        <a href="https://www.leelija.com/web-development-services.php">web
                                            Development</a>
                                    </li>
                                    <li><i class="fas fa-check"></i>
                                        <a href="https://www.leelija.com/start-selling.php">Buy Established Blogs</a>
                                    </li>
                                </ul>
                                <div class="clearfix">

                                </div>




                                <!-- <h5 class="py-3 mons-font">Anyone can reach to our millions of user to sell their user ready products and buy their required products via our exhilarating platform.</h5> -->
                                <!-- <ul>
								      	<li><i class="far fa-check-circle py-2 pr-2"></i>Just Dream</li>
												<li><i class="far fa-check-circle py-2 pr-2"></i>Great Opportunity</li>
												<li><i class="far fa-check-circle pt-2 pr-2"></i>Easy Earn</li>
								      </ul>-->
                                <div class="some-social pt-3 pb-1">
                                    <ul>
                                        <li><i class="fab fa-html5 html5" title="html5"></i></li>
                                        <li><i class="fab fa-css3-alt customCSS" title="CSS3"></i></li>
                                        <li><i class="fab fa-php corephp" title="php"></i></li>
                                        <li><i class="fab fa-wordpress customWP" title="wordpress"></i></li>
                                        <li><i class="fab fa-magento magento" title="magento"></i></li>
                                        <li><i class="fab fa-laravel laravel" title="laravel"></i></li>
                                        <li><i class="fab fa-joomla joomla" title="joomla"></i></li>
                                        <li><i class="fab fa-angular angular" title="angular"></i></li>
                                        <li><i class="fab fa-js-square customJs" title="JavaScript"></i></li>
                                    </ul>
                                </div>

                                <div class="index_quary">
                                    <form class="form-group pt-2" role="form" action="contact.php"
                                        name="formContactform" method="post" enctype="multipart/form-data"
                                        autocomplete="off">
                                        <div class="index_search_box">
                                            <input type="email" class="form-control" name="txtEmail" value=""
                                                placeholder="Please Enter Your Email" required>
                                        </div>
                                        <div class="index_search_btn">
                                            <button class="mt-0 btn btn-explore-banner text-capitalize"
                                                name="emailSubmit" type="submit" role="button">Send Request <i
                                                    class="fas pl-1 fa-long-arrow-alt-right"></i></button>
                                        </div>
                                    </form>
                                </div>

                                <!-- </a> -->
                            </div>
                        </div>
                        <div class="col-xl-6 p-0 mb-3 mb-lg-0">
                            <div class="d-none d-xl-block">
                                <img src="images/banner-new.png" alt="banner image" width="650" height="480"
                                    class="main-banner-image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //banner -->


        <!-- <div class="get_a_quote1" style="background: #dddddd;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-md-9">
                        <div class="quote_text text-white1">

                            <h2>#1 platform to buy and sell blog</h2>
                            <p class="text-white1 py-2">Over 50000 buyers are waiting to buy your blog, website, online
                                business or domain.</p>
                        </div>
                    </div>
                    <div class="text-center">
                        <h3>Sell with Leelija</h3>
                        <a href="services.php" class="text-uppercase btn-explore-banner btn blue_btn">Start Selling</a>
                    </div>
                </div>
            </div>
        </div> -->


		<div class="buy-sell-platform">
	<div class="top-side-content-banner get_a_quote">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-sm-9">
					<h2 class="text-uppercase" >#1 platform to buy and sell blog</h2>
					<p>Over 5000 buyers are wating to buy your Domain, Blog, Website or Online Business.</p>
				</div>
				<div class="col-sm-3">
					<p class="banner-second-title-p">Sell With Leelija</p>

					<button type="button" class="divider_button got-to-contributor" name="button" >start selling <i class="fas pl-2 fa-long-arrow-alt-right"></i></button>
				</div>
			</div>
		</div>
	</div>
	<div class="bottom-side-content">
		<div class="container">
			<div class=" py-sm-2">
					<h2 class="pb-2 text-uppercase text-center"><span>Established</span> <span class="color-blue font-weight-bold"> blog for sell</span></h2>
                    
					<div class="row m-0">
					<?php $limitedDomain = $domain->ShowlimitedData(4);
					foreach ($limitedDomain as $row) { ?>
						<div class="col-sm-3">
							<div class="index-featured-blog">
							<img src="images/domains/<?php echo $row['dimage']?>" alt="" class="index-featured-img">
							<div class="index-featured-blog-body">
							<b><a href="domain/<?php echo $row['seo_url'];?>"> <?php echo $row['domain'];?></a></b>
							<p><?php echo 'DA: '.$row['da'];?> <?php echo 'PA: '.$row['pa'];?></p>
							<p class="">Price: <?php echo '$'.$row['price'];?> </p>
							<div class="index-featured-blog-bottom d-flex">
								<a href="domain/<?php echo $row['seo_url'];?>">View</a>
								<a href="#" class="ml-auto">Buy Now</a>
							</div>
							</div>
							</div>
						</div>
					<?php	}
		 			?>
					</div>
			<div class="text-center mt-5 mb-3">
				<a href="domains.php" class="text-uppercase btn-explore-banner btn blue_btn">explore more</a>
			</div>

			</div>

		</div>
	</div>
</div>


        <br><br>
        <!-- <div class="container">
            <h2>Established Blog for Sell</h2>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="prod-sec text-left">
                    <div class="prod-dtls">
                        <div class="prod-img">
                            <a href="">
                                <img src="images/domains/Inspire-Health-103B1CD.jpg" alt="" class="img-fluid">
                            </a>
                            <div class="team-content">
                            </div>
                            <div class="overlay">
                                <div class="text text-center">
                                    <p class="text-white">
                                        '. $row['dimage'] .'
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="prod-content-sec">
                            <h3><i class="fa fa-angle-double-right"></i>Fashion</h3>
                            <a href="domain/'. $row['seo_url'] .'">
                                <h2 class="prodName-Sec">fashion.com</h2>
                            </a>
                            <p>DA:90 PA: 85</p>
                            <h3>Price $580000</h3>

                            <a href="domain/'. $row['seo_url'] .'">View Details</a><br>
                        </div>
                    </div>
                    <div class="buy-sec">

                    </div>
                </div>
            </div>

        </div> -->

        <!--Banner Dividor-->
        <?php include ('quote.php') ?>
        <!--/End of baneer Dividor-->
        <!--Services Section -->
        <section class="wthree-row py-sm-5">
            <div class="container">
                <div id="services" class="container-fluid text-center">
                    <h2 class="pb-2 text-uppercase"><span class="">Explore</span> The <span
                            class="color-blue font-weight-bold">Marketplace</span></h2>
                    <h4>You Are Not Small,<span class="color-blue"> Join</span> and <span
                            class="color-blue">Build</span> Your <span class="color-blue">Business</span> </h4>
                    <br>
                    <div class="row slideanim">
                        <div class="col-md-4 col-sm-6 indivisual-service">
                            <a href="domains.php">
                                <span>
                                    <img src="images/icons/blog.png" alt="Domains & Blogs" class="services-icon" />
                                </span>
                                <h4>Domains & Blogs</h4>
                                <p>Domain Name, Design Blog With contents </p>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6 indivisual-service">
                            <span>
                                <img src="images/icons/website.png" alt="website-design" class="services-icon" />
                            </span>
                            <h4>Website & eCommerce</h4>
                            <p>Business, Professional and eCommerce Website & Lots More</p>
                        </div>
                        <div class="col-md-4 col-sm-6 indivisual-service">
                            <span>
                                <img src="images/icons/software.png" alt="website-design" class="services-icon" />
                            </span>
                            <h4>Business Software</h4>
                            <p>Accounting, Production, Sales, Analytics & Lots More </p>
                        </div>
                        <br><br>
                        <div class="col-md-4 col-sm-6 indivisual-service">
                            <span>
                                <img src="images/icons/apps.png" alt="website-design" class="services-icon" />
                            </span>
                            <h4>Apps & Tools</h4>
                            <p>Apps for Your Business, SEO & Business Tools & Lots More</p>
                        </div>
                        <div class="col-md-4 col-sm-6 indivisual-service">
                            <span>
                                <img src="images/icons/digital-marketing.png" alt="website-design"
                                    class="services-icon" />
                            </span>
                            <h4>Digital Marketing</h4>
                            <p>SEO, Social Media, Guest Posting Services & Lots More</p>
                        </div>
                        <div class="col-md-4 col-sm-6 indivisual-service">
                            <span>
                                <img src="images/icons/graphic-design.png" alt="website-design" class="services-icon" />
                            </span>
                            <h4 style="color:#303030;">Graphics & Design</h4>
                            <p>Logo Design, Website Template & Lots More</p>
                        </div>
                    </div><br><br>
                    <div class="text-center">
                        <a href="services.php" class="text-uppercase btn-explore-banner btn blue_btn">explore now</a>
                    </div>
                </div>
            </div>
        </section>
        <!--Services Section end-->


        <!-- testimonials-->
        <div class="testimonials" id="testi">
            <div class="container">
                <div class="banner-text text-center">
                    <h3 class="stat-title pb-4 mb-2">what our clients say
                    </h3>
                    <div class="callbacks_container">
                        <ul class="rslides" id="slider3">
                            <li>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="testi-pos">
                                            <img src="images/kishu-setia.jpeg" alt="" class="img-fluid" />
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="testi-agile text-left">
                                            <h4>Kishu Setia</h4>
                                            <span class="client_company_name">congue leo</span>
                                            <p>
                                                <span><i class="fas fa-quote-left pr-2"></i></span>Few months ago
                                                planned for a new business,I was bit confuse where to hire a
                                                professional desighner suddenly,found leelija,with a doubt in mind I
                                                hire them.They have done an awesome job.I am totally happy with their
                                                efficiency and work.They delivered what I wanted.They are thoroughly
                                                professional and knowlegable person,They listen to client
                                                requirements,do depth research on the job,suggests if nedded and then
                                                started to do the job.I was really surprised with their quick delivery
                                                aswell,I am more thant happy now.I recommend people online to use their
                                                service,simply outstanding.
                                                <span><i class="fas fa-quote-right pl-2"></i></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="testi-pos">
                                            <img src="images/client2.jpeg" alt="" class="img-fluid" />

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="testi-agile text-left">
                                            <h4>john arim</h4>
                                            <span class="client_company_name">lacinia eget</span>
                                            <p>
                                                <span><i class="fas fa-quote-left pr-2"></i></span>
                                                I was in search of a good Digital Marketing Agency,already hired more
                                                than 10 agency to do seo of my site and increase my sales.One point,I
                                                became hopeless,then I hire this service.I talked to them,they ask for
                                                each requirements.Then started working on my online business site.At
                                                starting I was looking for a good agency,by god grace I found it great.I
                                                noticed some improvements with in few weeks.At present,in few of my main
                                                keywords I am ranking higher in the table than my competitors.Product
                                                sales have been doubled than previous months as well.I am feeling happy
                                                and found breathe easy now.Thanks,to leelija,keep your great works
                                                going,thanks,again.

                                                <span><i class="fas fa-quote-right pl-2"></i></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="testi-pos">
                                            <img src="images/client3.jpeg" alt="" class="img-fluid" />

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="testi-agile text-left">
                                            <h4>john arim</h4>
                                            <span class="client_company_name">Donec rutru</span>
                                            <p>
                                                <span><i class="fas fa-quote-left pr-2"></i></span>I had a plan of
                                                making my online presence at e-commerce world,I planned,planned and
                                                planned but never able to execute it .Finally,I have decided and got a
                                                reference from one of my friend.I call them and make them understood my
                                                plan,they listened to all my queries,they are really humble
                                                professionals .I appreciate their involvement on the project.They built
                                                a website which looks better than most of high ranking sites on google
                                                of my niche.I am so much pleased with their work that I handed over SEO
                                                of my site to them as well.And getting outcomes with in few
                                                months,already I am able to selling my products onlines.This has been
                                                praise worthy stuff!!!!
                                                <span><i class="fas fa-quote-right pl-2"></i></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- //testimonials -->
        <!-- branches -->

        <section class="py-5 branches position-relative" id="explore">
            <div class="container py-sm-5">
                <h3 class="stat-title text-center pb-lg-5">our capabilities
                </h3>
                <div class="row text-center py-sm-5 pb-2 pt-5">
                    <div class="col-md-3 col-6">
                        <div class="services-box">
                            <span class="icon">
                                <img src="images/developer.png" alt="" class="business_solution">
                            </span>
                            <h4>Web Design &amp; Development</h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="services-box">
                            <span class="icon">
                                <img src="images/income.png" alt="" class="business_solution">
                            </span>
                            <h4>Business Branding</h4>
                        </div>
                    </div>
                    <!-- .Services-box ends here -->
                    <div class="col-md-3 col-6 mt-md-0 mt-5">
                        <div class="services-box">
                            <span class="icon">
                                <img src="images/training.png" alt="" class="business_solution">

                            </span>
                            <h4>Business Solution</h4>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mt-md-0 mt-5">
                        <div class="services-box">
                            <span class="icon">
                                <img src="images/online-marketing.png" alt="" class="business_solution">
                            </span>
                            <h4>Online Reputation</h4>
                        </div>
                    </div>
                </div>
                <!--
				<div class="branches">
					<div class="row py-lg-5 pt-sm-5">
						<div class="col-lg-4"> -->
                <!-- team-img -->
                <!--	<div class="team-block">
								<h5>loremipsum dummy text</h5>
								<p>Some text here</p>
								<div class="team-img">
									<img src="images/b1.png" alt="" class="img-fluid">
									<div class="team-content">
										<h4 class="text-white">pretium ut lacinia in</h4>
									</div>
									<div class="overlay">
										<div class="text text-center">
											<p class="text-white">
												Quisque velit nisi, pretium ut lacinia in, elementum id porttitor lectus nibh onec sollicitudin molestie malesuada.enim.
											</p>
										</div>
									</div>
								</div>
							</div>
						</div> -->
                <!-- /.team-img -->
                <!--	<div class="col-lg-4 my-lg-0 my-5"> -->
                <!-- team-img
							<div class="team-block">
								<h5>loremipsum dummy text</h5>
								<p>Some text here</p>
								<div class="team-img">
									<img src="images/b3.png" alt="" class="img-fluid">
									<div class="team-content">
										<h4 class="text-white">pretium ut lacinia in</h4>
									</div>
									<div class="overlay">
										<div class="text text-center">
											<p class="text-white">
												Quisque velit nisi, pretium ut lacinia in, elementum id porttitor lectus nibh onec sollicitudin molestie malesuada.enim.
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>-->
                <!-- /.team-img
						<div class="col-lg-4">-->
                <!-- team-img
							<div class="team-block">
								<h5>loremipsum dummy text</h5>
								<p>Some text here</p>
								<div class="team-img">
									<img src="images/b2.png" alt="" class="img-fluid">
									<div class="team-content">
										<h4 class="text-white">pretium ut lacinia in</h4>
									</div>
									<div class="overlay">
										<div class="text text-center">
											<p class="text-white">
												Quisque velit nisi, pretium ut lacinia in, elementum id porttitor lectus nibh onec sollicitudin molestie malesuada.enim.
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
        </section>
        <!-- //branches -->
        <!-- contact top -->
        <?php include('more-info.php');?>
        <!-- //contact top -->
        <!-- blog -->
        <section class="section-events py-5" id="blog">
            <div class="container py-md-5">
                <?php// require_once('blog.inc.php'); ?>
            </div>
        </section>
        <!-- //blog -->
        <!-- Seller Action section -->
        <?php include('seller-action.php') ?>
        <!-- //Seller Action section -->

        <!-- Footer -->
        <?php require_once "partials/footer.incold.php"; ?>
        <!-- /Footer -->
    </div>
    <!-- js-->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- js-->
    <!-- Scrolling Nav JavaScript -->
    <script src="js/scrolling-nav.js"></script>
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
    <script src="js/responsiveslides.min.js"></script>
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
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
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

		$(".got-to-contributor").click(function(){
			location.href = "./start-selling.php";
		})

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