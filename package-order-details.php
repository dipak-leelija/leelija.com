<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();

// var_dump($_SESSION);
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once "includes/constant.inc.php";
require_once "classes/customer.class.php";
require_once "classes/content-order.class.php";
require_once "classes//gp-order.class.php";
require_once "classes/orderStatus.class.php";
// require_once "classes/blog_mst.class.php";
require_once "classes/utility.class.php";

/* INSTANTIATING CLASSES */
$customer		= new Customer();
// $blogMst		= new BlogMst();
$ContentOrder   = new ContentOrder();
$Gporder        = new Gporder();
$OrderStatus    = new OrderStatus();
$utility		= new Utility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);
if($cusId == 0){
    header("Location: index.php");
}

if($cusDtl[0] == 1){
    header("Location: dashboard.php");
}
if(isset($_GET['data'])){
    $orderId			  		= $_GET['data'];
}else {
    header("Location: my-orders.php");
}
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>My Order Details:: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <!-- Bootstrap Core CSS -->
    <link href="plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="css/dashboard.css" rel='stylesheet' type='text/css' />
    <link href="css/my-orders.css" rel='stylesheet' type='text/css' />

    <!-- font-awesome icons -->
    <link href="css/fontawesome-all.min.css" rel="stylesheet">

    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php  require_once "partials/navbar.php" ?>
        <?php //include 'header-user-profile.php'?>

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
                        <div class="col-md-9 mt-4  display-table-cell v-align client_profile_dashboard_right">

                            <!-- Order Details Start -->
                            <div class="p-3 p-kage-de-tails">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <h5 class="pkage-title ">Package Details:</h5>
                                        <h5 class="pkage-headline">Advanced</h5>
                                        <p class="fs-6 fw-semibold">Business</p>
                                        <ul class="listing-adrs">
                                            <li> Transection Id : 7HG78DSDSC</li>
                                            <li> Price : $500</li>
                                            <li> Payment : Completed</li>
                                            <li> Method : Paypal</li>
                                            <li> Date : 10/12/2022</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 pkagerow">
                                        <h5 class="pkage-title ">Customer Details:</h5>
                                        <h5 class="pkage-headline">Dipak Majumdar</h5>

                                        <ul class="listing-adrs">
                                            <li> Email : dipak@!2</li>
                                            <li> Kolkata, 700124</li>
                                            <li> West Bengal, India</li>
                                            <li><b>Note: </b></li>
                                            <li> Lorem ipsum dolor, sit amet consectetur adipisicing elit</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Order Details End -->

                            <div class="p-3">
                                <h4 class="caution-style pt-2">
                                    Caution! <i class="fa-solid fa-triangle-exclamation"></i>
                                </h4>
                            </div>
                            <div class="caution-content p-3">
                                <h3 class="caution-headline">Content:</h3>
                                <p class="caution-abouts">Your Content<span class="warning">*</span> (Must be a
                                    minimum of
                                    500 words) Don't have a content, get one here
                                    Place your content here. In your content, you can include up to 2 links They
                                    can be in the form of URLs and anchors. In the "URL" and "Anchor text"
                                    fields below,
                                    please insert the same URLs and anchors. <span class="warning">(Don't add
                                        any images in your article)</span></p>

                                <p class="mt-3 fw-semibold">Target Url:</p>
                                <p class="caution-abouts">Enter The URL That You Have Included In Your Content Above
                                </p>

                                <p class="mt-3 fw-semibold">Anchor Text:</p>
                                <p class="caution-abouts">Enter The Anchor Text That You Have Included In Your
                                    Content Above.</p>
                            </div>


                            <form class="mt-5" action="" method="post" id="orderForm">
                                <div class="row px-3" id="row1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <h5>Content<span class="warning">*</span></h5>
                                        </label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="clientContent1" id="" rows="9"
                                                placeholder="Put your content here"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <h5>Target Url<span class="warning">*</span></h5>
                                        </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Enter Your Target URL"
                                            name="clientTargetUrl1">
                                    </div>

                                    <div class="form-group">

                                        <label for="exampleInputPassword1">

                                            <h5>Anchor Text<span class="warning"> *</span></h5>

                                        </label>
                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                            placeholder="Enter Your Anchor Text" name="clientAnchorText1">

                                    </div>

                                    <div id="content-area"></div>


                                    <div class="my-2 mb-4 text-end ">

                                        <span id="b1" class="btn btn-primary add-more adding-morebtn"
                                            onclick="add_more_field();">Add
                                            Next
                                            Content</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            <h5>Special requirements</h5>
                                            <p style="font-size: 1.2rem ">If necessary, Write all your task requirements
                                                here, e. g., content
                                                requirements, Category, deadline, necessity of disclosure, preferences
                                                regarding content placement, etc.</p>
                                        </label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"
                                            name="clientRequirement"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="tid" name="tid" value="">
                                    </div>
                                    <div class="text-center">
                                        <button class="btn apply-button" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>



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
        <script src="plugins/bootstrap-5.2.0/js/bootstrap.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert2.all.min.js" type="text/javascript"></script>
        <script src="plugins/data-table/simple-datatables.js"></script>
        <script src="plugins/tinymce/tinymce.js"></script>
        <script src="plugins/main.js"></script>
        <script src="plugins/jquery-3.6.0.min.js"></script>

        <!-- //fixed-scroll-nav-js -->
        <!-- <script src="js/pageplugs/fixedNav.js"></script> -->
        <script src="js/customerSwitchMode.js"></script>


        <script>
        var countre = 1;
        var countreMaxLimit = 5;

        function add_more_field() { 
            if (countre <= countreMaxLimit) {
                countre = countre + 1;
                html =
                '<div class="row" id="row' + countre + '">\
                <div class = "form-group">\
                <label for = "exampleInputEmail1" >\
            <h5> Content <span class = "warning">*</span></h5 ></label>\
  <div class = "form-group">\
 <textarea class = "form-control" name = "clientContent' + countre +
                ' "id =" "rows = "9"  placeholder ="Put your content here"> \
 </textarea> </div> \
 </div>\
   <div class = "form-group">\
 <label for = "exampleInputEmail1" >\
 <h5> Target Url <span class = "warning"> * </span></h5 > </label>\
<input type = "text"  class = "form-control"   id = "exampleInputEmail1"   ariadescribedby = "emailHelp"  placeholder = "Enter Your Target URL"  name = "clientTargetUrl' +
                countre +
                ' "> </div>\
<div class = "form-group"> \
                <label for = "exampleInputPassword1"> \
            <h5> Anchor Text <span class = "warning"> * </span></h5> \
                </label> <input type = "text" class = "form-control" id = "exampleInputPassword1"  placeholder = "Enter Your   Anchor Text"  name = "clientAnchorText' +
                countre + '">  </div>  </div> <div id="content-area"></div>'

            var form = document.getElementById('content-area')
            form.innerHTML += html
            }
        }
        </script>
</body>

</html>