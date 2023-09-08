<?php
session_start();
$page = "Admin_settings";
require_once dirname(__DIR__)."/includes/constant.inc.php";

require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR. "classes/date.class.php";
require_once ROOT_DIR. "classes/error.class.php";
require_once ROOT_DIR. "classes/search.class.php";
require_once ROOT_DIR. "classes/customer.class.php";
require_once ROOT_DIR. "classes/login.class.php";
require_once ROOT_DIR. "classes/niche.class.php";
require_once ROOT_DIR. "classes/domain.class.php";
require_once ROOT_DIR. "classes/utility.class.php";
require_once ROOT_DIR. "classes/utilityMesg.class.php";
require_once ROOT_DIR. "classes/utilityImage.class.php";
require_once ROOT_DIR. "classes/utilityNum.class.php";


/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();

//$ff				= new FrontPhoto();
// $blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId); 
// print_r($cusDtl);
// echo $cusDtl[0][5].' '.$cusDtl[0][6].' '.$cusDtl[0][7];
// exit;
if($cusId == 0)
	{
		header("Location: index.php");
	}

//echo $cusId;exit;
//Edit Profile
if(isset($_POST['btnSubmit']))
{
	$txtProfession			= $_POST['txtProfession'];
	$txtDesc				= $_POST['txtDesc'];

	//registering the post session variables
	$sess_arr	= array( 'txtProfession', 'txtDesc');

		$customer->editCustomer($cusId, $cusDtl[0][5], $cusDtl[0][6], $cusDtl[0][7],'a', '', $txtDesc, '', 'Y',
		$txtProfession, '', 'Y', '');

		//uploading images
		if($_FILES['fileImg']['name'] != '')
		{
			//rename the file
			$newName = $utility->getNewName4($_FILES['fileImg'], '', $cusId);

			//upload and crop the file
			$uImg->imgCropResize($_FILES['fileImg'], '', $newName,
								 'images/user/', 200, 200,
						         $cusId, 'image', 'customer_id','customer');
		}

		$utility->delSessArr($sess_arr);

		//forward
		$uMesg->showSuccessT('success', 0, '', 'dashboard.php', 'SUCUST201', 'SUCCESS'); //SUCUST201,

}
if(isset($_POST['btnCancel']))
{
	//forward
	$uMesg->showSuccessT('success', $id, 'id', "dashboard.php", "", 'Cancel');
}
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
    <link href="<?= URL ?>assets/portal-assets/plugins/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/fontawesome-6.1.1/css/all.min.css" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="<?= URL ?>assets/portal-assets/css/main.min.css" rel="stylesheet">

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
                                    <h2>Settings</h2>

                                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
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
                                                        <p><?php echo $cusDtl[0][5]; ?> <?php echo $cusDtl[0][6]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Email</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p><?php echo $cusDtl[0][3]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Gender</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="text-capitalize">male</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Address</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p>
                                                            <?php echo $cusDtl[0][24]; ?>, Barasat, Kolkata, West
                                                            Bengal, India, 700124
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Phone</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p>7699753019 <?php echo $cusDtl[0][34]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Profession</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p><?php echo $cusDtl[0][14];?></p>
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
                                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Temporibus nesciunt incidunt dolorum modi. Odit facilis ea
                                                            fugit aspernatur nesciunt, provident nostrum vero soluta
                                                            libero quibusdam inventore ipsum ex esse tempora. </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade " id="account" role="tabpanel"
                                        aria-labelledby="account-tab">
                                        <div class="card">
                                            <div class="card-body p-md-5">
                                                <form class="form-horizontal" role="form"
                                                    action="<?php echo $_SERVER['PHP_SELF'] ?>" name="formContactform"
                                                    method="post" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="row ">
                                                        <div class="col-md-6">
                                                            <label for="settingsInputFirstName" class="form-label">First
                                                                Name</label>
                                                            <input type="text" class="form-control" name="fname"
                                                                value="<?php echo $cusDtl[0][5]; ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="settingsInputLastName" class="form-label">Last
                                                                Name</label>
                                                            <input type="text" class="form-control" name="lname"
                                                                value="<?php echo $cusDtl[0][6]; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row m-t-lg">
                                                        <div class="col-md-6">
                                                            <label for="settingsInputEmail" class="form-label">Email
                                                                address</label>
                                                            <input type="email" class="form-control" name="email_id"
                                                                value="<?php echo $cusDtl[0][3]; ?>" required>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="settingsPhoneNumber" class="form-label">Phone
                                                                Number</label>
                                                            <input type="number" class="form-control" name="mob_no"
                                                                value="<?php echo $cusDtl[0][34]; ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="row m-t-lg">

                                                        <div class="col-md-6">
                                                            <label for="settingsInputLastName"
                                                                class="form-label">Gender</label>
                                                            <div class=" genderingrow ">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gender" value="male" <?php 
                                                                if ($cusDtl[0][7] == "male") {
                                                                    echo 'checked';
                                                                }
                                                                ?> required>
                                                                    <label class="form-check-label" for="gridRadios1">
                                                                        Male
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gender" value="Female" <?php 
                                                                if ($cusDtl[0][7] == "female") {
                                                                    echo 'checked';
                                                                }
                                                                ?>>
                                                                    <label class="form-check-label" for="gridRadios2">
                                                                        Female
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gender" value="others" <?php 
                                                                if ($cusDtl[0][7] == "others") {
                                                                    echo 'checked';
                                                                }
                                                                ?>>
                                                                    <label class="form-check-label" for="gridRadios2">
                                                                        Transgender
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="settingsInputUserName"
                                                                class="form-label">Profession</label>

                                                            <select id="txtProfession" class="form-select myselectcss"
                                                                name="txtProfession" required>
                                                                <option value="<?php echo $cusDtl[0][14];?>"
                                                                    selected="selected">
                                                                    <?php echo $cusDtl[0][14];?>
                                                                </option>
                                                                <option value="Author">Author</option>
                                                                <option value="Blogger">Blogger</option>
                                                                <option value="Blogger">Blogger Outreach Manager
                                                                </option>
                                                                <option value="Business Analyser">Business Analyser
                                                                </option>
                                                                <option value="Marketing Manager">Marketing Manager
                                                                </option>
                                                                <option value="Web Developer">Web Developer</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row m-t-lg">
                                                        <div class="col-md-6">
                                                            <label class="form-label">About You</label>
                                                            <textarea class="form-control" name="brief" maxlength="500"
                                                                rows="3"
                                                                aria-describedby="settingsAboutHelp"><?php echo $cusDtl[0][10]; ?></textarea>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Description</label>
                                                            <textarea class="form-control" maxlength="500" rows="3"
                                                                name="txtDesc"
                                                                aria-describedby="settingsAboutHelp"><?php echo trim(stripslashes($cusDtl[0][11])); ?></textarea>

                                                        </div>
                                                    </div>
                                                    <div class="row m-t-lg">
                                                        <div class="col-md-6">
                                                            <label for="settingsAbout"
                                                                class="form-label">Organization</label>
                                                            <input class="form-control" name="organization"
                                                                value="<?php echo $cusDtl[0][12]; ?>" readonly>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="settingsAbout" class="form-label">Discount
                                                                Offered</label>
                                                            <input class="form-control" name="discount"
                                                                value="<?php echo $cusDtl[0][19]; ?>" readonly>

                                                        </div>
                                                    </div>
                                                    <div class="row m-t-lg">
                                                        <div class="col-md-6">
                                                            <label for="settingsAbout"
                                                                class="form-label">Featured</label>
                                                            <input class="form-control" name="featured"
                                                                value="<?php echo $cusDtl[0][13]; ?>" readonly>

                                                        </div>

                                                    </div>
                                                    <div class="row m-t-lg">
                                                        <div
                                                            class="d-grid gap-2   d-md-flex col-12 col-md-3 mx-auto my-3">
                                                            <button type="submit" name="btnCancel"
                                                                class="btn botton-midle btn-danger">Cancel</button>
                                                            <button type="submit" name="btnSubmit"
                                                                class="btn botton-midle btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="integrations" role="tabpanel"
                                        aria-labelledby="integrations-tab">
                                        <div class="card">
                                            <div class="card-body p-md-5">
                                                <form class="form-horizontal" role="form"
                                                    action="<?php echo $_SERVER['PHP_SELF'] ?>" name="formContactform"
                                                    method="post" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="settingsInputFirstName"
                                                                class="form-label">Address1</label>
                                                            <input type="text" class="form-control" name="address1"
                                                                value="<?php echo $cusDtl[0][24]; ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="settingsInputLastName"
                                                                class="form-label">Address2</label>
                                                            <input type="text" class="form-control" name="address2"
                                                                value="<?php echo $cusDtl[0][25]; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="row  m-t-lg">
                                                        <div class="col-md-6">
                                                            <label for="settingsInputFirstName"
                                                                class="form-label">Town/City</label>
                                                            <input type="text" class="form-control" name="town/city"
                                                                value="<?php echo $cusDtl[0][27]; ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="settingsInputLastName" class="form-label">Postal
                                                                Code</label>
                                                            <input type="number" class="form-control" name="postal_code"
                                                                value="<?php echo $cusDtl[0][29]; ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="row m-t-lg">
                                                        <div class="col-md-6">
                                                            <label for="settingsInputUserName"
                                                                class="form-label">Country</label>

                                                            <select id="txtProfession" class="form-select "
                                                                name="txtProfession" required>
                                                                <option value="" selected="selected">Select Country
                                                                </option>
                                                                <option value="Author">Afghanistan</option>
                                                                <option value="Blogger">Brazil</option>
                                                                <option value="Blogger">Canada
                                                                </option>
                                                                <option value="Business Analyser">Dominica
                                                                </option>
                                                                <option value="Marketing Manager"> Fiji
                                                                </option>
                                                                <option value="Web Developer">India</option>
                                                                <option value="Web Developer">Indonesia</option>
                                                                <option value="Web Developer"> Japan</option>
                                                                <option value="Web Developer">Kazakhstan</option>
                                                                <option value="Web Developer">Lebanon</option>
                                                                <option value="Web Developer">Mexico</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="settingsInputUserName"
                                                                class="form-label">State</label>
                                                            <select id="txtProfession" class="form-select "
                                                                name="txtProfession" required>
                                                                <option value="" selected="selected">Select State
                                                                </option>
                                                                <option value="Author">Andhra Pradesh</option>
                                                                <option value="Blogger">Bihar</option>
                                                                <option value="Blogger">Chhattisgarh
                                                                </option>
                                                                <option value="Business Analyser">Haryana
                                                                </option>
                                                                <option value="Marketing Manager">Jharkhand
                                                                </option>
                                                                <option value="Web Developer">West Bengal</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row m-t-lg">
                                                        <div class="col-md-6">
                                                            <label for="Phone1" class="form-label">Phone1</label>
                                                            <input type="number" class="form-control" name="postal_code"
                                                                value="<?php echo $cusDtl[0][31]; ?>" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="Phone2" class="form-label">Phone2</label>
                                                            <input type="number" class="form-control" name="postal_code"
                                                                value="<?php echo $cusDtl[0][32]; ?>" required>

                                                        </div>
                                                    </div>
                                                    <div class="row m-t-lg">
                                                        <div class="col-md-6">
                                                            <label for="settingsAbout" class="form-label">Fax</label>
                                                            <input type="number" class="form-control" name="postal_code"
                                                                value="<?php echo $cusDtl[0][33]; ?>" required>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="settingsAbout" class="form-label">joined</label>
                                                            <input placeholder="12-09-2022" class="form-control"
                                                                name="postal_code"
                                                                value="<?php echo date('l jS \of F Y h:i:s A', strtotime($cusDtl[0][22])); ?>"
                                                                readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row m-t-lg">
                                                        <div
                                                            class="d-grid gap-2   d-md-flex col-12 col-md-3 mx-auto my-3">
                                                            <button type="submit" name="btnCancel"
                                                                class="btn botton-midle btn-danger">Cancel</button>
                                                            <button type="submit" name="btnSubmit"
                                                                class="btn botton-midle btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="security" role="tabpanel"
                                        aria-labelledby="security-tab">
                                        <div class="card">
                                            <div class="card-body p-md-5">
                                                <form class="form-horizontal" role="form"
                                                    action="<?php echo $_SERVER['PHP_SELF'] ?>" name="formContactform"
                                                    method="post" enctype="multipart/form-data" autocomplete="off">
                                                    <div class="row ">
                                                        <div class="col-md-6">
                                                            <label for="settingsCurrentPassword"
                                                                class="form-label">Current
                                                                Password</label>
                                                            <input type="password" class="form-control"
                                                                aria-describedby="settingsCurrentPassword"
                                                                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                                                            <div id="settingsCurrentPassword" class="form-text">Never
                                                                share
                                                                your password with anyone.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-t-xxl">
                                                        <div class="col-md-6">
                                                            <label for="settingsNewPassword" class="form-label">New
                                                                Password</label>
                                                            <input type="password" class="form-control"
                                                                aria-describedby="settingsNewPassword"
                                                                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                                                        </div>
                                                    </div>
                                                    <div class="row m-t-xxl">
                                                        <div class="col-md-6">
                                                            <label for="settingsConfirmPassword"
                                                                class="form-label">Confirm
                                                                Password</label>
                                                            <input type="password" class="form-control"
                                                                aria-describedby="settingsConfirmPassword"
                                                                placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                                                        </div>
                                                    </div>
                                                    <div class="row m-t-xxl">
                                                        <div class="col-md-6">
                                                            <label for="settingsSmsCode" class="form-label">SMS
                                                                Code</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control"
                                                                    aria-describedby="settingsSmsCode"
                                                                    placeholder="&#9679;&#9679;&#9679;&#9679;" required>
                                                                <button class="btn btn-primary btn-style-light"
                                                                    id="settingsResentSmsCode">Resend</button>
                                                            </div>
                                                            <div id="settingsSmsCode" class="form-text">Code will be
                                                                sent to
                                                                the phone number from your account.</div>
                                                        </div>
                                                    </div>
                                                    <div class="row m-t-lg">
                                                        <div class="col">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value=""
                                                                    id="settingsPasswordLogout" checked>
                                                                <label class="form-check-label"
                                                                    for="settingsPasswordLogout">
                                                                    Log out from all current sessions
                                                                </label>
                                                            </div>
                                                            <a href="#" class="btn btn-primary m-t-sm">Change
                                                                Password</a>
                                                        </div>
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

    <!-- Javascripts -->
    <script src="<?= URL ?>assets/portal-assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/pace/pace.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/highlight/highlight.pack.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/pages/settings.js"></script>
</body>

</html>