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
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);
if($cusId == 0)
	{
		header("Location: index.php");
	}

if(isset($_POST['btnAddProduct'])) 
	{	$txtProdTypeId			= $_POST['txtProdTypeId'];
		$txtProdName			= $_POST['txtProdName'];
		$txtBandName			= $_POST['txtBandName'];
		$txtPlatForm			= $_POST['txtPlatForm'];
		$txtULangues			= $_POST['txtULangues'];
		$txtversion				= $_POST['txtversion'];
		$txtDemoUrl				= $_POST['txtDemoUrl'];
		$txtDesc				= $_POST['txtDesc'];
		$txtPrice				= $_POST['txtPrice'];
		$txtServicePrd			= $_POST['txtServicePrd'];
		$txtUnit				= $_POST['txtUnit'];
		$txtServices			= $_POST['txtServices'];
		$txtPageTitle			= $_POST['txtProdName'];
		$txtMetaDesc			= $_POST['txtMetaDesc'];
		$txtMtags				= $_POST['txtMtags'];
		
		//convert it into seo friendly url
		$txtSeoUrl				= $utility->createContentSEOURL($txtProdName, $txtProdTypeId,'product_type_id','url','product_type', 'seo_url', 'products');
		//echo $txtTitle; exit;
		
		//add Blog post session variables
	$sess_arr	= array('txtProdTypeId','txtProdName', 'txtBandName', 'txtPlatForm','txtULangues','txtversion','txtDemoUrl','txtDesc','txtPrice','txtServicePrd', 
	'txtUnit', 'txtServices');
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'add_domain';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addDomain';
	$typeM		= 'ERROR';
	$msg = '';
	
	
	$duplicateId	= $error->duplicateUser($txtDemoUrl, 'proj_url', 'products');

	if(preg_match("^ER^",$duplicateId))
	{
		//echo "<span class='orangeLetter'>Error: Domain is already taken</span >";
		$error->showErrorTA($action, $id, $id_var, $url, 'Demo Url is already taken', $typeM, $anchor);
	}
	
	else
	{
		
	//add New Products
	$prodId = $product->addProducts($txtProdTypeId,$txtProdName, $txtBandName, $txtPlatForm, $txtULangues, $txtversion, $txtDemoUrl,$txtDesc, $txtPrice, $txtPrice,
						'', $txtServicePrd,$txtUnit, $txtServices, 'Yes', 'No',$txtPageTitle, $txtSeoUrl, $txtMtags, $txtMetaDesc, $cusId);
		
		// Domain Featured Add	
		for($i=0; $i < count($_POST['txtFeatured']); $i++)
			{
				//add the Featured
				$product->addProductsFeatured($prodId, $_POST['txtFeatured'][$i]);
			}
			
		//uploading images
		if($_FILES['fileImg']['name'] != '')
		{
			//rename the file
			$newName = $utility->getNewName4($_FILES['fileImg'], '', $prodId);
			
			//upload and crop the file
			$uImg->imgCropResize($_FILES['fileImg'], '', $newName, 
								 'images/products/', 600, 600, 
						         $prodId, 'image', 'id','products');
		}
		
		//deleting the sessions
		$utility->delSessArr($sess_arr);
		
		//forward the web page
		$uMesg->showSuccessT('success', 0, '', 'dashboard.php', "Product Has been Successfully Added", 'SUCCESS');
	}
		
		
	}
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title> Add new Product| Product :: w3layouts</title>
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
		<!-- banner -->
		<div class="banner1">
			
		</div>
		<!-- //banner -->
		<!-- Main Content -->
		<section class="py-5 branches position-relative" id="explore">
			<div class="container py-md-5 container-fluid text-center">
				<div class="row">
					<div class="col-sm-8">
						<h2 class="stat-title text-center pb-lg-5">Add Your Product for Sell
						</h2>
						<div class="bfrom">	<!--start from div-->
							<form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="formContactform" method="post" enctype="multipart/form-data" autocomplete="off">	
								<b style="color: red;"><?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?></b>
								<div class="form-group" >
									<div class="row">
										<label class="control-label col-md-2" for="txtProdTypeId">Product Type</label>	
											<div class="col-md-10">
												<select id="txtProdTypeId" class="form-control" name="txtProdTypeId" required>
													<option value="" selected="selected">Select Any One</option> 
														<?php
															$productType  = $product->ShowProdTypeData();
															foreach($productType as $eachRecord)
																{
																	echo '<option value="'.$eachRecord['id'].'">'.$eachRecord['product_type'].'</option>';
																}
														?> 
												</select> 
											</div> 
									</div>
								</div>
								<div class="form-group">	
									<div class="row">
										<label class="control-label col-md-2" for="txtProdName">Product name:<span class="orangeLetter"> </label>
										<div class="col-md-10">
											<input type="text" class="form-control" id="txtProdName" name="txtProdName"
											value="<?php $utility->printSess2('txtProdName',''); ?>" required />
										</div>
									</div>
								</div>
								<div class="form-group">	
									<div class="row">
										<label class="control-label col-md-2" for="txtBandName">Band Name:<span class="orangeLetter"> </label>
										<div class="col-md-10">
											<input type="text" class="form-control" id="txtBandName" name="txtBandName"
											value="<?php $utility->printSess2('txtBandName',''); ?>" required />
										</div>
									</div>
								</div>
								
								<div class="form-group" >
									<div class="row" ><!-- begion row -->
										<div class="col-md-6">
											<div class="row">
												<label class="control-label col-md-4" for="txtPlatForm">Platform:</label>	
												<div class="col-md-8">
													<select id="txtPlatForm" class="form-control" name="txtPlatForm" required>
														<option value="Web" >Web</option> 
														<option value="Desktop/Laptop" >Desktop/Laptop</option>
														<option value="SmartPhone" >SmartPhone</option> 
														<option value="iPhone" >iPhone</option>
													</select> 
												</div> 
											</div>
										</div>
										<div class="col-md-6">
											<div class="row">
												<label class="control-label col-md-2" for="txtversion">Version:</label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="txtversion" name="txtversion"
														value="<?php $utility->printSess2('txtversion',''); ?>" required />
												</div> 
											</div>
										</div>
									</div>
								</div>
								<small>Example: Java, PHP, Jquery, CSS, Html, JavaScript</small>
								<div class="form-group">	
									<div class="row">
										<label class="control-label col-md-2" for="txtULangues">Using Langues:<span class="orangeLetter"> </label>
										<div class="col-md-10">
											<input type="text" class="form-control" id="txtULangues" name="txtULangues"
											value="<?php $utility->printSess2('txtULangues',''); ?>" required />
										</div>
									</div>
								</div>
								
								<div class="form-group">	
									<div class="row">
										<label class="control-label col-md-2" for="txtDemoUrl">Demo Url:<span class="orangeLetter"> </label>
										<div class="col-md-10">
											<input type="text" class="form-control" id="txtDemoUrl" name="txtDemoUrl"
											value="<?php $utility->printSess2('txtDemoUrl',''); ?>" required />
										</div>
									</div>
								</div>
								<div class="form-group">	
									<div class="row">
										<label class="control-label col-md-2" for="txtMetaDesc">Brief:<span class="orangeLetter"> </label>
										<div class="col-md-10">
											<textarea type="text" class="form-control" id="txtMetaDesc" name="txtMetaDesc" rows="5"
											value="<?php $utility->printSess2('txtMetaDesc',''); ?>" >
											</textarea>
										</div>
									</div>
								</div>
								<div class="form-group">	
									<div class="row">
										<label class="control-label col-md-2" for="txtDesc">Description:<span class="orangeLetter"> </label>
										<div class="col-md-10">
											<textarea type="text" class="form-control" id="txtDesc" name="txtDesc" rows="5"
											value="<?php $utility->printSess2('txtDesc',''); ?>" >
											</textarea>
										</div>
									</div>
								</div>
								<div class="form-group">	
									<div class="row">
										<label class="control-label col-md-2" for="txtPrice">Price($):<span class="orangeLetter"> </label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="txtPrice" name="txtPrice"
											value="<?php $utility->printSess2('txtPrice',''); ?>" required />
										</div>
									</div>
								</div>
								
								<div class="form-group" >
									<div class="row" ><!-- begion row -->
										<div class="col-md-6">
											<div class="row">
												<label class="control-label col-md-4" for="txtServicePrd">Service Period:</label>
												<div class="col-md-8">
													<input type="text" class="form-control" id="txtServicePrd" name="txtServicePrd"
														value="<?php $utility->printSess2('txtServicePrd',''); ?>" required />
												</div> 
											</div>
										</div>
										<div class="col-md-6">
											<div class="row">
												<label class="control-label col-md-4" for="txtUnit">Unit:</label>	
												<div class="col-md-8">
													<select id="txtUnit" class="form-control" name="txtUnit" required>
														<option value="Day" >Day</option> 
														<option value="Month" >Month</option>
														<option value="Year" >Year</option> 
													</select> 
												</div> 
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">	
									<div class="row">
										<label class="control-label col-md-2" for="txtServices">Services Details:<span class="orangeLetter"> </label>
										<div class="col-md-10">
											<textarea type="text" class="form-control" id="txtServices" name="txtServices" rows="5"
											value="<?php $utility->printSess2('txtServices',''); ?>" >
											</textarea>
										</div>
									</div>
								</div>
								<div class="form-group">	
									<div class="row">
										<div class="control-label col-md-2">
											Upload Image(600X600)
										</div>	
										<div id="image-preview" class="col-md-6">
											<label for="image-upload" id="image-label">Choose Image</label>
											<input type="file" name="fileImg" id="image-upload" required />
										</div>
									</div>
								</div>
								<small>Press + to add another Feaured :)</small>
								<div class="form-group">	
									<div class="row">
										<input type="hidden" name="count" value="1" />
										<label class="control-label col-md-2" for="field1">Product Featured:<span class="orangeLetter"> </label>
										<div class="col-md-6">
											<div class="controls" id="profs"> 
												<div id="field"><input autocomplete="off" class="input form-control" id="field1" name="txtFeatured[]" type="text" placeholder="Write your domain featured" /></div>
											</div>
										</div>
										<div class="col-md-2">
										<button id="b1" class="btn add-more" type="button">+</button>
										</div>
									</div>
								</div>
								<small>Use maximum 5 tags( example: tags1, Tags2,.,.,tags5)</small>
								<div class="form-group">	
									<div class="row">
										<label class="control-label col-md-2" for="txtMtags">Tags:<span class="orangeLetter"> </label>
										<div class="col-md-10">
											<input type="text" class="form-control" id="txtMtags" name="txtMtags"
											value="<?php $utility->printSess2('txtMtags',''); ?>" required />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-4">
										<!--<input type="submit" name="btnAddDomain" class="btn btn-success " id="btn_start_test" value="Add New Record" />-->
										<button type="submit" name="btnAddProduct" class="add-project">Add For Sell</button>
									</div> 
									<div class="form-group col-md-4">
										<a href="account.php" class="btn btn-warning btn-sm btn-block" id="btn_start_test">Cancel</a>
									</div> 
								</div>
							</form>
						</div><!--end from div-->
					  
					</div>
					
					<div class="col-sm-4">
						
					</div>
				</div>
			  
			</div>
		</section>
		<!-- //Main content -->
		
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
	
<script src="js/jquery.uploadPreview.js"></script>	
	
<script type="text/javascript">
$(document).ready(function() {
  $.uploadPreview({
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label"
  });
});
</script>
	
	<!--Add remove input field-->
	<script>
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

	</script>
	<!--//Add remove input field-->
	
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
/*Accordion setting*/	
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
	<script src="js/SmoothScroll.min.js"></script>
	<!-- //smooth-scrolling-of-move-up -->
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js">
	</script>
	<!-- //Bootstrap Core JavaScript -->
</body>

</html>