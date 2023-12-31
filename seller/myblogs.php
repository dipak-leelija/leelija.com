<?php
session_start();
$page = "Admin_my-blogs";
require_once dirname(__DIR__)."/includes/constant.inc.php";
require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/date.class.php";
require_once ROOT_DIR."classes/error.class.php";
require_once ROOT_DIR."classes/search.class.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/login.class.php";

//require_once("../classes/front_photo.class.php");
require_once ROOT_DIR."classes/niche.class.php";
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
$Niche		    = new Niche();
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
#########################################################################################
$currentURL = $utility->currentUrl();

require_once 'seller-session.inc.php';

$domainDtls		= $domain->ShowUserDomainData($cusDtl[0][2]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">

    <!-- Title -->
    <title><?php echo COMPANY_FULL_NAME; ?>: Web Products Or Blogs</title>
    <link rel="shortcut icon" href="<?= FAVCON_PATH ?>" />

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/fontawesome-6.1.1/css/all.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/highlight/styles/github-gist.css" rel="stylesheet">
    <link href="<?= URL ?>assets/vendors/pagination/pagination.css" rel="stylesheet" >


    <!-- Theme Styles -->
    <link href="<?= URL ?>assets/portal-assets/css/main.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/css/myblogs.css" rel="stylesheet">
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <?php require_once ROOT_DIR."components/sidebar.php"; ?>
        <!-- sidebar ends -->
        <div class="app-container">
            <!-- navbar header starts -->
            <?php require_once ROOT_DIR."components/navbar.php"; ?>
            <!-- navbar header ends -->
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card page-description">
                                    <h2>Web Products Or Blogs <i class="fa-solid fa-blog fa-shake"></i></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card  px-3 py-5">
                                    <section class="">
                                        <!-- row start -->
                                        <div class="row justify-content-center px-3">

                                            <?php
					                        if ($domainDtls != NULL) {
						                        foreach($domainDtls as $eachRecord){
								                $nicheDtls	 	= $Niche->showBlogNichMst($eachRecord['niche']);
						                    ?>
                                            <div class="item col-12 col-sm-6 col-md-4 px-4">

                                                <div class="blog-item-card">
                                                    <div class="product-img">
                                                        <img src="<?= URL?>images/domains/<?= $eachRecord['dimage']?>">
                                                    </div>
                                                    <div class="product-info">
                                                        <div class="product-text">
                                                            <h1><i
                                                                    class="fa fa-angle-double-right"></i><?php echo $nicheDtls[0][1];?>
                                                            </h1>
                                                            <h2><a href="domain/<?php echo $eachRecord['seo_url'];?>">
                                                                    <h2 class="prodName-Sec">
                                                                        <?php echo $eachRecord['durl'];?>
                                                                    </h2>
                                                                </a></h2>
                                                            <div class="py-1">
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
                                                                        class="float-right"><?php echo $eachRecord['alexa_traffic'];?>
                                                                    </span>
                                                                </p>
                                                                <p><i class="fas fa-long-arrow-alt-right"></i>
                                                                    Organic Traffic:<span class="float-right">
                                                                        <?php echo $eachRecord['organic_traffic'];?></span>
                                                                </p>
                                                                <p><i class="fas fa-long-arrow-alt-right"></i> Price
                                                                    <span
                                                                        class="float-right">$<?php echo $eachRecord['price'];?></span>
                                                                </p>
                                                            </div>

                                                        </div>
                                                        <div class="product-price-btn">
                                                            <button type="button">View Details</button>
                                                            <a href="edit-item.php?data=<?php echo $eachRecord['id'];?>">Edit</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
							                    }
						                    }
						                    ?>
                                        </div>
                                        <!-- row end -->
                                        <!-- <div class="d-flex justify-content-end mt-3">
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination">
                                                    <li class="prev page-item"><a class="page-link"
                                                            href="#">Previous</a>
                                                    </li>
                                                    <!-- <div id="pageNums"> 
                                                    <li class="page page-item">
                                                        <a class="page-link"> <span class="page-num"></a>
                                                    </li>
                                                    <!-- </div>
                                                    <li class="next page-item"><a class="page-link" href="#">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div> -->
                                    </section>
                                </div>

                            </div>
                        </div>
                        <!-- main row end -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Javascripts -->
        <script src="<?= URL ?>assets/portal-assets/plugins/jquery/jquery-3.5.1.min.js"></script>
        <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->

        <script src="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="<?= URL ?>assets/portal-assets/plugins/pace/pace.min.js"></script>
        <script src="<?= URL ?>assets/portal-assets/plugins/highlight/highlight.pack.js"></script>
        <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>
        <script src="<?= URL ?>assets/vendors/pagination/pagination.js"></script>
        <script>
        $('.item').paginate(3);
        </script>
</body>

</html>