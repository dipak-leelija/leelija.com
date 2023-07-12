<?php
session_start();
// var_dump($_SESSION);
//include_once('checkSession.php');
require_once "_config/dbconnect.php";
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");
require_once("classes/domain.class.php");
require_once("classes/wishList.class.php");
//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */

$dateUtil   = new DateUtil();
$error 			= new Error();
$search_obj	= new Search();
$customer		= new Customer();
$logIn			= new Login();
$domain			= new Domain();

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

$id = $_REQUEST['id'];

$_SESSION['reorder-page'] = $utility->currentUrl();

if($cusId == 0)
{
  $_SESSION['orderNow']= 'orderNow';
  $_SESSION['orderNowId']= 'orderNow';  
header("Location: login.php");
}
if($cusDtl[0] == 1){
header("Location: dashboard.php");
}

//echo $cusId;exit;
$blogsDtls 	= $blogMst->ShowUserBlogData($cusDtl[0][2]);
$domainDtls	= $domain->ShowUserDomainData($cusDtl[0][2]);


?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>User Dashboard | Dashboard :: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link href="plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />

    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="css/form.css" rel='stylesheet' type='text/css' />
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
        <?php require_once 'partials/navbar.php'; ?>
        <!-- //header -->
        <!-- banner -->
        <div class="edit_profile">
            <div class="container-fluid1">
                <div class=" display-table">
                    <div class="row ">
                        <!--Row start-->
                        <div class="col-md-3 hidden-xs display-table-cell v-align" id="navigation">

                            <div class="client_profile_dashboard_left">
                                <?php include("dashboard-inc.php");?>
                                <hr>
                            </div>

                        </div>
                        <div class="col-md-9 mt-4 px-4 display-table-cell v-align client_profile_dashboard_right">
                            <?php 
     
                                $wishListModel = new WishList();
                                $doller= "$";
                                
                                $wishListsingleData = $blogMst->showBlog($id);
                                //  var_dump($wishListsingleData);
                                // foreach($wishListsingleData as $row) 
                                // {
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button class="btn btn-primary" id="contentPlaceMent">
                                        Content Placement(<?php echo $doller. $wishListsingleData[9]; ?>)
                                    </button>

                                    <div class="siteName">
                                        <p><?php echo  $wishListsingleData[0];  ?></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn btn-primary" id="contentCreationPlacement">
                                        Content Creation And Placement(
                                        <?php 
                                            $contetCreation= 15;
                                            $contentPlacementPrice =  $wishListsingleData[9];
                                            $contetCreationPlacement = $contetCreation +  $contentPlacementPrice;
                                            echo $doller.$contetCreationPlacement
                                        ?>
                                        )
                                    </button>
                                    <div>
                                        <p class="estimatedDate">Estimated completion: 26 Mar 2021</p>
                                        <p class="deviveryDt">Approx 3 days after order confirmation</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- contentPlacement start here -->
                            <div class="contentPlacement">
                                <?php
                                    $_SESSION['domainName'] = $wishListsingleData[0];
                                    $_SESSION['sitePrice']  = $wishListsingleData[9];
                                ?>
                                <form
                                    action="order-details.php?domainName=<?php echo $wishListsingleData[0]; ?>&sitePrice=<?php echo $wishListsingleData[9];?> "
                                    method="post" id="orderForm">
                                    <div class="form-group">
                                        <label for="">Your Content<span class="warning">*</span> (Must be a minimum of
                                            500 words) Don't have a content, get one here
                                            Place your content here. In your content, you can include up to 2 links They
                                            can be in the form of URLs and anchors. In the "URL" and "Anchor text"
                                            fields below,
                                            please insert the same URLs and anchors. <span class="warning">(Don't add
                                                any images in your article)</span></label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="clientContent1" id="" rows="9"
                                                placeholder="Put your content here"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <h5>Target Url<span class="warning">*</span></h5>
                                            <p>Enter the URL that you have included in your content above</p>
                                        </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Enter Your Target URL"
                                            name="clientTargetUrl">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">
                                            <h5>Anchor Text<span class="warning"> *</span></h5>
                                            <p> Enter the anchor text that you have included in your content above.</p>
                                        </label>
                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                            placeholder="Enter Your Anchor Text" name="clientAnchorText">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            <h5>Special requirements</h5>
                                            <p>If necessary, Write all your task requirements here, e. g., content
                                                requirements, Category, deadline, necessity of disclosure, preferences
                                                regarding content placement, etc.</p>
                                        </label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"
                                            name="clientRequirement"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="tid" name="tid" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control d-none" id="blogId" name="blogId"
                                            value="<?php echo $_GET['id']?>">
                                    </div>
                                    
                                    <input type="hidden" name="order-name" id="order-name">

                                    

                                    <div class="box-payment-btn" style="display:flex;">
                                        <div class="form-group">
                                            <!-- <input type="submit" class="btn btn-primary" id="OrderNowPaypal" name="OrderNowPaypal" value="Order Now (For Other Country)"> -->
                                            <button type="submit"
                                                class="btn border border-primary border-2 me-3 bg-transparent"
                                                id="OrderNowPaypal" name="OrderNowPaypal"
                                                style="font-size: 18px; font-weight: 700px;">
                                                <span class="pay">Pay</span><span class="pal">Pal</span>
                                            </button>
                                        </div>

                                    </div>
                                </form>
                                <div class="form-group">
                                    <!-- <input type="submit" class="btn btn-primary" id="OrderNow" name="orderNowCcavenue" value="Order Now (For India Only)"> -->
                                    <button type="submit" class="btn border border-primary border-2 ms-4 bg-transparent"
                                        id="orderNowCcavenue" name="orderNowCcavenue" onclick="ccAvenueOrder()">
                                        <span class="masterCard"><img src="images/payments/masterCard.png"></span>
                                        <span class="visaCard"><img src="images/payments/visaCard.png"></span>
                                        <span> Credit Card or Debit Card</span>
                                    </button>
                                </div>
                            </div>
                            <!-- contentPlacement end here -->

                            <!-- contentCreationPlacement start here -->
                            <div class="contentCreationPlacement">
                                <form
                                    action="order-details2.php?domainName2=<?php echo $wishListsingleData[0];?>&sitePrice2=<?php echo $contetCreationPlacement; ?>"
                                    method="post">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea2">If necessary, Write all your task
                                            requirements here, e. g., content requirements, Category, deadline,
                                            necessity of disclosure, preferences regarding content placement, etc.
                                        </label>
                                        <textarea class="form-control" id="exampleFormControlTextarea2" rows="4"
                                            name="clientRequirement2"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <h5>Target Url<span class="warning"> *</span></h5>
                                            <p>Enter The URL That You Have Included In Your Content Above</p>
                                        </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Enter Your Target URL"
                                            name="clientTargetUrl2">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <h5>Anchor Text<span class="warning">*</span></h5>
                                            <p> Enter the anchor text that you have included in your content above.</p>
                                        </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Enter the Anchor text"
                                            name="clientAnchorText2">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="tid2" name="tid" value="">
                                    </div>
                                    <div class="box-payment-btn" style="display:flex">
                                        <div class="form-group">
                                            <!-- <input type="submit" class="btn btn-primary" id="OrderNowPaypal2" name="OrderNowPaypal2" value="Order Now (For Other Country)"> -->
                                            <button type="submit" class="btn " id="OrderNowPaypal2"
                                                name="OrderNowPaypal2"
                                                style="background-color: transparent; font-size: 20px; font-weight: 700px;  border: 2px solid #1a9fec; margin-right: 20px !important ">

                                                <span class="pay">Pay</span><span class="pal">Pal</span>

                                            </button>
                                        </div>
                                        <div class="form-group">
                                            <!-- <input type="submit" class="btn btn-primary" id="OrderNow2" name="orderNowCcavenue2" value="Order Now (For India Only)"> -->
                                            <button type="submit" class="btn" id="OrderNow2" name="orderNowCcavenue2"
                                                style="background-color: transparent; color: skyblue; border: 2px solid #1a9fec; margin-left: 20px">
                                                <span class="masterCard"><img
                                                        src="images/payments/masterCard.png"></span>
                                                <span class="visaCard"><img src="images/payments/visaCard.png"></span>
                                                <span> Credit Card or Debit Card</span>
                                            </button>

                                        </div>
                                    </div>

                                </form>
                            </div>
                            <?php /*}*/?>
                            <!-- contentCreationPlacement end here -->
                        </div>
                        <!--Row end-->
                    </div>
                </div>
                <!-- //end display table-->

                <!-- Footer -->
                <?php require_once 'partials/footer.php'; ?>
                <!-- /Footer -->
            </div>
        </div>
        <!-- js-->
        <script src="js/jquery-2.2.3.min.js"></script>

        <script>
            const ccAvenueOrder = () =>{
                
                document.getElementById("order-name").value = "ccAvOrder";

                document.getElementById("orderForm").action = "payments/gpwishlistOrder/payment.php";
                document.getElementById("orderForm").submit();
                
            }
        </script>
        



        <!-- js-->
        <!-- Scrolling Nav JavaScript -->
        <!-- <script src="js/scrolling-nav.js"></script> -->
        <!-- <script>
        $(document).ready(function() {
            $('[data-toggle="offcanvas"]').click(function() {
                $("#navigation").toggleClass("hidden-xs");
            });
        });
        </script> -->


        <!-- //fixed-scroll-nav-js -->
        <!-- <script src="js/pageplugs/fixedNav.js"></script> -->
        <!-- Banner text Responsiveslides -->

        <!-- //Banner text  Responsiveslides -->
        <!-- start-smooth-scrolling -->
        <!-- <script src="js/move-top.js"></script>
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
        </script> -->
        <!-- //end-smooth-scrolling -->
        <!-- smooth-scrolling-of-move-up -->
        <!-- <script src="js/pageplugs/toPageTop.js"></script> -->

        <!-- <script src="js/SmoothScroll.min.js"></script> -->
        <!-- //smooth-scrolling-of-move-up -->
        <!-- Bootstrap Core JavaScript -->
        <!-- <script src="js/bootstrap.js"></script> -->
        <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
        <!-- //Bootstrap Core JavaScript -->
        <script src="js/orderNow.js"></script>
        <script src="js/payment.js"></script>
        <script>
        window.onload = function() {
            var d = new Date().getTime();
            document.getElementById("tid").value = d;
        };
        </script>
        <script>
        window.onload = function() {
            var d = new Date().getTime();
            document.getElementById("tid2").value = d;
        };
        </script>
</body>

</html>