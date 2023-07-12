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
$cusDtl		= $customer->getCustomerData($cusId);
if($cusId == 0)
	{
		header("Location: index.php");
	}

if(isset($_POST['btnEditPass']))
{
	$password 	= $_POST['txtPass'];
	$cnfPass  	= $_POST['txtCnfPass'];
	
	//defining error variables
	$action		= 'edit_pass';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $cusId;
	$id_var		= 'id';
	$anchor		= 'editPass';
	$typeM		= 'ERROR';
	
	
	if(strlen($password) < 6)
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERU117, $typeM, $anchor);
	}
	elseif($password != $cnfPass )
	{
		$error->showErrorTA($action, $id, $id_var, $url, "Password Not Matched", $typeM, $anchor);
	}
	else
	{
		//change the password
		$customer->changeUserPassword($cusId, $password);
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], "Password has been successfully Changed", 'SUCCESS');
	}
}
if(isset($_POST['btnCancel']))
{
	//forward
	$uMesg->showSuccessT('success', $id, 'id', "dashboard.php", "", 'Cancel');
}
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title> Edit My Profile | Home :: Lija</title>
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
	<link href="css/dashboard.css" rel='stylesheet' type='text/css' />
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
		<!-- banner -->
			<div class="container1">
		<div class="container-fluid display-table">
			<div class="row "><!--Row start-->
				<div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
					<?php include("dashboard-inc.php");?>
				</div>
				<div class="col-md-10 col-sm-11 display-table-cell v-align">
					<!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
					<header>
						<div class="row">
							<div class="col-md-4">
								<li class="hidden-xs"><a href="#" class="add-project" data-toggle="modal" data-target="#add_project">Add Project</a></li>
							</div>
							<div class="col-md-8">
								
							</div>
						</div>	
					</header>
					
					<div class="user-dashboard">
						<div class="bfrom">	<!--start from div-->
							<form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="formContactform" method="post" enctype="multipart/form-data" autocomplete="off">
								<b style="color: red;"><?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?></b>
								<h3>Change Your Password</h3><br>
								<div class="edit-section">
									
									<div class="form-group">
										<div class="row">
											<label for="txtPass" class="col-sm-3 control-label"> New Password</label>
											<div class="col-sm-9">
												<input type="password" class="form-control" id="txtPass" name="txtPass">
												<span class="orangeLetter">*</span> (minimum 6 chars)
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label for="txtCnfPass" class="col-sm-3 control-label">Confirm Password</label>
											<div class="col-sm-9">
												<input type="password" class="form-control" id="txtCnfPass" name="txtCnfPass">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-4 col-sm-offset-3">
												<button type="submit" name="btnEditPass" class="add-project">Change</button>
											</div>
											<div class="col-sm-4 col-sm-offset-3">
												<button type="submit" name="btnCancel" class="cancel-project">Cancel</button>
											</div>
										</div>
									</div>
							
								</div>
							</form>	
						</div>	
					</div>
				</div>
			</div><!--Row end-->
		</div>



    <!-- Modal -->
    <div id="add_project" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add Project</h4>
                </div>
                <div class="modal-body">
                            <input type="text" placeholder="Project Title" name="name">
                            <input type="text" placeholder="Post of Post" name="mail">
                            <input type="text" placeholder="Author" name="passsword">
                            <textarea placeholder="Desicrption"></textarea>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="button" class="add-project" data-dismiss="modal">Save</button>
                </div>
            </div>

        </div>
    </div>
			</div>
			<!-- //end container sec -->
		
		<!-- Footer -->
		<?php include('footer.inc.php') ?>
		<!-- /Footer -->
	</div>
	<!-- js-->
	<script src="js/jquery-2.2.3.min.js"></script>
	<!-- js-->
	<!-- Scrolling Nav JavaScript -->
	<script src="js/scrolling-nav.js"></script>
	<script>
		$(document).ready(function(){
		   $('[data-toggle="offcanvas"]').click(function(){
			   $("#navigation").toggleClass("hidden-xs");
		   });
		});
	</script>
	
	
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
		$(document).ready(function() {
			var readURL = function(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('.profile-pic').attr('src', e.target.result);
					}
			
					reader.readAsDataURL(input.files[0]);
				}
			}
			

			$(".file-upload").on('change', function(){
				readURL(this);
			});
			
			$(".upload-button").on('click', function() {
			   $(".file-upload").click();
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