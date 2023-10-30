<div class="search">
    <form>
        <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
    </form>
    <a href="#" class="toggle-search"><i class="fa-solid fa-xmark"></i></a>
</div>
<div class="app-header">
    <nav class="navbar navbar-light navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-nav" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link hide-sidebar-toggle-button" href="#"><i
                                class="material-icons">first_page</i></a>
                        <!-- <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="fa-solid fa-circle-arrow-left"></i></a> -->
                    </li>

                </ul>

            </div>
            <div class="d-flex">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link toggle-search" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                    </li>
                    
                    <li class="nav-item hidden-on-mobile">
                        <a class="nav-link nav-notifications-toggle" id="notificationsDropDown" href="#"
                            data-bs-toggle="dropdown"><i class="fa fa-bell  cursor-pointer" aria-hidden="true"></i></a>
                        <div class="dropdown-menu dropdown-menu-end notifications-dropdown"
                            aria-labelledby="notificationsDropDown">
                            <h6 class="dropdown-header">Notifications</h6>
                            <div class="notifications-dropdown-list">
                                <a href="#">
                                    <div class="notifications-dropdown-item">
                                        <div class="notifications-dropdown-item-image">
                                            <span class="notifications-badge bg-info text-white">
                                                <i class="material-icons-outlined">campaign</i>
                                            </span>
                                        </div>
                                        <div class="notifications-dropdown-item-text">
                                            <p class="bold-notifications-text">Donec tempus nisi sed erat vestibulum, eu
                                                suscipit ex laoreet</p>
                                            <small>19:00</small>
                                        </div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notifications-dropdown-item">
                                        <div class="notifications-dropdown-item-image">
                                            <span class="notifications-badge bg-danger text-white">
                                                <i class="material-icons-outlined">bolt</i>
                                            </span>
                                        </div>
                                        <div class="notifications-dropdown-item-text">
                                            <p class="bold-notifications-text">Quisque ligula dui, tincidunt nec
                                                pharetra eu, fringilla quis mauris</p>
                                            <small>18:00</small>
                                        </div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notifications-dropdown-item">
                                        <div class="notifications-dropdown-item-image">
                                            <span class="notifications-badge bg-success text-white">
                                                <i class="material-icons-outlined">alternate_email</i>
                                            </span>
                                        </div>
                                        <div class="notifications-dropdown-item-text">
                                            <p>Nulla id libero mattis justo euismod congue in et metus</p>
                                            <small>yesterday</small>
                                        </div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notifications-dropdown-item">
                                        <div class="notifications-dropdown-item-image">
                                            <span class="notifications-badge">
                                                <img src="portal-assets/images/avatars/avatar.png" alt="">
                                            </span>
                                        </div>
                                        <div class="notifications-dropdown-item-text">
                                            <p>Praesent sodales lobortis velit ac pellentesque</p>
                                            <small>yesterday</small>
                                        </div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="notifications-dropdown-item">
                                        <div class="notifications-dropdown-item-image">
                                            <span class="notifications-badge">
                                                <img src="portal-assets/images/avatars/avatar.png" alt="">
                                            </span>
                                        </div>
                                        <div class="notifications-dropdown-item-text">
                                            <p>Praesent lacinia ante eget tristique mattis. Nam sollicitudin velit sit
                                                amet auctor porta</p>
                                            <small>yesterday</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item hidden-on-mobile">
                        <a class="nav-link language-dropdown-toggle" href="#" id="languageDropDown"
                            data-bs-toggle="dropdown">
                            <img class="rounded-circle" src="<?= URL ?>images/user/<?= $cusDtl[0][9] ?>" alt="<?= $cusDtl[0][9] ?>"/>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end language-dropdown"
                            aria-labelledby="languageDropDown">
                            <li><a class="dropdown-item" href="settings.php"><i class="fa fa-cog me-3" aria-hidden="true"></i>Settings</a></li>
                            <li><a class="dropdown-item" href="<?= URL.'logout.php'?>"><i class="fa-solid fa-power-off me-3"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>