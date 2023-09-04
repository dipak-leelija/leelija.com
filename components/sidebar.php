<div class="app-sidebar">
    <div class="logo">
        <!-- <a href="index.php" class="logo-icon"><span class="logo-text">LEELIJA</span></a>  -->
        <a href="index.php" class="logo-icon"><span class="logo-text"><img src="<?= LOGO_WITH_PATH ?>" height="40px" alt="logo"/></span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="#">
            <img src="<?= URL ?>assets/images/faces/face28.jpg" alt="profile"/>
                <span class="activity-indicator"></span>
                <span class="user-info-text">Rozy Begum<br><span class="user-state-info">Active</span></span>
            </a>
        </div>
    </div>
    <div class="app-menu" id="sidebar">
        <ul class="accordion-menu">
            <!-- <li class="sidebar-title">
                        Apps
                    </li> -->
            <li class="">
                <a href="<?= SELLER_URL?>" class=""><i class="fa fa-home" aria-hidden="true"></i>Dashboard</a>
            </li>
            <li class="">
                <a href="<?= SELLER_URL?>order.php" class=""><i class="fas fa-cart-arrow-down mr-3"></i>Order</a>
            </li>
            <li class="">
                <a href="<?= SELLER_URL?>myblogs.php" class=""><i class="fa fa-globe mr-3" aria-hidden="true"></i>Web
                    Products Or Blogs</a>
            </li>
            <li class="">
                <a href="<?= SELLER_URL?>add-domain.php" class=""><i class="fa fa-plus mr-3" aria-hidden="true"></i>Sell
                    Products or Blogs</a>
            </li>
            <li class="">
                <a href="<?= SELLER_URL?>notification.php" class=""><i class="fa fa-user mr-3"
                        aria-hidden="true"></i>Notification</a>
            </li>
            <li class="">
                <a href="<?= SELLER_URL?>settings.php" class=""><i class="fa fa-cog mr-3"
                        aria-hidden="true"></i>Settings</a>
            </li>
            <li>
                <a href=""><i class="fa-regular fa-star"></i>Pages<i class="fa-solid fa-angle-right has-sub-menu"></i>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?= SELLER_URL?>pricing.php">Pricing</a>
                        </li>
                        <li>
                            <a href="<?= SELLER_URL?>invoice.php">Invoice</a>
                        </li>
                        <!-- <li>
                                <a href="settings.php">Settings</a>
                            </li> -->
                        <li>
                            <a href="#">Authentication<i class="fa-solid fa-angle-right has-sub-menu"></i></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?= SELLER_URL?>sign-in.php">Sign In</a>
                                </li>
                                <li>
                                    <a href="<?= SELLER_URL?>sign-up.php">Sign Up</a>
                                </li>

                            </ul>
                        </li>

                    </ul>
            </li>
            <li class="sidebar-title">
                UI Elements
            </li>

            <li>
                <a href="#"><i class="fa-solid fa-table-cells"></i>Tables<i
                        class="fa-solid fa-angle-right has-sub-menu"></i></a>
                <ul class="sub-menu">

                    <li>
                        <a href="<?= SELLER_URL?>tables-datatable.php">DataTable</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"><i class="fa-solid fa-gift"></i>Components<i
                        class="fa-solid fa-angle-right has-sub-menu"></i></a>
                <ul class="sub-menu">

                    <li>
                        <a href="<?= SELLER_URL?>components-modals.php">Modals</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="#"><i class="fa-solid fa-pen"></i>Forms<i class="fa-solid fa-angle-right has-sub-menu"></i></a>
                <ul class="sub-menu">

                    <li>
                        <a href="<?= SELLER_URL?>forms-layouts.php">Form Layouts</a>
                    </li>

                    <li>
                        <a href="<?= SELLER_URL?>forms-file-upload.php">File Upload</a>
                    </li>

                    <li>
                        <a href="<?= SELLER_URL?>forms-datepickers.php">Datepickers</a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
</div>

