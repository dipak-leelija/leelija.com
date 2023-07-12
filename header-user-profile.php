<?php
//session_start();
//include_once('checkSession.php');
// require_once("_config/connect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");

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

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################

//user id
$cusId			= $utility->returnSess('userid', 0);
//user id
//$cusId			= $utility->returnSess('userid', 0);

?>
<section class="main-header">

    <!-- /header-top-->
    <header class="main-header main_header_section" id="header">
        <nav class="navbar second navbar-expand-lg navbar-light pagescrollfix">
            <div class="container-fluid">
                <h1 class="d-inline">
                    <a class="navbar-brand" href="/">
                        <img src="images/logo/logo.png" class="LeeLija" alt="LeeLija">
                    </a>
                </h1>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-toggle"
                    aria-controls="navbarNavAltMarkup1" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse navbar-toggle" id="navbarNavAltMarkup1">
                    <div class="navbar-nav secondfix ml-lg-auto">
                        <ul class="navbar-nav text-left">
                            <?php if($cusId == 0){ ?>
                            <li class="nav-item"><a class="nav-link" href="login.php">Sign In</a></li>
                            <?php }
									else {?>
                            <li class="nav-item dropdown mr-3">
                                <a class="nav-link dropdown-toggle" href="dashboard.php" id="navbarDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    My Account
                                </a>
                                <div class="dropdown-menu text-lg-left text-center" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item nav-link" href="dashboard.php">Dashboard</a>
                                    <a class="dropdown-item nav-link" href="edit-profile.php">Edit Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item nav-link" href="change-password.php">Change Password</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</section>