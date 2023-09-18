<div class="app-sidebar">
    <div class="logo">
        <!-- <a href="index.php" class="logo-icon"><span class="logo-text">LEELIJA</span></a>  -->
        <a href="index.php" class="logo-icon"><span class="logo-text"><img src="<?= LOGO_WITH_PATH ?>" height="40px"
                    alt="logo" /></span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="#">
                <img class="rounded-circle" src="<?= URL ?>images/user/<?= $cusDtl[0][9] ?>" alt="<?= $cusDtl[0][9] ?>" />
                <span class="activity-indicator"></span>
                <span class="user-info-text"><?= $cusDtl[0][5];?>
                    <br>
                    <span class="user-state-info"><?= $cusDtl[0][14];?></span>
                </span>
            </a>
        </div>
    </div>
    <div class="app-menu" id="sidebar">

        <ul class="accordion-menu">
            <li class="sidebar-title">
                Dashboard Pages
            </li>
            <li class="<?= $page == 'Admin_dashboard' ? 'active-page' : ''; ?>">
                <a href="<?= SELLER_URL?>" class=""><i class="fa fa-home" aria-hidden="true"></i>Dashboard</a>
            </li>
            <li class="<?= $page == 'Admin_orders' ? 'active-page' : ''; ?>">
                <a href="<?= SELLER_URL?>order.php" class=""><i class="fas fa-cart-arrow-down mr-3"></i>Order</a>
            </li>
            <li class="<?= $page == 'Admin_my-blogs' ? 'active-page' : ''; ?>">
                <a href="<?= SELLER_URL?>myblogs.php" class=""><i class="fa fa-globe mr-3" aria-hidden="true"></i>Web
                    Products Or Blogs</a>
            </li>
            <li class="<?= $page == 'Admin_add-domin' ? 'active-page' : ''; ?>">
                <a href="<?= SELLER_URL?>add-domain.php" class=""><i class="fa fa-plus mr-3" aria-hidden="true"></i>Sell
                    Products or Blogs</a>
            </li>
            <li class="<?= $page == 'Admin_notification' ? 'active-page' : ''; ?>">
                <a href="<?= SELLER_URL?>notification.php" class=""><i class="fa fa-user mr-3"
                        aria-hidden="true"></i>Notification</a>
            </li>
            <li class="<?= $page == 'Admin_settings' ? 'active-page' : ''; ?>">
                <a href="<?= SELLER_URL?>settings.php" class=""><i class="fa fa-cog mr-3"
                        aria-hidden="true"></i>Settings</a>
            </li>
            <!-- <li>
                <a href=""><i class="fa-regular fa-star"></i>Pages<i class="fa-solid fa-angle-right has-sub-menu"></i>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?= SELLER_URL?>pricing.php">Pricing</a>
                        </li>
                        <li>
                            <a href="<?= SELLER_URL?>invoice.php">Invoice</a>
                        </li>
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
            </li> -->
            <!-- <li class="sidebar-title">
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
            </li> -->

            <!-- <li>
                <a href="#"><i class="fa-solid fa-gift"></i>Components<i
                        class="fa-solid fa-angle-right has-sub-menu"></i></a>
                <ul class="sub-menu">

                    <li>
                        <a href="<?= SELLER_URL?>components-modals.php">Modals</a>
                    </li>

                </ul>
            </li> -->

            <!-- <li>
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
            </li> -->

        </ul>
        <ul class="accordion-menu">
        <div class="form-check form-switch text-dark rounded py-2 ps-2 mx-2 cutomer-switch w-md-100">
            <input class="form-check-input border-opacity-50 ms-0" type="checkbox" role="switch" id="toClient">
            <label class="form-check-label" for="toClient">Become a Client</label>
        </div>
        </ul>
    </div>
</div>