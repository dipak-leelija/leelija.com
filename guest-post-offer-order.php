<!--
Author: Safikul Islam
Author URL: https://webtechhelp.org
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
// require_once("classes/login.class.php");
// require_once("classes/services.class.php");
require_once "classes/gp-offer.class.php";

//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");
require_once("classes/gp-order.class.php");
/* INSTANTIATING CLASSES */
$dateUtil       = new DateUtil();
$error 			= new Error();
$search_obj	    = new Search();
$customer		= new Customer();

$GpOfferList	= new GpOfferList();
// $service		= new Services();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$gp				  = new Gporder();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);




if(isset($_GET['data-id'])){
	$domainId			  		= $_GET['data-id'];
	// $return_url 	= base64_decode($_GET["return_url"]); //get return url
}

$domain = $GpOfferList->offerGPById($domainId);

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
    <link rel="icon" href="images/logo/favicon.png" type="image/png">
    <title>Blogger Outreach Services, Guest Post Service: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="LeeLija provided Guest Post Service at reasonable prices on fashion blogs, beauty blogs, health blogs, travel blogs, fitness blogs, tech blogs, home improvement  or more." />
    <meta charset="utf-8">
    <meta name="keywords"
        content="Guest Post, Guest Posting,Guest Post Service, blogger outreach, guest posting services, guest posting blogs, fashion blogs, beauty blogs, health blogs, travel blogs, fitness blogs, tech blogs, home improvement blogs, CBD blogs, Casino Blogs" />


    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">
    <!-- Custom CSS -->
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/guest-post-offer.css" rel='stylesheet' type='text/css' />


    <!-- font-awesome icons -->
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">
    <!--//webfonts-->


</head>

<body data-scrollbar>
    <?php require_once "partials/navbar.php"; ?>







    <div class="container text-center">
        <div class="row">
            <!-- Start Row-->
            <div id="msg">
                <?php //$uMesg->dispMessage($typeM, 'images/icon/', 'blackLarge');?>
            </div>



            <div class="price-table">
                <div class="container">


                    <div class="price-table-box">
                        <div class="row mb-3">
                            <?php
                        foreach($domain as $blog){
                    
                    echo '<div class="col-md-4 mb-3 m-auto">
                            <div class="item_bx" id="">     
                                <p class="package_type_cat"><a href="'.$blog['link'].'" target="_blank">'.$blog['domain'].'</a></p>
                                <p class="price-box-title"><span class="item_dollar">$</span><span
                                        class="item_price" id="item_price">'.$blog['price'].'</span></p>
                                <ul class="item_bx_ul">
                                    <li><i class="fas fa-check-square"></i> 1 Blog Post </li>
                                    <li><i class="fas fa-check-square"></i>'.$blog['follow'].' Link</li>
                                    <li><i class="fas fa-check-square"></i>DA: '.$blog['da'].'</li>
                                    <li><i class="fas fa-check-square"></i>TF :'.$blog['pa'].'</li>
                                    <li><i class="fas fa-check-square"></i>Spam: '.$blog['spam'].'</li>
                                    <li><i class="fas fa-check-square"></i>Organic Traffic: '.$blog['organic_traffic'].'K</li>
                                </ul>

                                <div class=" mx-auto mt-3">
                                    <div id="smart-button-container">
                                        <div style="text-align: center;">
                                            <div id="paypal-button-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                            }
                    ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end Row-->
    </div>

    <div class="mt-4">
        <?php include('seller-action.php') ?>
    </div>



    <!-- Footer -->
    <?php require_once "partials/footer.php"; ?>

    <script>
    let price = document.getElementById('item_price').innerText
    </script>
    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD"
        data-sdk-integration-source="button-factory"></script>
    <script>
    function initPayPalButton() {
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'gold',
                layout: 'vertical',
                label: 'paypal',

            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        "description": "Quality Guest Post Services on newsforshopping.com",
                        "amount": {
                            "currency_code": "USD",
                            "value": price,
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    // Full available details
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                    // Show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';

                    // Or go to another URL:  actions.redirect('thank_you.html');

                });
            },

            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container');
    }
    initPayPalButton();
    </script>


    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>

</body>

</html>