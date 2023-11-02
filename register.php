<?php
session_start();

//include_once('checkSession.php');
require_once("includes/constant.inc.php");
require_once("includes/alert-constant.inc.php");

require_once("_config/dbconnect.php");

require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/customer.class.php");
require_once("classes/location.class.php");
require_once("classes/api.class.php");

require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");



/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$myError 		= new MyError();
$customer		= new Customer();
$Location       = new Location();
$API            = new API;
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId			= $utility->returnSess('userid', 0);
//$cusDtl			= $client->getClientData($cusId);

$allCountries = $Location->getCountriesList();


if(isset($_POST['btnSubmit'])){

	// $invalidEmail 	= $error->invalidEmail($txtEmail);

	// if(preg_match("/^ER/",$invalidEmail)){}

    // URL of the API endpoint
    $apiUrl = 'http://localhost/api/api/customer.php/';

     // Data to be sent in the POST request
     $postData = array(
        'firstName'     => $_POST['firstName'],
        'lastName'      => $_POST['lastName'],
        'email'         => $_POST['txtemail'],
        'password'      => $_POST['txtPassword'],
        'password_cnf'  => $_POST['txtPasswordConfirm'],
        'country'       => $_POST['txtCountry'],
        'profession'    => $_POST['txtProfession'],
        'added_on'      => '',
    );
   

    // Initialize cURL session
    $ch = curl_init($apiUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Output the response from the API
    $response =  json_decode($response);
    // print_r($response);
    if ($response->status == 201) {
        $_SESSION['newCustomerSess']    = $response->customer_id;
        $_SESSION['vkey']               = $response->verification_key;
        $_SESSION['email']              = $response->email;
        $_SESSION['fisrt-name']         = $response->fname;
        $_SESSION['last-name']          = $response->lname;

        header('location: register-email-inc.php');
        exit;
    }else {
        $error = $response->error;
    }


}//Register
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <?php include('head-section.php');?>
    <title>Register with Trustfully Platform | Register :: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="description"
        content="Client register for buy ready web products or guest post services Or Reseller can register for sell his/her web products or guest post services">
    <meta name="keywords" content="Web Design, Web Development, Apps Development, SEO Services, Guest Post Services, Domain name with Ready Website,
Ready website for business, High Quality website sales, High quality blogs sales, expired domain sales" />

    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/leelija.css">
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/register.css" rel='stylesheet' type='text/css' />
    <link href="css/form.css" rel='stylesheet' type='text/css' />
    <!-- font-awesome icons -->
    <!-- <link href="css/fontawesome-all.min.css" rel="stylesheet"> -->
    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <!--//webfonts-->

    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">
    <style>
    form .form-group label {
        padding-bottom: 0px;
        font-weight: 400;
        color: var(--black);
    }

    .form-group {
        padding-bottom: 0px;
    }
    </style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once 'partials/navbar.php'; ?>
        <!-- //header -->
        <!-- banner -->
        <div class="maincountainer d-flex  justify-content-center">
            <div id="main-wrapper" class="container my-3">
                <div class="row justify-content-center ">
                    <div class="col-xl-12">
                        <div class="card border-0" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                            <div class="card-body p-0">
                                <div class="row m-0 w-100 no-gutters ">
                                    <div class="col-lg-5 p-0 d-none d-lg-inline-block m-auto text-center">
                                        <div class=" m-auto text-center">
                                            <img class="w-100 " src="./images/main/register-image.webp">
                                        </div>
                                    </div>
                                    <div class="col-lg-7 m-auto p-0">
                                        <div class="reg-div-below-card ">
                                            <div class="mb-3 mt-2">
                                                <h3 class="h4 font-weight-bold text-theme reg-heading">
                                                    Join With Leelija</h3>
                                            </div>
                                            <?php if (isset($error)): ?>
                                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                                    aria-label="Warning:">
                                                    <use xlink:href="#exclamation-triangle-fill" />
                                                </svg>
                                                <div>
                                                    <?= $error ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="section group">
                                                <div class="bfrom">
                                                    <form class="form-horizontal-login needs-validation" role="form"
                                                        action="<?php echo $_SERVER['PHP_SELF'] ?>" name="regUserForm"
                                                        method="post" enctype="multipart/form-data" autocomplete="off"
                                                        id="regUserForm" novalidate>
                                                        <div class="row">
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="form-group">
                                                                    <label class="required-field" for="firstname">First
                                                                        Name</label>
                                                                    <input type="text" placeholder="firstname"
                                                                        minlength="3" id="firstName" name="firstName"
                                                                        class="form-control" required>
                                                                    <div class="invalid-feedback">
                                                                        Please Enter your first Name!
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 mb-2">
                                                                <div class="form-group">
                                                                    <label for="lastName">Last Name</label>
                                                                    <input type="text" placeholder="lastname"
                                                                        minlength="3" id="lastName" name="lastName"
                                                                        class="form-control" required>
                                                                    <div class="invalid-feedback">
                                                                        Please Enter your last Name!
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 mb-2">
                                                                <div class="form-group">
                                                                    <label for="floatingInput"> Contact Number </label>
                                                                    <input type="text"
                                                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        minlength="10" pattern="[0-9]+" maxlength="10"
                                                                        class="form-control" id="mobNumber"
                                                                        placeholder="0123456789" name="mobNumber"
                                                                        required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter your contact number!
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 mb-2">
                                                                <div class="form-group">
                                                                    <label class="required-field">Email</label>
                                                                    <input type="email" id="txtemail" name="txtemail"
                                                                        placeholder="example@email.com"
                                                                        inputmode="email"
                                                                        pattern="[^@\s]+@[^@\s]+\.[^@\s]+"
                                                                        autofill="off" autocomplete="false"
                                                                        class="form-control" required>
                                                                    <div class="invalid-feedback">
                                                                        Please enter your email!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="form-group">
                                                                    <label for="profession">Profession</label>
                                                                    <select class="form-select" name="txtProfession"
                                                                        id="txtProfession" required>
                                                                        <option value="" selected="selected">Select
                                                                            Profession</option>
                                                                        <option value="Author">Author</option>
                                                                        <option value="Blogger">Blogger</option>
                                                                        <option value="Blogger">Blogger Outreach Manager
                                                                        </option>
                                                                        <option value="Business Analyser">Business
                                                                            Analyser
                                                                        </option>
                                                                        <option value="Marketing Manager">Marketing
                                                                            Manager
                                                                        </option>
                                                                        <option value="Web Developer">Web Developer
                                                                        </option>
                                                                        <option value="Others">Others</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please choose a profession!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="form-group">
                                                                    <label for="floatingSelect">Country</label>
                                                                    <select class="form-select" id="selectCountry"
                                                                        name="txtCountry" required>
                                                                        <option value="" selected="selected">Select
                                                                            Country</option>
                                                                        <?php
                                                                        foreach ($allCountries as $country) {
                                                                            echo "<option value='$country->id'>$country->name</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please choose a country!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="form-group">
                                                                    <label class="required-field">Password </label>
                                                                    <input type="password" minlength="8"
                                                                        id="txtPassword" name="txtPassword"
                                                                        placeholder="(username)123"
                                                                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                                        autocomplete="new-password"
                                                                        class="form-control custm_pv" required>
                                                                    <div class="invalid-feedback">
                                                                        Must be a combination of
                                                                        (A-Z),(a-z),(0-9),(!@#$%^&*=+-_) and >8
                                                                        characters long!
                                                                    </div>
                                                                    <div class="valid-feedback">
                                                                        Strong password!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="form-group">
                                                                    <label class="required-field">Confirm
                                                                        Password</label>
                                                                    <div class="input-group ">
                                                                        <input type="password" id="txtPasswordConfirm"
                                                                            name="txtPasswordConfirm" minlength="8"
                                                                            placeholder="Confirm Password"
                                                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                                            class="form-control " required>
                                                                        <button class="btn" type="button"><i
                                                                                class="fas fa-eye-slash show"></i></button>

                                                                    </div>
                                                                    <div class="form-text confirm-message"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col-sm-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="gridCheck1" required>
                                                                    <label class="form-check-label" for="gridCheck1">
                                                                        I Agree with the <a class="term-n-policy"
                                                                            href="">Terms
                                                                            of service</a>
                                                                        and <a class="term-n-policy" href="">Privacy
                                                                            Policy</a> .
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 mb-2 submit-divclass  text-center">
                                                            <a href="/"><button class="my-buttons-hover bn21"
                                                                    type="submit" id="userRegisterBtn"
                                                                    name="btnSubmit"><i
                                                                        class="fas fa-sign-in-alt pr-2"></i>
                                                                    Register</button></a>
                                                        </div>
                                                        <div class=" sign-up-btn pr-3 text-right">
                                                            <span>Already have an account?</span>
                                                            <a href="login.php"> Sign in Now</a>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                            <!-- section group -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once 'partials/footer.php'; ?>
        <script src="plugins/jquery-3.6.0.min.js"></script>
        <script src="js/jquery-2.2.3.min.js"></script>
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

    </div>
    <!-- js-->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
    <script src="plugins/jquery-3.6.0.min.js"></script>
    <script>
    const createPw = document.querySelector("#txtPassword"),
        confirmPw = document.querySelector("#txtPasswordConfirm"),
        pwShow = document.querySelector(".show");
    pwShow.addEventListener("click", () => {
        if ((createPw.type === "password") && (confirmPw.type === "password")) {
            createPw.type = "text";
            confirmPw.type = "text";
            pwShow.classList.replace("fa-eye-slash", "fa-eye");
        } else {
            createPw.type = "password";
            confirmPw.type = "password";
            pwShow.classList.replace("fa-eye", "fa-eye-slash");
        }
    });
    </script>
</body>

</html>