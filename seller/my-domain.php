<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";

require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/date.class.php";
require_once ROOT_DIR."classes/error.class.php";
require_once ROOT_DIR."classes/search.class.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/login.class.php";

//require_once("../classes/front_photo.class.php");
require_once ROOT_DIR."classes/blog_mst.class.php";
require_once ROOT_DIR."classes/domain.class.php";
require_once ROOT_DIR."classes/utility.class.php";
require_once ROOT_DIR."classes/utilityMesg.class.php";
require_once ROOT_DIR."classes/utilityImage.class.php";
require_once ROOT_DIR."classes/utilityNum.class.php";

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
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>

    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link href="<?= URL?>plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL?>plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />

    <!-- Custom CSS -->
    <link href="<?= URL?>css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL?>css/style.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL?>css/form.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL?>css/custom.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL?>css/dashboard.css" rel='stylesheet' type='text/css' />
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
        <?php require_once ROOT_DIR."partials/navbar.php"; ?>
        <!-- //header -->


        <!-- Main Content -->
        <div class="my_domain_section my-4">
            <div class="container">
                <?php include ROOT_DIR.'breadcrumb.inc.php' ?>
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
                                            <img src="<?= URL?>images/domains/<?php echo $eachRecord['dimage'];?>"
                                                alt="<?php echo $eachRecord['domain'];?>" class="img-fluid">
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
                                            Domain Authority:<span
                                                class="float-right"><?php echo $eachRecord['da'];?></span>
                                        </p>
                                        <p><i class="fas fa-long-arrow-alt-right"></i>
                                            Page Authority: <span
                                                class="float-right"><?php echo $eachRecord['pa'];?></span>
                                        </p>
                                        <p><i class="fas fa-long-arrow-alt-right"></i>
                                            Alexa Traffic:<span
                                                class="float-right"><?php echo $eachRecord['alexa_traffic'];?> </span>
                                        </p>
                                        <p><i class="fas fa-long-arrow-alt-right"></i>
                                            Organic Traffic:<span class="float-right">
                                                <?php echo $eachRecord['organic_traffic'];?></span>
                                        </p>
                                        <h3><i class="fas fa-long-arrow-alt-right"></i> Price <span
                                                class="float-right">$<?php echo $eachRecord['price'];?></span></h3>
                                        <p>
                                            <?php
													$domFeatures 	= $domain->ShowDfeattwo($eachRecord['id']);
													foreach($domFeatures as $eachRec)
														{
												?>
                                            <i class="fas fa-long-arrow-alt-right"></i>
                                            <?php echo $utility->word_teaser($eachRec['featured'],4);?><br>
                                            <?php
													}
												?>
                                            ...
                                        </p>
                                        <!--<a href="product.php?seo_url=<?php echo $eachRecord['seo_url'];?>">View Details</a>-->
                                        <div class="d-block py-5">
                                            <a href="domain/<?php echo $eachRecord['seo_url'];?>"
                                                class="btn  view_details" role="button">View Details</a>
                                            <a href="#" class="btn edit_details float-right">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
							}
						}
						?>
                </div>
                <!-- end Row-->

            </div>
        </div>

    </div>
    <!-- js-->
    <script src="<?= URL?>js/jquery-2.2.3.min.js"></script>
    <script src="<?= URL?>plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
</body>

</html>