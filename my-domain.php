<!--
Author: Safikul Islam
Author URL: http://webtechhelp.org
-->
<?php
session_start();
//include_once('checkSession.php');
// require_once("_config/dbconnect.php");
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
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);
if($cusId == 0)
	{
		header("Location: index.php");
	}
$domainDtls		= $domain->ShowUserDomainData($cusDtl[0][2]);
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>My Domains | List :: w3layouts</title>
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
	<!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
	<link href="plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />

	<!-- Custom CSS -->
	<link href="css/leelija.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/form.css" rel='stylesheet' type='text/css' />
	<link href="css/custom.css" rel='stylesheet' type='text/css' />
	<link href="css/dashboard.css" rel='stylesheet' type='text/css' />
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
		<!-- banner -->
		<!-- //banner -->
		<!-- Main Content -->
		<div class="my_domain_section my-4">
		<div class="container	">
			<?php include('breadcrumb.inc.php') ?>
		</div>
		<!--<section class="py-5 branches position-relative" id="explore">-->
			<div class="container text-center">
				<div class="row justify-content-evenly">
					<?php
					if ($domainDtls != NULL) {
						foreach($domainDtls as $eachRecord)
							{
								$nicheDtls	 	= $blogMst->showBlogNichMst($eachRecord['niche']);
						?>
							<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
								<div class="card indivisual_blogs my-3" style="border: none;">
								<!-- team-img -->
								<div class="prod-sec">
									<div class="prod-dtls">
										<div class="prod-img">
											<a href="">
												<img src="images/domains/<?php echo $eachRecord['dimage'];?>" alt="<?php echo $eachRecord['domain'];?>" class="img-fluid">
											</a>
											<div class="team-content">
											</div>
											<div class="overlay">
												<div class="text text-center">
													<p class="text-white">
														<?php echo $eachRecord['domain'];?>
													</p>
												</div>
											</div>
										</div>
										<div class="prod-content-sec text-left">
											<h3><i class="fa fa-angle-double-right"></i><?php echo $nicheDtls[0][1];?></h3>
											<a href="domain/<?php echo $eachRecord['seo_url'];?>">
												<h2 class="prodName-Sec"><?php echo $eachRecord['durl'];?></h2>
											</a>
											<p><i class="fas fa-long-arrow-alt-right"></i>
												Domain Authority:<span class="float-right"><?php echo $eachRecord['da'];?></span>
											</p>
											<p><i class="fas fa-long-arrow-alt-right"></i>
												Page Authority: <span class="float-right"><?php echo $eachRecord['pa'];?></span>
											</p>
											<p><i class="fas fa-long-arrow-alt-right"></i>
												Alexa Traffic:<span class="float-right"><?php echo $eachRecord['alexa_traffic'];?> </span>
											</p>
											<p><i class="fas fa-long-arrow-alt-right"></i>
												Organic Traffic:<span class="float-right"> <?php echo $eachRecord['organic_traffic'];?></span>
											</p>
											<h3><i class="fas fa-long-arrow-alt-right"></i> Price <span class="float-right">$<?php echo $eachRecord['price'];?></span></h3>
											<p>
												<?php
													$domFeatures 	= $domain->ShowDfeattwo($eachRecord['id']);
													foreach($domFeatures as $eachRec)
														{
												?>
													<i class="fas fa-long-arrow-alt-right"></i> <?php echo $utility->word_teaser($eachRec['featured'],4);?><br>
												<?php
													}
												?>
											...
											</p>
											<!--<a href="product.php?seo_url=<?php echo $eachRecord['seo_url'];?>">View Details</a>-->
											<div class="d-block py-5">
											<a href="domain/<?php echo $eachRecord['seo_url'];?>" class="btn  view_details" role="button">View Details</a>
											<a href="#" class="btn edit_details float-right">Edit</a></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						}
						?>
				</div><!-- end Row-->

			</div>
			</div>
		<!--</section>-->
		<!-- //Main content -->

		<!-- contact top -->
		<?php //include('more-info.php');?>
		<!-- //contact top -->

		<!-- Footer -->
		<?php require_once "partials/footer.php"; ?>
		<!-- /Footer -->
	</div>
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

<!-- <script src="js/jquery.uploadPreview.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  $.uploadPreview({
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label"
  });
});
</script> -->

	<!--Add remove input field-->
	<!-- <script>
	$(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="txtFeatured[]' + next + '" type="text">';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);

            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
		});

	});

	</script> -->
	<!--//Add remove input field-->

	<!-- Banner text Responsiveslides -->
	<!-- <script src="js/responsiveslides.min.js"></script>
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
	</script> -->
	<!-- //Banner text  Responsiveslides -->
	<!-- start-smooth-scrolling -->
	<!-- <script src="js/move-top.js"></script>
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
<!-- /*Accordion setting*/ -->
<!-- <script>
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
</script> -->
	<!-- <script src="js/SmoothScroll.min.js"></script> -->
	<!-- //smooth-scrolling-of-move-up -->
	<!-- Bootstrap Core JavaScript -->
	<!-- <script src="js/bootstrap.js"></script> -->
	<script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
	<!-- //Bootstrap Core JavaScript -->
</body>

</html>
