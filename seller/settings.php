<?php
session_start();
$page = "Admin_settings";
require_once dirname(__DIR__)."/includes/constant.inc.php";
require_once dirname(__DIR__)."/includes/alert-constant.inc.php";

require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR. "classes/date.class.php";
require_once ROOT_DIR. "classes/error.class.php";
require_once ROOT_DIR. "classes/search.class.php";
require_once ROOT_DIR. "classes/customer.class.php";
require_once ROOT_DIR. "classes/login.class.php";
require_once ROOT_DIR. "classes/location.class.php";

require_once ROOT_DIR. "classes/utility.class.php";
require_once ROOT_DIR. "classes/utilityMesg.class.php";
require_once ROOT_DIR. "classes/utilityImage.class.php";


/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$Location       = new Location;
//$ff				= new FrontPhoto();
// $blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
######################################################################################################################

$currentURL = $utility->currentUrl();

require_once 'seller-session.inc.php';


//Edit Profile
if(isset($_POST['btnSubmit'])){

    $fName          = $_POST['fname'];
    $lName          = $_POST['lname'];
    $gender         = $_POST['gender'];
	$profession		= $_POST['txtProfession'];
	$desc			= $_POST['txtDesc'];
	$brief       	= $_POST['brief'];
	$organization	= $_POST['organization'];
    
	$mobNumber      	= $_POST['mob_no'];

	//registering the post session variables
	$sess_arr	= array( 'txtProfession', 'txtDesc');

    $customer->editCustomerSingleData($cusId, 'mobile', $mobNumber, 'customer_address');

	$customer->editCustomer($cusId, $fName, $lName, $gender, $brief, $desc, $organization, $userFeatured, $profession, $userSortOrder, $userAccVerified, $userDiscountOffered);

	$utility->delSessArr($sess_arr);

    $uMesg->showSuccessT('success', 0, '', 'settings.php', SUU007, 'SUCCESS'); //SUCUST201,

}


//Edit Address
if(isset($_POST['addressUpdate'])){

    $address1       = $_POST['address1'];
    $address2       = $_POST['address2'];
    $cityId         = $_POST['cityId'];
	$stateId       	= $_POST['stateId'];
	$postalCode	    = $_POST['postal_code'];
	$countryId		= $_POST['countryId'];
	$phone1	        = $_POST['phone1'];
	$phone2      	= $_POST['phone2'];
	$userFax      	= $_POST['userfax'];

	$customer->updateCusAddress($cusId, $address1, $address2, $userAddress3, $cityId, $stateId, $postalCode, $countryId, $phone1, $phone2, $userFax, $userMobile);
    $uMesg->showSuccessT('success', 0, '', 'settings.php', SUU010, 'SUCCESS'); //SUCUST201,

}


//Change Password
if (isset($_POST['currentPassword'])  && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {

    $oldPass = $_POST['currentPassword'];
    $newPass = $_POST['newPassword'];
    $cnfPass = $_POST['confirmPassword'];

    $msg = $customer->editPassword($oldPass, $newPass, $cnfPass, $cusId);
    // print_r($_POST);exit;
}


if(isset($_POST['btnCancel'])){
	//forward
	$uMesg->showSuccessT('success', $id, 'id', "settings.php", "", 'Cancel');
}

if (isset($_GET['typeM'])) {
    if ($_GET['typeM'] == 'SUCCESS') {
        $color ='primary';
        $type   = 'Success!';
    }else {
        $color ='danger';
        $type   = 'Sorry!';
    }
}
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}


$userCity       = $Location->getCityName($userCityId);
$userState      = $Location->getStateName($userStateId);
$userCountry    = $Location->getCountryName($userCountryId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">


    <!-- Title -->
    <title><?php echo COMPANY_FULL_NAME; ?>: Settings</title>
    <link rel="shortcut icon" href="<?= FAVCON_PATH ?>" />

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/fontawesome-6.1.1/css/all.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/highlight/styles/github-gist.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/fontawesome-6.1.1/css/all.min.css" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="<?= URL ?>assets/portal-assets/css/main.min.css" rel="stylesheet">
    <style>
    .error-message {
        color: red !important;
    }

    .success-message {
        color: green !important;
    }

    .custm-confirm {
        color: #a6a6a6;
        transition: all 0.3s ease;
        margin: 0 !important;
        font-size: 16px !important;
    }
    </style>
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <?php require_once ROOT_DIR."components/sidebar.php"; ?>
        <!-- sidebar ends -->
        <div class="app-container">
            <!-- navbar header starts -->
            <?php require_once ROOT_DIR."components/navbar.php"; ?>
            <!-- navbar header ends -->
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card page-description page-description-tabbed">
                                    <?php if (isset($msg)) { ?>
                                    <div class="alert alert-<?= $color ?> alert-dismissible fade show" role="alert">
                                        <strong><?= $type ?></strong> <?= $msg ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php }?>

                                    <ul class="nav nav-tabs mb-3 mt-0" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab"
                                                data-bs-target="#overview" type="button" role="tab"
                                                aria-controls="overview" aria-selected="false">Overview</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link " id="account-tab" data-bs-toggle="tab"
                                                data-bs-target="#account" type="button" role="tab"
                                                aria-controls="hoaccountme" aria-selected="true">Edit Profile</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="integrations-tab" data-bs-toggle="tab"
                                                data-bs-target="#integrations" type="button" role="tab"
                                                aria-controls="integrations" aria-selected="false">Edit Address</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="security-tab" data-bs-toggle="tab"
                                                data-bs-target="#security" type="button" role="tab"
                                                aria-controls="security" aria-selected="false">Change Password</button>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                        aria-labelledby="overview-tab">
                                        <div class="card">
                                            <div class="card-body p-md-5">
                                                <h4 class="profile-hr ">Profile Details <span></span></h4>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Name</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p><?= $userFname.' '.$userLname; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Email</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p><?= $userEmail; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Gender</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="text-capitalize"><?= $userGender ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Address</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p>
                                                            <?php
                                                            $addressArr = array(
                                                                'address1' => $userAddress1,
                                                                'address2' => $userAddress2,
                                                                'address3' => $userAddress3,
                                                                'city' => $userCity,
                                                                'state' => $userState,
                                                                'country' => $userCountry,
                                                                'zipcode' => $userPinCode
                                                                
                                                            );

                                                            $Location->printAddress($addressArr);
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Phone</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p><?= $userMobile; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Profession</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p><?= $userProfession;?></p>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-3">
                                                        <label>Joined On</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p><?php echo date('l jS \of F Y h:i:s A', strtotime($cusDtl[0][22])); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mb-0">
                                                    <div class="col-md-12">
                                                        <h4 class="profile-hr mb-0">About <span></span></h4>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p><?= $userBrief ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade " id="account" role="tabpanel"
                                        aria-labelledby="account-tab">
                                        <?php require_once ROOT_DIR."components/user-profile-update.php" ?>
                                    </div>

                                    <div class="tab-pane fade" id="integrations" role="tabpanel"
                                        aria-labelledby="integrations-tab">
                                        <?php require_once ROOT_DIR."components/user-address-form.php" ?>
                                    </div>

                                    <div class="tab-pane fade" id="security" role="tabpanel"
                                        aria-labelledby="security-tab">
                                        <?php require_once ROOT_DIR."components/user-password-form.php" ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= URL ?>assets/portal-assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/pace/pace.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/highlight/highlight.pack.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/pages/settings.js"></script>
    <script src="<?= URL ?>js/script.js"></script>
    <script src="<?= URL ?>js/location.js"></script>
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
    <!-- for current password view icon hideshow -->
    <!-- ------------------------------------------- -->
    <script>
    var password = document.getElementById('currentPassword');
    var toggler = document.getElementById('toggler');
    showHidePassword = () => {
        if (password.type == 'password') {
            toggler.classList.replace("fa-eye-slash", "fa-eye");
            password.setAttribute('type', 'text');
        } else {
            password.setAttribute('type', 'password');
            toggler.classList.replace("fa-eye", "fa-eye-slash");
        }
    };
    toggler.addEventListener('click', showHidePassword);
    </script>
    <!-- ---------------------------------------------- -->
    <!-- for current password view icon hideshow end -->
    <!-- ------------------------------------------- -->


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
</body>

</html>