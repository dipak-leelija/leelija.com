<?php
require_once dirname(__DIR__) ."/includes/constant.inc.php";
$page = "Admin_signup";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/logo/favicon.png" type="image/png">
    <title> Leelija - Sign Up Page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="../plugins/fontawesome-6.1.1/css/all.css" rel="stylesheet" type="text/css">
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="">
    <main class="main-content  mt-0">
        <section class="d-flex align-items-center justify-content-center min-vh-100">
            <div class="container">
                <div class="row ">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0 my-3"
                            style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
                            <div class="card-header text-center pt-4 pb-0">
                                <h5>Register Form</h5>
                            </div>

                            <div class="card-body">
                                <form role="form text-left" class="needs-validation" novalidate>
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" minlength="5" class="form-control" placeholder="Name"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" class="form-control"
                                            placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="newPassword" class="form-label"> Password</label>
                                        <input type="password" minlength="8" id="newPassword" name="newPassword"
                                            placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                            autocomplete="new-password" class="form-control custm_pv" required>
                                        <div class="invalid-feedback">
                                            Must be a combination of
                                            (A-Z),(a-z),(0-9),(!@#$%^&*=+-_) and >8
                                            characters long!
                                        </div>
                                        <div class="valid-feedback">
                                            Strong password!
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                        <div class="input-group ">
                                            <input type="password" id="confirmPassword" name="confirmPassword"
                                                minlength="8" placeholder="Confirm Password"
                                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control "
                                                required>
                                            <button class="btn custom-toggle-icon" type="button"><i
                                                    class="fas fa-eye-slash custm-confirm "
                                                    id="toggle-show"></i></button>

                                        </div>
                                        <div class="form-text confirm-message"></div>
                                    </div>
                                    <div class="form-check form-check-info text-left">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                            required>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree the <a href="javascript:;"
                                                class="text-dark font-weight-bolder">Terms and Conditions</a>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign
                                            up</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Already have an account? <a href="login.php"
                                            class="text-dark font-weight-bolder">Sign in</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="../plugins/jquery-3.6.0.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>
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
    <!-- ---------------------------------------------- -->
    <!-- for new and confirm password view icon hideshow -->
    <!-- ------------------------------------------- -->
    <script>
    const createPw = document.querySelector("#newPassword"),
        confirmPw = document.querySelector("#confirmPassword"),
        pwShow = document.querySelector("#toggle-show");
    showHidePassword = () => {
        if ((createPw.type === "password") && (confirmPw.type === "password")) {
            createPw.type = "text";
            confirmPw.type = "text";
            pwShow.classList.replace("fa-eye-slash", "fa-eye");
        } else {
            createPw.type = "password";
            confirmPw.type = "password";
            pwShow.classList.replace("fa-eye", "fa-eye-slash");
        }
    };
    pwShow.addEventListener('click', showHidePassword);
    </script>
    <!-- ---------------------------------------------- -->
    <!-- for new and confirm password view icon hideshow end -->
    <!-- ------------------------------------------- -->
    <!-- ------------------------------------- -->
    <!-- funtion for password validation -->
    <!-- ------------------------------------- -->
    <script>
    $('#newPassword, #confirmPassword').on('keyup', function() {
        'use strict'
        $('.confirm-message').removeClass('success-message').removeClass('error-message');
        let password = $('#newPassword').val();
        let confirm_password = $('#confirmPassword').val();
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
    <!-- ------------------------------------- -->
    <!-- funtion for password validation end -->
    <!-- ------------------------------------- -->

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>