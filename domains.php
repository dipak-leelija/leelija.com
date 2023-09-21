<?php
session_start();
require_once("includes/constant.inc.php");
require_once "_config/dbconnect.php";
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");

//require_once("../classes/front_photo.class.php");
require_once("classes/niche.class.php");
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
$Niche		    = new Niche();
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM			= $utility->returnGetVar('typeM','');
//user id
$cusId			= $utility->returnSess('userid', 0);
$cusDtl			= $customer->getCustomerData($cusId);
// $domainDtls		= $domain->ShowDomainData();


?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo COMPANY_S; ?>: blogs name, blogs on sales, blogs popular, blogs platforms</title>
    <link rel="icon" href="<?php echo FAVCON_PATH; ?>" type="image/png">
    <link rel="apple-touch-icon" href="<?php echo FAVCON_PATH; ?>" />

    <meta name="description"
        content="LeeLija help Instantly find the Domain Name, Blogs name, Website for small business, blogs on fashion, blogs about food, blogs design that you have been looking for.">
    <meta name="keywords" content="blogs name, blogs making, blogs for beginners, blog wordpress theme, blogs seo, blogs topics, blogs types, blogs layout, blogs niche, blogs post, blogs templates, blogs for sale,
	blogs for sales, established blogs for sale, blogs sales, blogs on sales" />


    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">

    <!-- Custom CSS -->
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />

    <!-- //Custom Theme files -->
    <link href="css/jquery-ui.css" rel="stylesheet">

    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <!-- <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet"> -->
    <!--//webfonts-->

</head>

<body id="page-top" data-scrollbar data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once "partials/navbar.php"; ?>

        <!-- main container start  -->
        <div class="container-fluid py-3 text-center">

            <h2 class="pb-2 text-uppercase"><span class="">Start</span> Your <span
                    class="color-blue font-weight-bold">Online Business</span> with ready Products</h2>
            <h4>Pick any Domain name with <span class="color-blue"> Ready website or blog</span> and <span
                    class="color-blue">Build</span> Your <span class="color-blue font-weight-bold">Business</span> </h4>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <div class="list-group">
                        <h3>DA</h3>
                        <input type="hidden" id="hidden_minimum_da" value="0" />
                        <input type="hidden" id="hidden_maximum_da" value="100" />
                        <p id="da_show">1 - 100</p>
                        <div id="da_range"></div>
                    </div>
                    <div class="list-group">
                        <h3>Niches</h3>
                        <div class="nichdiv"
                            style="height: 380px; overflow-y: auto; overflow-x: hidden; text-align: start;"
                            id="list-niches" data-scrollbar>
                            <?php
								$niches  = $Niche->ShowBlogNichMast();
								foreach($niches as $eachNice){
							?>
                            <div class="list-group-item checkbox">
                                <label>
                                    <input type="checkbox" class="common_selector niche"
                                        value="<?= $eachNice['niche_id']; ?>">
                                    <?= $eachNice['niche_name']; ?>
                                </label>
                            </div>
                            <?php
								}
							?>
                        </div>
                    </div>

                </div>
                <!--Sort and Search section end-->

                <!--Start Content Section-->
                <div class="col-lg-9">
                    <br />
                    <div class="row filter_data">

                    </div>
                </div>
                <!--end Content Section-->

            </div>
            <!-- end Row-->
        </div>
        <!-- //Main contener end -->

        <!-- Footer -->
        <?php require_once "partials/footer.php"; ?>
        <!-- /Footer -->
    </div>
    <!-- js-->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- <script src="js/jQuery/jquery.js"></script> -->

    <!-- js-->
    <script src="js/jquery-ui.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/cart.js"></script>
    <!-- <script src="js/cart.js"></script> -->
    <!--Start fetching DATA-->
    <script>
    $(document).ready(function() {

        filter_data();

        function filter_data() {
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetch_data';
            var minimum_da = $('#hidden_minimum_da').val();
            var maximum_da = $('#hidden_maximum_da').val();
            var niche = get_filter('niche');
            $.ajax({
                url: "domains.inc.php",
                method: "POST",
                data: {
                    action: action,
                    minimum_da: minimum_da,
                    maximum_da: maximum_da,
                    niche: niche
                },
                success: function(data) {
                    $('.filter_data').html(data);
                }
            });
        }

        function get_filter(class_name) {

            var filter = [];
            $('.' + class_name + ':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function() {
            filter_data();
        });

        $('#da_range').slider({
            range: true,
            min: 0,
            max: 100,
            values: [1, 100],
            step: 2,
            stop: function(event, ui) {
                $('#da_show').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#hidden_minimum_da').val(ui.values[0]);
                $('#hidden_maximum_da').val(ui.values[1]);
                filter_data();
            }
        });

    });
    </script>
    <!--end fetching DATA-->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>


</body>

</html>