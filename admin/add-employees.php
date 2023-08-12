<?php
require_once dirname(__DIR__) ."/includes/constant.inc.php";
$page = "Admin_add-new-employees";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/logo/favicon.png" type="image/png">
    <title> Leelija - Add New Employees </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="assets/css/soft-ui-dashboard.css.map" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <link rel="stylesheet" href="../plugins/data-table/style.css">
    <!-- <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script> -->
</head>
<style>
.editingimg {
    width: 100%;
    border-radius: 13px !important;
    height: 100%;
    border: 1px solid lightgray;
}

.error-message {
    color: #fd5c70 !important;
}

.success-message {
    color: #66d432 !important;
}
</style>

<body class="g-sidenav-show  bg-gray-100">
    <?php require_once "partials/sidebar.php"; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card employee-card">
                        <div class="card-body ">
                            <form action="" method="post"
                                class="row w-100 m-0 bg-white text-dark rounded needs-validation" novalidate>
                                <div class="row w-100 m-0 mb-2">
                                    <div class="col-6 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width: 130px;">
                                            <div class="d-flex justify-content-center align-items-center rounded"
                                                style="height: 130px; background-color: rgb(233, 236, 239);">
                                                <img class="profile-pic rounded editingimg" src="../images/emps/2.jpg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex align-items-center">
                                        <div class="input-group mt-2">
                                            <input type="file" class="form-control file-upload d-none" id="img-select"
                                                name="profile-picture" id="fileImg" accept="image/*">
                                            <label class="input-group-text btn btn-primary rounded" for="img-select">
                                                <i class="fa fa-fw fa-camera pe-2"></i>
                                                Recent Photo
                                            </label>

                                            <!-- <button id="upload-btn" type="submit" name="picture-update"
                                            class="input-group-text btn btn-info rounded text-light fw-semibold ms-2 d-none">
                                            <i class="fa-solid fa-arrow-up-from-bracket pe-1"></i>
                                            Upload
                                        </button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row w-100 m-0 mb-2">
                                    <div class="col-12 ">
                                        <label for="fullname" class="form-label">Full Name</label>
                                        <input type="text" name="fullname" minlength="6" class="form-control "
                                            id="fullname" placeholder="Full Name" required>
                                    </div>
                                </div>
                                <div class="row w-100 m-0 mb-2">
                                    <div class="col-6 ">
                                        <label for="email" class="form-label">Email Id</label>
                                        <input type="email" inputmode="email"
                                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control"
                                            id="email" name="email" placeholder="Your mail address" required="">
                                    </div>
                                    <div class="col-6">
                                        <label for="contact" class="form-label">Contact Number</label>
                                        <input type="text"
                                            onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                            minlength="10" pattern="[0-9]+" maxlength="10" class="form-control"
                                            id="phone" name="phone" placeholder="0123456789" required="">
                                    </div>
                                </div>
                                <div class="row w-100 m-0 mb-2">
                                    <div class="col-6"> <label for="dob" class="form-label">DOB</label>
                                        <input type="date" class="form-control" name="joinin_date" required="">
                                    </div>
                                    <div class="col-6 ">
                                        <label for="" class="form-label">Gender</label>
                                        <div class="d-flex align-item-center justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault1" required>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Female
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault3">
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                    Transgender
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row w-100 m-0 mb-2">
                                    <div class="col-6 ">
                                        <label for="qualification" class="form-label">Qualification</label>
                                        <input type="text" name="qualification" minlength="4" class="form-control "
                                            id="qualification" placeholder="Qualification" required>
                                    </div>
                                    <div class="col-6 ">
                                        <label for="experience" class="form-label">Experience</label>
                                        <input type="text" name="experience" minlength="3" class="form-control "
                                            id="experience" placeholder="Experience" required>
                                    </div>
                                </div>
                                <div class="row w-100 m-0 mb-2">
                                    <div class="col-12 ">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" minlength="6" maxlength="355"
                                            style="height: 70px" name="address" required="" placeholder="Address"
                                            required></textarea>
                                    </div>
                                </div>

                                <div class="row w-100 m-0 mb-2">
                                    <div class="col-6 ">
                                        <label for="text" class="form-label">Password</label>
                                        <input type="password" minlength="8" id="txtPassword" name="txtPassword"
                                            placeholder="Password"
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                            autocomplete="new-password" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Must be a combination of
                                            (A-Z),(a-z),(0-9),(!@#$%^&*=+-_) and >8
                                            characters long!
                                        </div>
                                        <div class="valid-feedback">
                                            Strong password!
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="text" class="form-label">Confirm Password</label>
                                        <input type="password" id="txtPasswordConfirm" name="txtPasswordConfirm"
                                            minlength="8" placeholder="Confirm Password"
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                            class="form-control " required>
                                        <div class="form-text confirm-message"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4 ">
                                    <button name="btnAddfaqs" type="submit" class="btn btn-primary">Submit</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
        <div class="card shadow-lg ">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent"
                        onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                </div>
                <div class="form-check form-switch ps-0">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                        onclick="navbarFixed(this)">
                </div>
                <hr class="horizontal dark my-sm-4">
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../plugins/jquery-3.6.0.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../plugins/data-table/simple-datatables.js"></script>
    <script src="../plugins/tinymce/tinymce.js"></script>
    <script src="../plugins/main.js"></script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>

    <script>
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>
    <script>
    $('#txtPassword, #txtPasswordConfirm').on('keyup', function() {
        'use strict'
        $('.confirm-message').removeClass('success-message').removeClass('error-message');
        let password = $('#txtPassword').val();
        let confirm_password = $('#txtPasswordConfirm').val();
        if (password === "") {
            $('.confirm-message').text("Password Field cannot be empty!").addClass('error-message');
        } else if (confirm_password === "") {
            $('.confirm-message').text("Confirm Password Field cannot be empty!").addClass('error-message');
        } else if (confirm_password === password) {
            $('.confirm-message').text('Password Match!').addClass('success-message');
        } else {
            $('.confirm-message').text("Password Doesn't Match!").addClass('error-message');
            // $('#txtPasswordConfirm').addClass('is-invalid');
        }
    });

    </script>
    
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        var readURL = (input) => {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = (e) => {
                    document.querySelector(".profile-pic").src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
                document.querySelector("#upload-btn").classList.remove("d-none");
            }
        };
        document.querySelector("#img-select").addEventListener("change", function() {
            readURL(this);
        });
    });
    </script>
</body>

</html>