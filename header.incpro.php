<section class="main-header">
    <div class="header-top text-md-left text-center">
        <div class="container">
            <div class="d-md-flex align-items-center justify-content-between">
                <p class="text-capitalize dark-blue-color">
                    ISO 9001:2015 certified
                </p><a href="http://api.whatsapp.com/send?phone=917003451378" target="_blank"><img
                        src="../../images/icons/whatsapp.png" style="height:31px"><span
                        style="color:#0673BA;position:relative;padding-left:5px">we are always there</span> </a>
                <ul class="social-iconsv2 agileinfo mt-md-0 mt-2">
                    <li>
                        <a class="dark-blue-color" href="mailto:info@leelija.com"><img
                                src="../../images/icons/gmail.png" style="height:25px;position:relative;top:-2.5px">
                            info@leelija.com
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/leelijaweb/" target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/lee_lija" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/leelija" target="_blank">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://in.pinterest.com/leelijaa/" target="_blank">
                            <i class="fab fa-pinterest-p"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.leelija.com/viewcart.php">
                            <!-- <i class="fab cart-icon"> <img src="images/icons/shopping-cart.png" class="shopping-cart"></i> -->
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div> <!-- /header-top-->
    <header class="main-header main_header_section">
        <nav class="navbar second navbar-expand-lg navbar-light pagescrollfix">
            <div class="container-fluid">
                <h1 class="d-inline"> <a class="navbar-brand" href="/"> <img src="../../images/logo/logo.png"
                            class="LeeLija" alt="LeeLija"> </a> </h1> <button class="navbar-toggler" type="button"
                    data-toggle="collapse" data-target=".navbar-toggle" aria-controls="navbarNavAltMarkup1"
                    aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse navbar-toggle" id="navbarNavAltMarkup1">
                    <div class="navbar-nav secondfix ml-lg-auto">
                        <ul class="navbar-nav text-left">
                            <li class="nav-item active  mr-3"> <a class="nav-link" href="/">Home <span
                                        class="sr-only">(current)</span> </a> </li>
                            <li class="nav-item  mr-3"> <a class="nav-link " href="../../about.php">about</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="../../services.php">services</a> </li>
                            <li class="nav-item dropdown mr-3"> <a class="nav-link dropdown-toggle" href="#"
                                    id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"> Products </a>
                                <div class="dropdown-menu text-lg-left text-center" aria-labelledby="navbarDropdown"> <a
                                        class="dropdown-item nav-link" href="../../domains.php">Blogs & Websites</a> <a
                                        class="dropdown-item nav-link" href="../../guest-posting.php">Guest Posting </a>
                                    <div class="dropdown-divider"></div> <a class="dropdown-item nav-link"
                                        href="#testi">Tools</a>
                                </div>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="../../contact.php">contact</a> </li>
                            <li class="nav-item  mr-3"> <a class="nav-link" href="../..start-selling.php">Become a
                                    Seller</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="../../blog">Blog</a> </li>
                            <?php if($cusId == 0){ ?> <li class="nav-item"><a class="nav-link"
                                    href="../../login.php">Sign In</a></li> <?php }									else {?> <li
                                class="nav-item dropdown mr-3"> <a class="nav-link dropdown-toggle"
                                    href="../../dashboard.php" id="navbarDropdown" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"> My Account </a>
                                <div class="dropdown-menu text-lg-left text-center" aria-labelledby="navbarDropdown"> <a
                                        class="dropdown-item nav-link" href="../../dashboard.php">Dashboard</a> <a
                                        class="dropdown-item nav-link" href="../../edit-profile.php">Edit Profile</a>
                                    <div class="dropdown-divider"></div> <a class="dropdown-item nav-link"
                                        href="../../change-password.php">Change Password</a>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="../../logout.php">Log Out</a></li> <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</section>