<nav class="navbar navbar-expand-lg navbar-dark text-light">

    <div class="container-fluid">
        <a class="navbar-brand d-flex" href="<?php echo URL;?>">
            <img src="<?php echo LOGO_WITH_PATH; ?>" alt="logo" class="pe-md-4">
            <div class="text-center emailstyle  m-auto ps-4 ">
                <?php
                $cusDtl			= $customer->getCustomerData($cusId); 

                if($cusId != 0){
                    echo "Hi, {$cusDtl[0][5]}";
                }else {
                    echo 'info@leelija.com';
                }
                ?>
            </div>
        </a>
        <div class="right_mbl text-end">
            <?php
            if($cusId == 0){
            ?>
            <a href="<?php echo URL;?>login.php" class="btn login-btn mobile_login_btn">
                <i class="pe-2 fa-solid fa-right-to-bracket"></i>Login
            </a>
            <?php
            }else {
            ?>
            <li class="nav-item dropdown dashboaard_button mobile_login_btn">
                <button class=" dropdown  login-btn external-styling">
                    My Account
                    <i class="bi bi-chevron-down"></i>
                </button>
                <ul class="dropdown-menu  external-drop-menu">
                    <li>
                        <a href="<?= URL;?>dashboard.php" class="dropdown-item  external-lis">
                            <i class="fa fa-home pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item external-lis" href="<?= URL;?>logout.php">
                            <i class="fa-solid fa-arrow-right-from-bracket pe-2"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
            <?php
            }
            ?>



            <!-- mobile-menu -->
            <button id="navbar-toggler" class="navbar-toggler mobile-menu border-0 shadow-none" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav  ms-auto mb-2 mb-lg-0 ">
                <li class="nav-item ">
                    <a class="nav-link  li-style" aria-current="page" href="<?= URL;?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link li-style" href="<?= URL;?>about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link li-style" href="<?= URL;?>services.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link li-style" href="<?= URL;?>domains.php">Marketplace</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link li-style" href="contact.php">Contact</a>
                </li>
                <li class="nav-item pe-4">
                    <a class="nav-link li-style" href="<?php echo URL;?>blog/">Blog</a>
                </li>
            </ul>
            <?php
            if($cusId == 0){
            ?>
            <!-- btn-contact -->
            <a class="login-btn desktop-login-btn" href="<?= URL;?>login.php"><i
                    class="pe-1 fa-solid fa-arrow-right-to-bracket"></i>Login</a>
            <?php
            }else {
            ?>

            <li class="nav-item dropdown dashboaard_button desktop-login-btn">
                <button class=" dropdown  login-btn external-styling ">My Account <i class="bi bi-chevron-down"></i>
                </button>
                <ul class="dropdown-menu external-drop-menu">
                    <li> <a href="<?= SELLER_AREA;?>" class="dropdown-item  external-lis"><i
                                class="fa fa-home pe-2"></i>Dashboard</a>
                    </li>
                    <li><a class="dropdown-item  external-lis" href="<?= URL;?>logout.php"><i
                                class="fa-solid fa-arrow-right-from-bracket pe-2"></i>Logout</a></li>
                </ul>
            </li>
            <?php
            }
            ?>
        </div>
    </div>
</nav>