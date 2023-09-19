<!-- <link href="../plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
<link href="../plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
    id="sidenav-main">
    <div class="sidenav-header">
        <a class="navbar-brand m-0" href="#" target="_blank">
            <!-- <img src="<?= URL ?>leelija-admin/assets/img/logo-ct-dark.png" class="navbar-brand-img h-100"
                alt="main_logo"> -->
            <img src="<?php echo LOGO_WITH_PATH; ?>" alt="logo" class="pe-md-4">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item ">
                <a class="nav-link <?= $page == 'Admin_dashboard' ? 'active' : ''; ?>" href="index.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item has-submenu">
                <a class="nav-link  submenu-toggle <?= $page == "Admin_order" || $page == "Admin_order-details" ?  "active" : "" ?> "
                    href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="<?= $page == "Admin_order" ? "true" : 'false'; ?>" aria-controls="submenu-1">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users-line"></i>
                    </div>
                    <span class="nav-link-text ms-1">Order Management</span>
                </a>
                <div id="submenu-1"
                    class="collapse submenu submenu-1 <?= $page == "Admin_order" || $page == "Admin_order-details" ? "show" : ''; ?>"
                    data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="submenu-item">
                            <a class="submenu-link <?= $page == "Admin_order" || $page == "Admin_order-details" ? "active": ''; ?>"
                                href="orders.php">Orders</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item has-submenu">
                <a class="nav-link  submenu-toggle <?php $page == "services" || $page == "service-types" ? "active": ""; ?>"
                    href="my-guest-post.php" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-4"
                    aria-expanded="<?php if($page == "services" || $page == "service-types"){echo "true";} else { echo "flase"; } ?>"
                    aria-controls="submenu-4">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-cart-arrow-down"></i>
                    </div>
                    <span class="nav-link-text ms-1">Services Management</span>
                </a>
                <div id="submenu-4"
                    class="collapse submenu submenu-4 <?php if($page == "services" || $page == "service-types"){echo "show";} ?>"
                    data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="submenu-item">
                            <a class="submenu-link <?php if($page == "service-types"){echo "active";} ?>"
                                href="service-types.php">Service Types</a>
                        </li>

                        <li class="submenu-item">
                            <a class="submenu-link <?php if($page == "services"){echo "active";} ?>"
                                href="services.php">Services</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item has-submenu">
                <a class="nav-link  submenu-toggle <?php if($page == "blog-items" ){echo "active";} ?> "
                    href="#" data-bs-toggle="collapse" data-bs-target="#blog-items-menu" aria-expanded="<?php if($page == "blog-items" ){echo "true";} else {
                echo "flase"; 
             } ?>" aria-controls="blog-items-menu">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users-line"></i>
                    </div>
                    <span class="nav-link-text ms-1">Blogs/Items</span>
                </a>
                <div id="blog-items-menu"
                    class="collapse submenu blog-items-menu  <?php if($page == "blog-items" ){echo "show";} ?>"
                    data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="submenu-item">
                            <a class="submenu-link <?php if($page == "blog-items"  ){echo "active";} ?>"
                                href="blog-items.php">Blogs</a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link  <?php if($page == "Admin_add-new-employees"  ){echo "active";} ?>"
                                href="add-employees.php">Add New Employee</a>
                        </li>
                    </ul>
                </div>
            </li>




            <li class="nav-item has-submenu">
                <a class="nav-link  submenu-toggle <?php if($page == "Admin_employees-Details" || $page == "Admin_add-new-employees" ){echo "active";} ?> "
                    href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="<?php if($page == "Admin_employees-Details" || $page == "Admin_add-new-employees"  ){echo "true";} else {
                echo "flase"; 
             } ?>" aria-controls="submenu-2">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users-line"></i>
                    </div>
                    <span class="nav-link-text ms-1">Employees Section</span>
                </a>
                <div id="submenu-2"
                    class="collapse submenu submenu-2  <?php if($page == "Admin_employees-Details" || $page == "Admin_add-new-employees" ){echo "show";} ?>"
                    data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="submenu-item">
                            <a class="submenu-link <?php if($page == "Admin_employees-Details"  ){echo "active";} ?>"
                                href="employees.php">Employees</a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link  <?php if($page == "Admin_add-new-employees"  ){echo "active";} ?>"
                                href="add-employees.php">Add New Employee</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link  submenu-toggle <?php if($page == "Admin_Contact-details" ){echo "active";} ?>"
                  href="#" data-bs-toggle="collapse" data-bs-target="#submenu-3"
                    aria-expanded="<?php if($page == "Admin_Contact-details"){echo "true";} else { echo "flase"; } ?>"
                    aria-controls="submenu-3">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-message"></i>
                    </div>
                    <span class="nav-link-text ms-1">Contact Management</span>
                </a>
                <div id="submenu-3"
                    class="collapse submenu submenu-3 <?php if($page == "Admin_Contact-details" ){echo "show";} ?>"
                    data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="submenu-item"><a
                                class="submenu-link <?php if($page == "Admin_Contact-details"){echo "active";} ?>"
                                href="contact-details.php">Contact Details</a>
                        </li>
                    </ul>
                </div>
            </li>

       

            <li class="nav-item has-submenu">
                <a class="nav-link  submenu-toggle <?php if($page == "Admin_Email-group" ){echo "active";} ?>"
                    href="my-guest-post.php" href="#" data-bs-toggle="collapse" data-bs-target="#marketing-menu"
                    aria-expanded="<?php if($page == "Admin_Email-group"){echo "true";} else { echo "flase"; } ?>"
                    aria-controls="marketing-menu">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-cart-arrow-down"></i>
                    </div>
                    <span class="nav-link-text ms-1">Markerting Tools</span>
                </a>
                <div id="marketing-menu"
                    class="collapse submenu marketing-menu <?php if($page == "Admin_Email-group" ){echo "show";} ?>"
                    data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="submenu-item"><a
                                class="submenu-link <?php if($page == "Admin_Email-group"){echo "active";} ?>"
                                href="email-group.php">E-mail Group</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link  submenu-toggle <?php if($page == "Admin_User" || $page == "Admin_Database-backup" ){echo "active";} ?>"
                    href="my-guest-post.php" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-5"
                    aria-expanded="<?php if($page == "Admin_User" || $page == "Admin_Database-backup"  ){echo "true";} else {
                echo "flase"; 
             } ?>" aria-controls="submenu-5">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <span class="nav-link-text ms-1">Setup Tools</span>
                </a>
                <div id="submenu-5"
                    class="collapse submenu submenu-5 <?php if($page == "Admin_User" || $page == "Admin_Database-backup" ){echo "show";} ?>"
                    data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="submenu-item"><a
                                class="submenu-link <?php if($page == "Admin_User"  ){echo "active";} ?>"
                                href="admin-user.php">Admin Users</a></li>
                        <li class="submenu-item"><a
                                class="submenu-link <?php if($page == "Admin_Database-backup"  ){echo "active";} ?>"
                                href="database-backup.php">Database Backup</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link  submenu-toggle <?php if($page == "Admin_customer" || $page == "Admin_Customer-Type" ){echo "active";} ?> "
                    href="#" data-bs-toggle="collapse" data-bs-target="#submenu-6" aria-expanded="<?php if($page == "Admin_customer" || $page == "Admin_Customer-Type"  ){echo "true";} else {
                echo "flase"; 
             } ?>" aria-controls="submenu-6">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Management</span>
                </a>
                <div id="submenu-6"
                    class="collapse submenu submenu-6  <?php if($page == "Admin_customer" || $page == "Admin_Customer-Type" ){echo "show";} ?>"
                    data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="submenu-item">
                            <a class="submenu-link  <?php if($page == "Admin_customer"  ){echo "active";} ?>"
                                href="customer.php">Customer</a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link <?php if($page == "Admin_Customer-Type"  ){echo "active";} ?>"
                                href="customer-type.php">Customer Type</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item has-submenu">
                <a class="nav-link  submenu-toggle <?php if($page == "Admin_careers-application" || $page == "add-new-vacancy" ){echo "active";} ?> "
                    href="#" data-bs-toggle="collapse" data-bs-target="#submenu-7" aria-expanded="<?php if($page == "Admin_careers-application" || $page == "add-new-vacancy"  ){echo "true";} else {
                echo "flase"; 
             } ?>" aria-controls="submenu-7">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user-graduate"></i>
                        <!-- <i class="fa-solid fa-address-card"></i> -->
                    </div>
                    <span class="nav-link-text ms-1">Careers</span>
                </a>
                <div id="submenu-7"
                    class="collapse submenu submenu-7  <?php if($page == "Admin_careers-application" || $page == "add-new-vacancy" ){echo "show";} ?>"
                    data-bs-parent="#menu-accordion">
                    <ul class="submenu-list list-unstyled">
                        <li class="submenu-item">
                            <a class="submenu-link  <?php if($page == "Admin_careers-application"  ){echo "active";} ?>"
                                href="careers-applicaion.php">Application</a>
                        </li>
                        <li class="submenu-item">
                            <a class="submenu-link <?php if($page == "add-new-vacancy"  ){echo "active";} ?>"
                                href="add-new-vacancy.php">Add New Vacancy</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page == 'Admin_tables' ? 'active' : ''; ?>" href="tables.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-table"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $page == 'Admin_billing' ? 'active' : ''; ?>" href="billing.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <span class="nav-link-text ms-1">Billing</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $page == 'Admin_profile' ? 'active' : ''; ?>" href="profile.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign In</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="sign-up.php">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Up</span>
                </a>
            </li>
        </ul>
    </div>
</aside>