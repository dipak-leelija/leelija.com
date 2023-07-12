<?php

// require_once("_config/connect.php");
// require_once("includes/constant.inc.php");
// require_once("classes/date.class.php");
// require_once("classes/error.class.php");
// require_once("classes/search.class.php");
// require_once("classes/customer.class.php");
// require_once("classes/login.class.php");

// //require_once("../classes/front_photo.class.php");
// require_once("classes/blog_mst.class.php");
// require_once("classes/utility.class.php");
// require_once("classes/utilityMesg.class.php");
// require_once("classes/utilityImage.class.php");
// require_once("classes/utilityNum.class.php");

// /* INSTANTIATING CLASSES */
// $dateUtil      	= new DateUtil();
// $error 			= new Error();
// $search_obj		= new Search();
// $customer		= new Customer();
// $logIn			= new Login();

// //$ff				= new FrontPhoto();
// $blogMst		= new BlogMst();
// $utility		= new Utility();
// $uMesg 			= new MesgUtility();
// $uImg 			= new ImageUtility();
// $uNum 			= new NumUtility();
// ######################################################################################################################
// $typeM		= $utility->returnGetVar('typeM','');
// //user id
// $cusId		= $utility->returnSess('userid', 0);
// $cusDtl		= $customer->getCustomerData($cusId);

?>
<div class="logo text-center" >
    <a href="edit-profile.php">
        <?php
			if($cusDtl[0][9] == ''){
		?>
        <img src="images/icons/user.png" alt="" class="visible-xs visible-sm circle-logo">
        <?php
								}else{
							?>
        <img src="images/user/<?php echo $cusDtl[0][9] ?>" alt="<?php echo $cusDtl[0][5] ?>"
            class="visible-xs visible-sm circle-logo">
        <?php
								}
							?>
    </a>
    <p class="blod"><?php echo $cusDtl[0][5];?></p>
    <p><?php echo $cusDtl[0][14];?></p>
</div>


<div class="navi">

    <?php if($cusDtl[0][0] == 2){?>
    <!-- Customer Switch Mode -->
    <div class="form-check form-switch  my-3">
        <input class="form-check-input" type="checkbox" id="toClient" />
        <label class="form-check-label" for="flexSwitchCheckDefault" style="color:#0673BA; font-weight: 600;">Become a
            Client</label>
    </div>
    <ul>
        <li class="active">
            <a href="dashboard.php"><i class="fa fa-home pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Dashboard</span></a>
        </li>
        <li>

            <a href="my-guest-post.php"><i class="fas fa-cart-arrow-down"></i> <span
                    class="hidden-xs hidden-sm">Order</span></a>

        </li>

        <li>
            <a href="gblogs-list.php"><i class="fa fa-tasks pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Guest posting Blogs</span></a>
        </li>
        <li>
            <a href="add-blog.php"><i class="fa fa-plus pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Add Blog for Guest Post</span></a>
        </li>
        <li>
            <a href="my-domain.php"><i class="fa fa-globe pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Web Products Or Blogs</span></a>
        </li>
        <li>
            <a href="add-domain.php"><i class="fa fa-plus pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Sell Products or Blogs</span></a>
        </li>

        <!-- <li>
								<a href="" class="wishlistBlog"><span class="wisListHeart"><i class="fas fa-heart"></i></span> <span>Wishlist</span></a>
							</li> -->

        <li>
            <a href="dashboard-notification.php"><i class="fa fa-user pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Notification</span></a>
        </li>

        <li>
            <a href="edit-profile.php"><i class="fa fa-cog pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Setting</span></a>
        </li>
        <li>
            <a href="logout.php" class="wishlistBlog"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Logout</span></a>
        </li>
    </ul>
    <?php } else{?>


        <!-- ===============================================================================================================
        ==========================================     Side Navbar For Client     ==========================================
        =================================================================================================================-->
    <!-- Customer Switch Mode -->
        <div class="form-check form-switch  my-3">
            <input class="form-check-input" type="checkbox" id="toSeller" />
            <label class="form-check-label" for="flexSwitchCheckDefault" style="color:#0673BA; font-weight: 600;">Become a Seller</label>
        </div>
    <!-- Customer Switch Mode end-->

    <ul>
        <li class="active">
            <a href="app.client.php"><i class="fa fa-home pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Dashboard</span></a>
        </li>
        <li >
            <a href="my-orders.php"><i class="text-primary fas fa-handshake pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">My Orders</span></a>
        </li>
        <li>
            <a href="blogs-list.php"><i class="fa fa-tasks pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Guest posting Blogs</span></a>
        </li>


        <li>
            <a href="#"><i class="fa fa-user pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Notification</span></a>
        </li>

        <li>
            <a href="edit-profile.php"><i class="fa fa-cog pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Setting</span></a>
        </li>
        <!-- <div><span class="wisListHeart"><i class="fas fa-heart"></i></span> <span><a href="">Wishlist</a></span></div> -->
        <li>
            <a href="wishlist.php" class="wishlistBlog"><span class="wisListHeart"><i class="fas fa-heart"></i></span>
                <span>Wishlist</span></a>
        </li>
        <li>
            <a href="logout.php" class="wishlistBlog"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Logout</span></a>
        </li>

    </ul>
    <?php }?>
</div>