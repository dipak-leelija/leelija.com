<?php
session_start();

//include_once('checkSession.php');
require_once("_config/dbconnect.php");
require_once("_config/dbconnect.trait.php");

require_once("includes/constant.inc.php");
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");

require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");

require_once("includes/registration.inc.php");


/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$myError 		= new MyError();
$search_obj		= new Search();
$customer		= new Customer();

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId			= $utility->returnSess('userid', 0);
//$cusDtl			= $client->getClientData($cusId);

if(isset($_POST['btnSubmit']))
{
//post vars
$firstName 		= $_POST['firstName'];
$fullname= explode(" ",$firstName );
$firstName= $fullname[0];
$lastName= $fullname[1];
// $lastName 		= $_POST['lastName'];
$txtemail  		= $_POST['txtemail'];
$txtUserName 	= $_POST['txtemail'];
$txtPassword	= $_POST['txtPassword'];
$txtPasswordConfirm	= $_POST['txtPasswordConfirm'];
$txtCountry		= $_POST['txtCountry'];
$txtGender		= '';
$txtProfession  = $_POST['txtProfession'];
//$selUType  	= $_POST['selUType'];



// echo $firstName.'<br>';
// echo $lastName.'<br>';
// echo $txtemail.'<br>';
// echo $txtUserName.'<br>';
// echo $txtPassword.'<br>';
// echo $txtPasswordConfirm.'<br>';
// echo $txtCountry.'<br>';
// echo $txtGender.'<br>';
// echo $txtProfession.'<br>';



//registering the post session variables
$sess_arr	= array('firstName','lastName','txtemail','txtPassword','txtGender', 'txtProfession');
// $utility->addPostSessArr($sess_arr);


//defining error variables
$action		= 'add_user';
$url		= $_SERVER['PHP_SELF'];
$id			= 0;
$id_var		= '';
$anchor		= 'addUser';
$typeM		= 'ERROR';


//check for errors
$duplicate = $myError->duplicateUser($txtemail, 'user_name', 'customer');
$email_id  = $myError->invalidEmail($txtemail);

if($firstName == '' ){
	$myError->showErrorTA($action, $id, $id_var, $url, ERREG001, $typeM, $anchor);
}elseif($lastName == '' ){
	$myError->showErrorTA($action, $id, $id_var, $url, ERREG002, $typeM, $anchor);
}
elseif(strlen($txtPassword) < 6){
	
	$myError->showErrorTA($action, $id, $id_var, $url, ERU117, $typeM, $anchor);
}elseif( $txtPassword!=$txtPasswordConfirm){

	$myError->showErrorTA($action, $id, $id_var, $url, conp0001, $typeM, $anchor);	
}elseif(preg_match("^ER",$duplicate)){
	$error->showErrorTA($action, $id, $id_var, $url, ERREG006, $typeM, $anchor);
}elseif(preg_match("^ER",$email_id)){
	$error->showErrorTA($action, $id, $id_var, $url, ERREG005, $typeM, $anchor);
}else{
	$uniqueId= time().' '.mt_rand();
	$uniqueId = md5($uniqueId);
	$_SESSION['vkey']=$uniqueId ;
		
//Add New User
$custId 	= $customer->addCustomer(1, 1, $txtUserName, $txtemail, $txtPassword, $firstName, $lastName, $txtGender,'', 'a',
'', '', '', 'Y', $txtProfession, 0, $uniqueId,
'N', 0);


$_SESSION['newCustomerSess'] = $custId ;





$customer->addCusAddress($custId, '', '', '', '', '', '', $txtCountry, '', '', '', '');

//delete the session
$utility->delSessArr($sess_arr);

//forward
$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUREG001, 'SUCCESS');
}

//send email by samuel

// var url= "contact-inc.php?txtName=" + escape(txtName) + "&txtEmail=" + escape(txtEmail) + "&txtPhone=" + escape(txtPhone) + "&txtMessage=" + escape(txtMessage);

$fullname= $firstName.' '.$lastName;
$usertxtphone = '123456789';
$usertxtMessage = 'Welcome to Leelija ';
// $uniqueId= time().mt_rand();
// // echo strrev($uniqueId);

$mailurl= 'register-email-inc.php?txtName='.$fullname.'&txtEmail='.$txtemail.'&txtPhone='.$usertxtphone.'&txtMessage='.$usertxtMessage;

header('location:'.$mailurl);

// if($_SESSION['return_url'] == '')
// {
// 	if(isset($_SESSION['orderNow'])){
// 		$_SESSION['return_url'] 	= "blogDetailsShare.php?id=".$_SESSION['orderNowId'];
// 	}else{
// 		$_SESSION['return_url'] 	= "dashboard.php";
// 	}

// }

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
    <script>
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>

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
                                            <img class="w-100 " src="./images/register-leftside.jpg">
                                        </div>
                                    </div>
                                    <div class="col-lg-7 m-auto p-0">
                                        <div class="reg-div-below-card ">
                                            <div class="mb-3 mt-2">
                                                <h3 class="h4 font-weight-bold text-theme reg-heading">
                                                    Join With Leelija</h3>
                                            </div>
                                            <div class="section group">
                                                <div class="bfrom">
                                                    <form class="form-horizontal-login needs-validation" role="form"
                                                        action="<?php echo $_SERVER['PHP_SELF'] ?>" name="regUserForm"
                                                        method="post" enctype="multipart/form-data" autocomplete="off"
                                                        id="regUserForm" novalidate>

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-floating mb-2">
                                                                    <input type="text" placeholder="firstname"
                                                                        minlength="3" id="firstName" name="firstName"
                                                                        class="form-control" required>
                                                                    <label class="required-field">First Name</label>
                                                                    <div class="invalid-feedback">
                                                                        Please Enter First your Name!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-floating mb-2">
                                                                    <input type="text" placeholder="lastname"
                                                                        minlength="3" id="lastName" name="lastName"
                                                                        class="form-control" required>
                                                                    <label class="required-field">Last Name</label>
                                                                    <div class="invalid-feedback">
                                                                        Please Enter your Last Name!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-floating mb-2">
                                                                    <input type="text"
                                                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        minlength="10" pattern="[0-9]+" maxlength="10"
                                                                        class="form-control" id="mobNumber"
                                                                        placeholder=" " name="mobNumber" required>
                                                                    <label for="floatingInput"> Contact Number </label>
                                                                    <div class="invalid-feedback">
                                                                        Please enter your contact number!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-floating mb-2">
                                                                    <input type="email" id="txtemail" name="txtemail"
                                                                        placeholder="example@email.com"
                                                                        inputmode="email"
                                                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                                                        autofill="off" autocomplete="false"
                                                                        class="form-control" required>
                                                                    <label class="required-field">Email</label>
                                                                    <div class="invalid-feedback">
                                                                        Please enter your email!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-floating mb-2">
                                                                    <select class="form-select" name="txtProfession"
                                                                        id="txtProfession"
                                                                        aria-label="Floating label select example"
                                                                        required>
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
                                                                    <label for="profession">Profession</label>
                                                                    <div class="invalid-feedback">
                                                                        Please choose a profession!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-floating mb-2">
                                                                    <select class="form-select" id="selectCountry"
                                                                        name="txtCountry" required>
                                                                        <option value="" selected="selected">Select
                                                                            Country</option>

                                                                    </select>
                                                                    <label for="floatingSelect">Country</label>
                                                                    <div class="invalid-feedback">
                                                                        Please choose a country!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-floating mb-2">
                                                                    <input type="password" minlength="8"
                                                                        id="txtPassword" name="txtPassword"
                                                                        placeholder="(username)123"
                                                                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$"
                                                                        autocomplete="new-password" class="form-control"
                                                                        required>
                                                                    <label class="required-field">Password </label>
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

                                                            <div class="col-sm-6">
                                                                <div class="form-floating mb-2">
                                                                    <input type="password" id="txtPasswordConfirm"
                                                                        name="txtPasswordConfirm" minlength="8"
                                                                        placeholder="Confirm Password"
                                                                        pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$"
                                                                        class="form-control " required>
                                                                    <label class="required-field">Confirm
                                                                        Password</label>
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
                                                                            href="">Terms of service</a>
                                                                        and <a class="term-n-policy" href="">Privacy
                                                                            Policy</a> .
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 mb-3 submit-divclass  text-center">
                                                            <a href="/"><button class="my-buttons-hover bn21"
                                                                    type="submit" id="userRegisterBtn"
                                                                    name="btnSubmit"><i
                                                                        class="fas fa-sign-in-alt pr-2"></i>
                                                                    Register</button></a>
                                                        </div>
                                                        <div class=" sign-up-btn pr-3 text-right">
                                                            <span>Already have an account?</span> <a href="login.php"
                                                                class=""> Sign in
                                                                Now</a>
                                                        </div>

                                                    </form>
                                                </div>

                                            </div>
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
        <!-- <div class="register_section_design">
            <div class="container-fluid">
                <h2></h2>
                <h4> </h4>
                <div class="row">
                    <div class="col-6">
                        <div class="registerImg">
                            <div class="login-logo text-center p-2">
                                <a href="index.php"> <img src="images/logo/logo.png" alt="logo-leelija" srcset=""></a>
                            </div>
                            <img src="images/Register.png" alt="login-image" class="w-100">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="features_grids form_shadow">
                            <div class="section group">
                                <div class="bfrom">
                                    <form class="form-horizontal" role="form"
                                        action="<?php echo $_SERVER['PHP_SELF'] ?>" name="formContactform" method="post"
                                        enctype="multipart/form-data" autocomplete="off" id="regUserForm">
                                        <b
                                            style="color: #05ba4d; text-align: center;"><?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?></b>
                                        <h3
                                            class="text-center pb-3 purple-text text-capitalize register_section_header">
                                            Join With Leelija</h3>
                                        <div class="form-group">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="required-field">Name</label>
                                                    <input type="text" id="firstName" name="firstName"
                                                        placeholder="Your First Name" class="form-control" autofocus>
                                                    <p id="fNameErr" class="regusererr">first name must be 4 charactar
                                                        long</p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="required-field">Email</label>
                                                    <input type="email" id="txtemail" name="txtemail"
                                                        placeholder="Email (yourname@email.com)" class="form-control">
                                                    <p id="emailErr" class="regusererr">please enter your valid email
                                                    </p>
                                                </div>
                                                <div class="col-12 ">
                                                    <div class="already_a_member">
                                                        <span style="color:rgb(155, 155, 155);">Already a member?</span>
                                                        <a href="login.php" class="purple-text ">login</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="required-field">Password</label>
                                                    <input type="password" id="txtPassword" name="txtPassword"
                                                        placeholder="Password (Must Have 6 Characters)"
                                                        class="form-control">
                                                    <span class="help-block d-none">At Least 6 Character</span>
                                                    <p id="passErr" class="regusererr">password should be 6 charactar
                                                        long</p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label class="required-field">Confirm Password</label>
                                                    <input type="password" id="txtPasswordConfirm"
                                                        name="txtPasswordConfirm" placeholder="Confirm Password"
                                                        class="form-control">
                                                    <span class="help-block d-none">At Least 6 Character</span>
                                                    <p id="cpassErr" class="regusererr">confirm password should be 6
                                                        charactar long</p>
                                                    <span id='Confirmmessage'></span>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="country" class="control-label mb-3 required-field">Please Select
                                                Your Country</label>
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <select id="selectCountry" name="txtCountry" class="form-control w-75"
                                                required>
                                                <option value="0">-- Select Country --</option>
                                                <?php
												if(isset($_SESSION['userid'])){
											
												$utility->populateDropDown($cusDtl[24], 'countries_id', 'countries_name', 'countries');
												}else{
											
												$utility->populateDropDown(0, 'countries_id', 'countries_name', 'countries');
												}
												?>
                                            </select>

                                            <p id="selectCountryErr" class="regusererr">Please choose any country from
                                                this list</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="profession" class="control-label required-field ">Please Select
                                                Your Profession</label>
                                        </div>

                                        <div class="col-sm-12">
                                            <select id="txtProfession" class="form-control select2 w-75 mb-3"
                                                name="txtProfession" required>
                                                <option value="" selected="selected">Select Profession</option>
                                                <option value="Author">Author</option>
                                                <option value="Blogger">Blogger</option>
                                                <option value="Blogger">Blogger Outreach Manager</option>
                                                <option value="Business Analyser">Business Analyser</option>
                                                <option value="Marketing Manager">Marketing Manager</option>
                                                <option value="Web Developer">Web Developer</option>
                                                <option value="Others">Others</option>
                                            </select>

                                            <p id="selectProfessionErr" class="regusererr">Please choose any profession
                                                from this list</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 p-0">
                                        <button type="submit" name="btnSubmit" class="btn btn-primary font-weight-bold"
                                            id="userRegisterBtn"><i
                                                class="fas fa-sign-in-alt pr-2"></i>Register</button>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class=" sign-up-btn pr-3 text-right">
                                        <span>Already have an account?</span> <a href="login.php" class=""> Sign in
                                            Now</a>
                                    </div>
                                </div>
                                </form>

                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> -->
        <!-- //end container sec -->
    </div>
    <!-- js-->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- js-->
    <!-- Scrolling Nav JavaScript -->
    <script src="js/scrolling-nav.js"></script>
    <!-- //fixed-scroll-nav-js -->
    <!-- <script>
    $(window).scroll(function() {
        if ($(document).scrollTop() > 70) {
            $('nav.pagescrollfix,nav.RWDpagescrollfix').addClass('shrink');
        } else {
            $('nav.pagescrollfix,nav.RWDpagescrollfix').removeClass('shrink');
        }
    });
    </script> -->
    <!-- Banner text Responsiveslides -->
    <script src="js/responsiveslides.min.js"></script>
    <script>
    // You can also use"$(window).load(function() {"
    // $(function() {
    //     // Slideshow 4
    //     $("#slider3").responsiveSlides({
    //         auto: true,
    //         pager: true,
    //         nav: false,
    //         speed: 500,
    //         namespace: "callbacks",
    //         before: function() {
    //             $('.events').append("<li>before event fired.</li>");
    //         },
    //         after: function() {
    //             $('.events').append("<li>after event fired.</li>");
    //         }
    //     });

    // });
    // 
    </script>
    <!-- //Banner text  Responsiveslides -->
    <!-- start-smooth-scrolling -->

    <script src="js/SmoothScroll.min.js"></script>
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js">
    </script>
    <!-- //Bootstrap Core JavaScript -->
    <!-- 
    <script src="js/regUser.js"></script>
    <script src="js/regChk.js"></script>
    <script src="js/jquery.validate.js"></script> -->
</body>

</html>