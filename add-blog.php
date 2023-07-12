<!--
Author: Safikul Islam
Author URL: http://webtechhelp.org
-->
<?php
session_start();
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
$dateUtil   = new DateUtil();
$MyError 		= new MyError();
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
// print_r($cusDtl);
if($cusId == 0){
	header("Location: index.php");
}

if(isset($_POST['btnAddDomain']))
	{
		$txtDomain			= $_POST['txtDomain'];
		//$txtDomainUrl		= $_POST['txtDomainUrl'];
		$txtNicheId			= $_POST['txtNicheId'];
		$txtDa				= $_POST['txtDa'];
		$txtPa				= $_POST['txtPa'];
		$txtCf				= $_POST['txtCf'];
		$txtTf				= $_POST['txtTf'];
		$txtAlxTraffic		= $_POST['txtAlxTraffic'];
		$txtOrgTraffic		= $_POST['txtOrgTraffic'];
		$txtPrice			= $_POST['txtPrice'];
		$txtMozRank			= $_POST['txtMozRank'];
		$txtFollow			= $_POST['txtFollow'];
		$txtExtUrl			= $_POST['txtExtUrl'];
		$txtDomComments		= $_POST['txtDomComments'];
		$txtDelTime			= $_POST['txtDelTime'];

        // echo $txtFollow; exit;


		//add Blog post session variables
	$sess_arr	= array('txtDomain','txtDomainUrl', 'txtNicheId', 'txtDa','txtPa','txtCf','txtTf','txtAlxTraffic','txtOrgTraffic','txtPrice');
	$utility->addPostSessArr($sess_arr);

	//defining error variables
	$action		= 'add_domain';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addDomain';
	$typeM		= 'ERROR';
	$msg = '';


	$duplicateId	= $MyError->duplicateUser($txtDomain, 'domain', 'blog_mst');

	if(preg_match("^ER^",$duplicateId)){

		//echo "<span class='orangeLetter'>Error: Domain is already taken</span >";
		$MyError->showErrorTA($action, $id, $id_var, $url, 'Blogs Url is already taken', $typeM, $anchor);

	}else{

		//add Guest Blogs
		$blogMst->addBlog($txtDomain,$txtNicheId, $txtDa, $txtPa, $txtCf, $txtTf, '', $txtMozRank, $txtAlxTraffic,$txtOrgTraffic, $txtFollow, '', $txtPrice, '', '', '', '', '', '', $txtPrice, $txtExtUrl, $txtDomComments, $txtDelTime,$cusDtl[0][2], 'No');


		//deleting the sessions
		$utility->delSessArr($sess_arr);

		//forward the web page
		$uMesg->showSuccessT('success', 0, '', 'gblogs-list.php', "Blog Name Has been Successfully Added", 'SUCCESS');
	}


	}
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>Domain name with website or blogs ready for you | Add Blogs ::<?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <script>
    addEventListener("load", function() {
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
    <!-- font-awesome icons -->
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <!--//webfonts-->

    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <!-- require_once "partials/ -->
        <?php require_once 'partials/navbar.php'; ?>
        <!-- //header -->
        <!-- banner -->
        <div class="banner1">

        </div>
        <!-- //banner -->
        <!-- Main Content -->
        <div class="client_add_blog mt-4">
            <div class="container">
                <?php include('breadcrumb.inc.php') ?>
            </div>
            <section class="py-5 branches position-relative" id="explore">
                <div class="container py-md-2 container-fluid text-center">
                    <h2 class="stat-title color-blue font-weight-bold text-center text-uppercase pb-lg-5">Add Your Blog
                        for Guest Posting
                    </h2>
                    <div class="row">
                        <div class="bfrom">
                            <!--start from div-->
                            <form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>"
                                name="formContactform" method="post" enctype="multipart/form-data" autocomplete="off">
                                <b
                                    style="color: red;"><?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?></b>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label class="control-label col-md-2" for="txtDomain">Blog Url:<span
                                                class="orangeLetter"> </label>
                                        <div class="col-md-10">
                                            <input type="text" placeholder="https://example.com/" class="form-control"
                                                id="txtDomain" name="txtDomain"
                                                value="<?php $utility->printSess2('txtDomain',''); ?>" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <div class="row align-items-center">
                                        <label class="control-label col-md-2" for="txtNicheId">Niche</label>
                                        <div class="col-md-10">
                                            <select id="txtNicheId" class="form-control" name="txtNicheId" required>
                                                <option value="" selected="selected">Select</option>
                                                <?php
															$BlogMst  = $blogMst->ShowBlogNichMast();
															foreach($BlogMst as $eachRecord)
																{
																	echo '<option value="'.$eachRecord['niche_name'].'">'.$eachRecord['niche_name'].'</option>';
																}
														?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <!-- begion row -->
                                        <div class="col-md-6">
                                            <div class="row align-items-center">
                                                <label class="control-label col-md-4" for="txtDa">DA:</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="txtDa" name="txtDa"
                                                        placeholder="Domain Authority"
                                                        value="<?php $utility->printSess2('txtDa',''); ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row align-items-center">
                                                <label class="control-label col-md-2" for="txtPa">PA:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="txtPa" name="txtPa"
                                                        placeholder="Page Authority"
                                                        value="<?php $utility->printSess2('txtPa',''); ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <!-- begion row -->
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="control-label col-md-4" for="txtCf">CF:</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="txtCf" name="txtCf"
                                                        placeholder="Citation Flow"
                                                        value="<?php $utility->printSess2('txtCf',''); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row align-items-center">
                                                <label class="control-label col-md-2" for="txtTf">TF:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="txtTf" name="txtTf"
                                                        placeholder="Trust Flow"
                                                        value="<?php $utility->printSess2('txtTf',''); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label class="control-label col-md-2" for="txtAlxTraffic">Alexa Rank:<span
                                                class="orangeLetter"> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="txtAlxTraffic"
                                                name="txtAlxTraffic"
                                                value="<?php $utility->printSess2('txtAlxTraffic',''); ?>" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label class="control-label col-md-2" for="txtOrgTraffic">Organic Traffic:<span
                                                class="orangeLetter"> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="txtOrgTraffic"
                                                name="txtOrgTraffic"
                                                value="<?php $utility->printSess2('txtOrgTraffic',''); ?>" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label class="control-label col-md-2" for="txtMozRank">Moz Rank:<span
                                                class="orangeLetter"> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="txtMozRank" name="txtMozRank"
                                                value="<?php $utility->printSess2('txtMozRank',''); ?>" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <!-- begion row -->
                                        <div class="col-md-6">
                                            <div class="row align-items-center">
                                                <label class="control-label col-md-4" for="txtFollow">Link Type</label>
                                                <div class="col-md-8">
                                                    <select id="txtFollow" class="form-control" name="txtFollow"
                                                        required>
                                                        <option value="DoFollow">DoFollow</option>
                                                        <option value="NoFollow">NoFollow</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row align-items-center">
                                                <label class="control-label col-md-2" for="txtDelTime">Publishing
                                                    Time:</label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control w-75 m-auto" id="txtDelTime"
                                                        name="txtDelTime" placeholder="(In Hours)"
                                                        value="<?php $utility->printSess2('txtDelTime',''); ?>"
                                                        required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <div class="row align-items-center">
                                        <label class="control-label col-md-2" for="txtExtUrl">Example Url:<span
                                                class="orangeLetter"> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="txtExtUrl"
                                                placeholder="https://example.com/article" name="txtExtUrl"
                                                value="<?php $utility->printSess2('txtExtUrl',''); ?>" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label class="control-label col-md-2" for="txtPrice">Price($):<span
                                                class="orangeLetter"> </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="txtPrice" name="txtPrice"
                                                value="<?php $utility->printSess2('txtPrice',''); ?>" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label class="control-label col-md-2" for="txtDomComments">Remarks:<span
                                                class="orangeLetter"> </label>
                                        <div class="col-md-10">
                                            <textarea type="text" class="form-control" id="txtDomComments"
                                                name="txtDomComments" rows="5"
                                                value="<?php $utility->printSess2('txtDomComments',''); ?>"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-evenly ">
                                    <a href="account.php" class="btn btn-danger" id="btn_start_test" >Cancel</a>

                                    <!--<input type="submit" name="btnAddDomain" class="btn btn-success " id="btn_start_test" value="Add New Record" />-->
                                    <button type="submit" name="btnAddDomain" class="btn btn-primary">Add For
                                        Sell</button>
                                </div>
                            </form>
                        </div>
                        <!--end from div-->
                    </div>
                </div>
            </section>
            <!-- //Main content -->

            <!-- contact top -->

            <?php include('more-info.php');?>

        </div>
        <!-- //contact top -->

        <!-- Footer -->
        <?php require_once 'partials/footer.php'; ?>
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
    $(document).ready(function() {
        var next = 1;
        $(".add-more").click(function(e) {
            e.preventDefault();
            var addto = "#field" + next;
            var addRemove = "#field" + (next);
            next = next + 1;
            var newIn = '<input autocomplete="off" class="input form-control" id="field' + next +
                '" name="txtFeatured[]' + next + '" type="text">';
            var newInput = $(newIn);
            var removeBtn = '<button id="remove' + (next - 1) +
                '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
            var removeButton = $(removeBtn);
            $(addto).after(newInput);
            $(addRemove).after(removeButton);
            $("#field" + next).attr('data-source', $(addto).attr('data-source'));
            $("#count").val(next);

            $('.remove-me').click(function(e) {
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length - 1);
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

    });
    </script>
    <!-- /*Accordion setting*/ -->
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