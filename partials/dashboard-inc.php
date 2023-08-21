<div class="logo text-center" >
    <a href="edit-profile.php">
        <?php
			if($cusDtl[0][9] == ''){
		?>
        <img src="<?= URL?>images/icons/user.png" alt="" class="visible-xs visible-sm circle-logo">
        <?php
		}else{
		?>
        <img src="<?= URL?>images/user/<?php echo $cusDtl[0][9] ?>" alt="<?php echo $cusDtl[0][5] ?>"
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
            <a href="my-blogs.php"><i class="fa fa-globe pe-2" aria-hidden="true"></i><span
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
            <a href="<?= URL ?>edit-profile.php"><i class="fa fa-cog pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Setting</span></a>
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
            <a href="#"><i class="fa fa-user pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Notification</span></a>
        </li>

        <li>
            <a href="<?= URL ?>edit-profile.php"><i class="fa fa-cog pe-2" aria-hidden="true"></i><span
                    class="hidden-xs hidden-sm">Setting</span></a>
        </li>
        <!-- <div><span class="wisListHeart"><i class="fas fa-heart"></i></span> <span><a href="">Wishlist</a></span></div> -->
        <li>
            <a href="wishlist.php" class="wishlistBlog"><span class="wisListHeart"><i class="fas fa-heart"></i></span>
                <span>Wishlist</span></a>
        </li>

    </ul>
    <?php }?>
</div>