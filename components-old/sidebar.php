<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= SELLER_URL?>">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= SELLER_URL?>order.php">
            <i class="fas fa-cart-arrow-down mr-3"></i>
                <span class="menu-title">Order</span>
            </a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link" href="<?= SELLER_URL?>myblogs.php">
            <i class="fa fa-globe mr-3" aria-hidden="true"></i>
                <span class="menu-title">Web Products Or Blogs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= SELLER_URL?>add-domain.php">
            <i class="fa fa-plus mr-3" aria-hidden="true"></i>
                <span class="menu-title">Sell Products or Blogs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= SELLER_URL?>notification.php">
            <i class="fa fa-user mr-3" aria-hidden="true"></i>
                <span class="menu-title">Notification</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= SELLER_URL?>setting.php">
            <i class="fa fa-cog mr-3" aria-hidden="true"></i>
                <span class="menu-title">Setting</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="buttons.php">Buttons</a></li>
                    <li class="nav-item"> <a class="nav-link" href="dropdowns.php">Dropdowns</a></li>
                    <li class="nav-item"> <a class="nav-link" href="typography.php">Typography</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Form elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="basic_elements.php">Basic Elements</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">Tables</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="basic-table.php">Basic table</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Icons</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="mdi.php">Mdi icons</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>