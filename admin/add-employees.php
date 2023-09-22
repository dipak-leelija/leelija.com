<?php
$page = "Admin_add-new-employees";
require_once dirname(__DIR__) ."/includes/constant.inc.php";
require_once 'incs/global-inc.php';

$Utility->setCurrentPageSession();

if(isset($_GET['action']) && isset($_GET['msg'])){
    $_GET['action'] == 'SUCCESS' ? $alertClasse = 'alert-primary' : $alertClasse = 'alert-warning';
    $msg = $_GET['msg'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Leelija - Add New Employees </title>
    <?php require_once ADM_DIR."incs/common-html-header.php"?>
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/img-uv/img-uv.css">
</head>
<style>
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
                            <?php if (isset($msg)) { ?>
                            <div class="alert <?= $alertClasse ?> alert-dismissible fade show" role="alert">
                                <strong><?= $msg ?></strong>
                                <button type="button" class="btn-close btn-dark" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php } ?>
                            <form action="ajax/employee-add.ajax.php" method="post"
                                class="row w-100 m-0 bg-white text-dark rounded needs-validation"
                                enctype="multipart/form-data" novalidate>
                                <div class="row w-100 m-0 mb-2">
                                    <div class="col-6 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width: 130px;">
                                            <div class="d-flex justify-content-center align-items-center rounded"
                                                style="height: 130px; background-color: rgb(233, 236, 239);">
                                                <img class="img-uv-view" src="<?= IMG_PATH ?>default-icons/default-emp.png">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex align-items-center">
                                        <div class="input-group mt-2">
                                            <input type="file" class="d-none" id="img-uv-input"
                                                name="profile-picture" accept="image/*">
                                            <label class="input-group-text btn btn-primary rounded" for="img-uv-input">
                                                <i class="fa fa-fw fa-camera pe-2"></i>
                                                Recent Photo
                                            </label>
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
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="flexRadioDefault1" value="male" required>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="flexRadioDefault2" value="male">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Female
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    id="flexRadioDefault3" value="male">
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                    Transgender
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row w-100 m-0 mb-2">
                                    <div class="col-6 ">
                                        <label for="designation" class="form-label">Designation</label>
                                        <select class="form-select" name="designation" id="designation">
                                            <option value="" disabled selected>Select</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Human Resource">Human Resource</option>
                                            <option value="SEO Specialist">SEO Specialist</option>
                                            <option value="Content Writer">Content Writer</option>
                                            <option value="Full Stack Web Developer">Full Stack Web Developer</option>
                                            <option value="Frontent Developer">Frontent Developer</option>
                                            <option value="Backend Developer">Backend Developer</option>
                                            <option value="WordPress Developer">WordPress Developer</option>
                                        </select>
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
                                        <input type="password" minlength="8" id="txtPassword" name="password"
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
                                        <input type="password" id="txtPasswordConfirm" name="confirmPassword"
                                            minlength="8" placeholder="Confirm Password"
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                            class="form-control " required>
                                        <div class="form-text confirm-message"></div>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4 ">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once ADM_DIR.'partials/bar-setting.php'; ?>
    <!--   Core JS Files   -->
    <script src="../plugins/jquery-3.6.0.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../plugins/data-table/simple-datatables.js"></script>
    <script src="../plugins/tinymce/tinymce.js"></script>
    <script src="../plugins/main.js"></script>
    <script src="<?=URL?>assets/vendors/img-uv/img-uv.js"></script>
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
    <script src="assets/js/soft-ui-dashboard.min.js"></script>

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
</body>

</html>