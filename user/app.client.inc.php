<?php

// require_once("_config/connect.php");
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

?>
<div class="logo" style="text-align: center;">
    <a href="edit-profile.php">
        <?php
			if($cusDtl[9] == ''){
		?>
        <img src="images/icons/user.png" alt="" class="visible-xs visible-sm circle-logo">
        <?php
			}else{
		?>
        <img src="images/user/<?php echo $cusDtl[9] ?>" alt="<?php echo $cusDtl[5] ?>"
            class="visible-xs visible-sm circle-logo">
        <?php
			}
		?>
    </a>
    <p class="blod"><?php echo $cusDtl[5];?></p>
    <p><?php echo $cusDtl[14];?></p>
</div>
<div class="navi">
    <ul>
        <li class="active">
            <a href="dashboard.php"><i class="fa fa-home pr-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Dashboard</span></a>
        </li>
        <li>
            <a href="blogs-list.php"><i class="fa fa-tasks pr-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Guest posting Blogs</span></a>
        </li>


        <li>
            <a href="#"><i class="fa fa-user pr-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Notification</span></a>
        </li>

        <li>
            <a href="edit-profile.php"><i class="fa fa-cog pr-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Setting</span></a>
        </li>
    </ul>
</div>