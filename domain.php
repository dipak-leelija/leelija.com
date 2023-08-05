<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";

require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/date.class.php";
require_once ROOT_DIR."classes/error.class.php";
require_once ROOT_DIR."classes/search.class.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/login.class.php";

require_once ROOT_DIR."classes/products.class.php";
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
//$seo_url	= $utility->returnGetVar('seo_url','');

if(isset($_GET['seo_url'])){
	$seo_url			  		= $_GET['seo_url'];
    // $return_url 	= base64_decode($_GET["return_url"]); //get return url
}

$domainDtl		= $domain->getAllDomains($seo_url);
$nicheDtls	 	= $blogMst->showBlogNichMst($domainDtl[1]);
foreach($nicheDtls as $rownicheDtls){
	$rownicheDtls[1];
}
$domFeatures 	= $domain->ShowDfeattwo($domainDtl[19]);
$current_url 	= base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title><?= $domainDtl[0]; ?> Selling on: <?php echo COMPANY_S; ?></title>
    <link rel="icon" href="<?php echo FAVCON_PATH; ?>" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo FAVCON_PATH; ?>" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Ready Website, Ready Blogs, Ready Websites Sales, Ready Blogs sales,
	Domain selling, Low Budget Websites, Good Metrics ready blogs sales, web design" />

    <link href="<?= URL ?>plugins/bootstrap-5.2.0/css/bootstrap.css" rel="stylesheet">
    <link href="<?= URL ?>plugins/fontawesome-6.1.1/css/all.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= URL ?>css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/style.css" rel='stylesheet' type='text/css' />

    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

    <!--//webfonts-->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php  
		require_once ROOT_DIR.'partials/navbar.php';
		?>
        <div class="container indivisual_domain_details">
            <div class="branches">
                <div class="row py-lg-5 pt-sm-5">
                    <div class="col-lg-6">
                        <!-- team-img -->
                        <div class="prod-dtls-sec">
                            <div class="prod-dtls-img">
                                <a href="">
                                    <img src="<?= URL ?>images/domains/<?php echo $domainDtl[10];?>" alt="<?php echo $domainDtl[0];?>" class="img-fluid">
                                </a>
                            </div>
                            <div class="py-lg-5">
                                <div class="row">
                                    <div class="col-lg-5 addcartbttn" id="AddCart">
                                        <input type="button" class="cart-btn purple-btn"
                                            onclick="AddToCart(<?php echo $domainDtl[19]; ?>)" value="ADD TO CART" />
                                    </div>
                                    <div class="col-lg-5 addcartbttn buy-sec">
                                        <input type="button" class="cart-btn purple-btn"
                                            onclick="AddToCart(<?php echo $domainDtl[19]; ?>)" value="BUY NOW" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="pb-lg-5 single_domain_feature">
                            <h2 class="stat-title text-capitalize text-start pb-lg-5"><?php echo $domainDtl[0]; ?></h2>
                            <h3>$<?php echo $domainDtl[8];?></h3>
                            <h3 class="sub-title"><i class="fa fa-angle-double-right"></i>Url:<a rel="nofollow"
                                    href="<?php echo $domainDtl[9];?>" target="_blank"> <?php echo $domainDtl[9];?></a>
                            </h3>
                            <h3 class="sub-title"><i class="fa fa-angle-double-right"></i>Niche:
                                <?php echo $rownicheDtls[1];?></h3>
                            <h3 class="sub-title"><i class="fa fa-angle-double-right"></i>DA:
                                <?php echo $domainDtl[2];?>
                                <i class="fa fa-angle-double-right"></i>PA:<?php echo $domainDtl[3];?>
                            </h3>
                            <h3 class="sub-title"><i class="fa fa-angle-double-right"></i>TF:
                                <?php echo $domainDtl[5];?>
                                <i class="fa fa-angle-double-right"></i>CF:<?php echo $domainDtl[4];?>
                            </h3>
                            <h3 class="sub-title"><i class="fa fa-angle-double-right"></i>Alexa:
                                <?php echo $domainDtl[6];?>
                                <i class="fa fa-angle-double-right"></i>Organic Traffic:<?php echo $domainDtl[7];?>
                            </h3>
                        </div>
                        <h3>Domain Featured</h3>
                        <?php
								foreach($domFeatures as $eachRecord)
									{
							?>
                        <p class="single_featured"><?php echo $eachRecord['featured'];?></p>
                        <?php
								}
							?>

                        <br>
                        <div id="share-buttons">

                            <!-- Email -->
                            <a
                                href="mailto:?Subject=Simple Share Buttons&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 https://simplesharebuttons.com">
                                <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
                            </a>

                            <!-- Facebook -->
                            <a href="http://www.facebook.com/sharer.php?u=http://localhost/lija/domain/<?php echo $seo_url;?>"
                                target="_blank">
                                <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                            </a>

                            <!-- Google+ -->
                            <!--<a href="https://plus.google.com/share?url=https://simplesharebuttons.com" target="_blank">
									<img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
								</a>
								-->
                            <!-- LinkedIn -->
                            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=https://simplesharebuttons.com"
                                target="_blank">
                                <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
                            </a>

                            <!-- Pinterest -->
                            <a
                                href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                                <img src="https://simplesharebuttons.com/images/somacro/pinterest.png"
                                    alt="Pinterest" />
                            </a>

                            <!-- Twitter -->
                            <a href="https://twitter.com/share?url=https://simplesharebuttons.com&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons"
                                target="_blank">
                                <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--</section>-->
        <!-- //branches -->
        <!-- cart popup div area-->
        <div id="AddCartPopup">
            <div id="formpopup">
                <form name="reco" method="post" action="">
                    <div id="addpopup"> </div>
                    <div class="sline"></div>
                    <!--<a style="color:#4E59A2;" href="viewcart.php?return_url=<?php //echo $current_url; ?>">  View Cart</a>-->
                    <!--<img src="images/icon/close-button1.jpg"
                     			alt="close-button" onClick ="div_hide()" style="position:relative; left:80px;">-->
                    <!--<input style="position:relative; left:80px; font-family:'Raleway',sans-serif " id="close_cartpopup" type="button" onClick ="div_hide()" value="cancel">-->
                </form>
            </div>
        </div><!-- cart popup div area end-->

        <!-- contact top -->
        <!-- <div class="contact-top text-center">
            <div class="content-contact-top">
                <h3 class="stat-title text-white">for more information</h3>
                <a href="#contact" class="text-capitalize serv_link btn my-sm-5 my-3 scroll">stay in touch</a>
                <p class="text-white w-75 mx-auto">Donec mi nullDonec mi nulla, auctor nec sem a, ornare auctor mi. Sed
                    mi tortor, commodo a felis in, fringilla tincidunt
                    nulla. Vestibulum volutpat non eros ut vulpuuctor nec sem a, a auctor nec sem a ornare auctor mi.
                </p>
            </div>
        </div> -->
        <!-- //contact top -->

        <!-- Footer -->
        <?php require_once "partials/footer.php"; ?>
        <!-- /Footer -->
    </div>
    <!-- js-->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- js-->
    <script src="js/cart.js"></script>
    <!-- js-->
    <!-- Scrolling Nav JavaScript -->
    <!-- <script src="js/scrolling-nav.js"></script> -->
    <!-- //fixed-scroll-nav-js -->

    <!-- //Banner text  Responsiveslides -->
    <!-- start-smooth-scrolling -->
    <!-- <script src="js/move-top.js"></script> -->
    <!-- <script src="js/easing.js"></script> -->

    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <!-- <script>
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
    </script> -->
    <!-- <script src="js/SmoothScroll.min.js"></script> -->
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.js"></script> -->
	<script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
    <!-- //Bootstrap Core JavaScript -->
</body>

</html>