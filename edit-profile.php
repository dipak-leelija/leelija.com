<?php
session_start();
require_once("includes/constant.inc.php");
require_once("_config/dbconnect.php");

require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");

//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
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
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title> Edit My Profile | Edit Profile:: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

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
    <link href="plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />

    <!-- Custom CSS -->
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/form.css" rel='stylesheet' type='text/css' />
    <link href="css/dashboard.css" rel='stylesheet' type='text/css' />
    <link href="css/edit-profile.css" rel='stylesheet' type='text/css' />
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
        <?php require_once "partials/navbar.php"; ?>
        <?php //include 'header-user-profile.php'?>

        <!-- //header -->
        <!-- banner -->
        <div class="client_add_blog mt-4">
            <section class="py-5 pt-0 branches position-relative" id="explore">
                <div class="container py-md-2 container-fluid text-center">
                    <h2 class="stat-title color-blue font-weight-bold text-center text-uppercase pb-5">
                        Edit Your profile
                    </h2>
                    <div class="row">
                        <div class="bfrom">
                            <div class="styling-details-dynamic">
                                <div class="mineing">
                                    <table class="ordered-details-table-css w-100">
                                        <tbody style="vertical-align: baseline;text-align: start;">
                                            <tr>
                                                <td>Name</td>
                                                <td>:</td>
                                                <td class="text-start">Rozy Begum</td>
                                            </tr>
                                            <tr>
                                                <td>Email Id</td>
                                                <td>:</td>
                                                <td class="text-start" style="word-break: break-word;">
                                                    rozybegum.leelija@gmail.com</td>
                                            </tr>
                                            <tr>
                                                <td>Gender </td>
                                                <td>:</td>
                                                <td class="text-start">Female</td>
                                            </tr>
                                            <tr>
                                                <td>Profession</td>
                                                <td>:</td>
                                                <td class="text-start">Web Developer</td>
                                            </tr>
                                            <tr>
                                                <td>Phone No'</td>
                                                <td>:</td>
                                                <td class="text-start">9093615636 </td>
                                            </tr>
                                            <tr>
                                                <td>Address </td>
                                                <td>:</td>
                                                <td class="text-start">Barasat, 700125 , West Bengal </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--start from div-->
                            <form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>"
                                name="formContactform" method="post" enctype="multipart/form-data" autocomplete="off">
                                <b
                                    style="color: red;"><?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?></b>
                                <!-- begion row -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <div class="circle editing-profile-img">
                                                <img class=" profile-pic rounded editingimg"
                                                    src="images/user/<?php echo $cusDtl[0][9] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 m-auto">
                                            <div class="p-image">
                                                <div class="card col-sm-12 col-md-12 col-lg-12 flduplod">
                                                    <input class="pl-0 file-upload" type="file" name="fileImg"
                                                        id="fileImg" accept="image/*" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label for="" class="col-xl-2 control-label">First
                                            Name</label>
                                        <div class="col-xl-4">
                                            <input type="text" class="form-control" name="fname"
                                                value="<?php echo $cusDtl[0][5]; ?>" required>
                                        </div>
                                        <label for="" class="col-xl-2 control-label">last
                                            Name</label>
                                        <div class="col-xl-4">
                                            <input type="text" class="form-control" name="lname"
                                                value="<?php echo $cusDtl[0][6]; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label for="" class="col-xl-2 control-label">Email Id</label>
                                        <div class="col-xl-4">
                                            <input type="email" class="form-control" name="email_id"
                                                value="<?php echo $cusDtl[0][3]; ?>" required>
                                        </div>
                                        <label for="" class="col-xl-2 control-label">Mobile No</label>
                                        <div class="col-xl-4">
                                            <input type="number" class="form-control" name="mob_no"
                                                value="<?php echo $cusDtl[0][34]; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label for="" class="col-xl-2 control-label">Gender</label>
                                        <!-- <legend class="control-label col-xl-2 ">Gender :</legend> -->
                                        <div class="col-xl-4 genderingrow ">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" value="male" <?php 
                                                                if ($cusDtl[0][7] == "male") {
                                                                    echo 'checked';
                                                                }
                                                                ?> required>
                                                <label class="form-check-label" for="gridRadios1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    value="Female" <?php 
                                                                if ($cusDtl[0][7] == "female") {
                                                                    echo 'checked';
                                                                }
                                                                ?>>
                                                <label class="form-check-label" for="gridRadios2">
                                                    Female
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender"
                                                    value="others" <?php 
                                                                if ($cusDtl[0][7] == "others") {
                                                                    echo 'checked';
                                                                }
                                                                ?>>
                                                <label class="form-check-label" for="gridRadios2">
                                                    Transgender
                                                </label>
                                            </div>
                                        </div>
                                        <label for="txtProfession"
                                            class="col-xl-2 control-label client_profession border-0">Profession</label>
                                        <div class="col-xl-4">
                                            <select id="txtProfession" class="form-select myselectcss"
                                                name="txtProfession" required>
                                                <option value="<?php echo $cusDtl[0][14];?>" selected="selected">
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
                                </div>

                                <div class="form-group">
                                    <div class="row align-items-center">

                                        <label for="" class="col-xl-2 control-label">About You</label>
                                        <div class="col-xl-4">
                                            <textarea class="form-control" rows="2" id=""
                                                name="brief"><?php echo $cusDtl[0][10]; ?></textarea>
                                        </div>

                                        <label for="" class="col-xl-2 control-label">Description</label>
                                        <div class="col-xl-4">
                                            <textarea class="form-control" rows="2" id=""
                                                name="txtDesc"><?php echo trim(stripslashes($cusDtl[0][11])); ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label for="" class="col-xl-2 control-label">Organization</label>
                                        <div class="col-xl-4">
                                            <input class="form-control" name="organization"
                                                value="<?php echo $cusDtl[0][12]; ?>" readonly>
                                        </div>

                                        <label for="" class="col-xl-2 control-label">Discount
                                            Offered</label>
                                        <div class="col-xl-4">
                                            <input class="form-control" name="discount"
                                                value="<?php echo $cusDtl[0][19]; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label for="" class="col-xl-2 control-label">Featured</label>
                                        <div class="col-xl-4">
                                            <input class="form-control" name="featured"
                                                value="<?php echo $cusDtl[0][13]; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2   d-md-flex col-12 col-md-3 mx-auto my-3">
                                    <button type="submit" name="btnCancel"
                                        class="btn botton-midle btn-danger">Cancel</button>
                                    <button type="submit" name="btnSubmit"
                                        class="btn botton-midle btn-primary">Update</button>
                                </div>
                                <div class="form-group">
                                </div>
                            </form>

                            <!-- address update form start -->
                            <form class="form-horizontal mt-4" role="form" action="<?php echo $_SERVER['PHP_SELF'] ?>"
                                name="formContactform" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label for="" class="col-xl-2 control-label">Address1</label>
                                        <div class="col-xl-4">
                                            <input type="text" class="form-control" name="address1"
                                                value="<?php echo $cusDtl[0][24]; ?>" required>
                                        </div>
                                        <label for="" class="col-xl-2 control-label">Address2</label>
                                        <div class="col-xl-4">
                                            <input type="text" class="form-control" name="address2"
                                                value="<?php echo $cusDtl[0][25]; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label for="" class="col-xl-2 control-label">Town/City</label>
                                        <div class="col-xl-4">
                                            <input type="text" class="form-control" name="town/city"
                                                value="<?php echo $cusDtl[0][27]; ?>" required>
                                        </div>
                                        <label for="" class="col-xl-2 control-label">Postal Code</label>
                                        <div class="col-xl-4">
                                            <input type="number" class="form-control" name="postal_code"
                                                value="<?php echo $cusDtl[0][29]; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row align-items-center">
                                        <label for="txtProfession"
                                            class="col-xl-2 control-label client_profession border-0">Country</label>
                                        <div class="col-xl-4">
                                            <select id="txtProfession" class="form-select " name="txtProfession"
                                                required>
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
                                        <label for="txtProfession"
                                            class="col-xl-2 control-label client_profession border-0">State</label>
                                        <div class="col-xl-4">
                                            <select id="txtProfession" class="form-select " name="txtProfession"
                                                required>
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
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label for="" class="col-xl-2 control-label">Phone1</label>
                                        <div class="col-xl-4">
                                            <input type="number" class="form-control" name="postal_code"
                                                value="<?php echo $cusDtl[0][31]; ?>" required>
                                        </div>

                                        <label for="" class="col-xl-2 control-label">Phone2</label>
                                        <div class="col-xl-4">
                                            <input type="number" class="form-control" name="postal_code"
                                                value="<?php echo $cusDtl[0][32]; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label for="" class="col-xl-2 control-label">Fax</label>
                                        <div class="col-xl-4">
                                            <input type="number" class="form-control" name="postal_code"
                                                value="<?php echo $cusDtl[0][33]; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <label for="" class="col-xl-2 control-label">joined</label>
                                        <div class="col-xl-4">
                                            <input placeholder="12-09-2022" class="form-control" name="postal_code"
                                                value="<?php echo date('l jS \of F Y h:i:s A', strtotime($cusDtl[0][22])); ?>"
                                                readonly>
                                        </div>
                                        <label for="" class="col-xl-2 control-label">Password</label>
                                        <div class="col-xl-4">
                                            <input type="password" name="password" class="form-control" required>
                                            <div class="invalid-feedback">Please enter your password!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2   d-md-flex col-12 col-md-3 mx-auto my-3">
                                    <button type="submit" name="btnCancel"
                                        class="btn botton-midle btn-danger">Cancel</button>
                                    <button type="submit" name="addressUpdate"
                                        class="btn botton-midle btn-primary">Update</button>
                                </div>
                                <div class="form-group">
                                </div>
                            </form>
                            <!-- address update form end -->
                        </div>
                        <!--end from div-->
                    </div>
                </div>
            </section>
        </div>
        <!-- Modal -->
        <div id="add_project" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header login-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Add Project</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" placeholder="Project Title" name="name">
                        <input type="text" placeholder="Post of Post" name="mail">
                        <input type="text" placeholder="Author" name="passsword">
                        <textarea placeholder="Desicrption"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancel" data-dismiss="modal">Close</button>
                        <button type="button" class="add-project" data-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- //end container sec -->

        <!-- Footer -->
        <?php require_once 'partials/footer.php'; ?>
        <!-- /Footer -->
        <!-- js-->
        <script src="js/jquery-2.2.3.min.js"></script>
        <!-- js-->
        <!-- Scrolling Nav JavaScript -->
        <script src="js/scrolling-nav.js"></script>
        <script>
        $(document).ready(function() {
            $('[data-toggle="offcanvas"]').click(function() {
                $("#navigation").toggleClass("hidden-xs");
            });
        });
        </script>
        <!-- //fixed-scroll-nav-js -->
        <script>
        $(window).scroll(function() {
            if ($(document).scrollTop() > 70) {
                $('nav.pagescrollfix,nav.RWDpagescrollfix').addClass('shrink');
            } else {
                $('nav.pagescrollfix,nav.RWDpagescrollfix').removeClass('shrink');
            }
        });
        </script>
        <!-- Banner text Responsiveslides -->
        <script src="js/responsiveslides.min.js"></script>
        <script>
        // You can also use"$(window).load(function() {"
        $(function() {
            // Slideshow 4
            $("#slider3").responsiveSlides({
                auto: true,
                pager: true,
                nav: false,
                speed: 500,
                namespace: "callbacks",
                before: function() {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function() {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
        </script>
        <!-- //Banner text  Responsiveslides -->
        <!-- start-smooth-scrolling -->
        <script src="js/move-top.js"></script>
        <script src="js/easing.js"></script>
        <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
        </script>
        <!-- //end-smooth-scrolling -->
        <!-- smooth-scrolling-of-move-up -->
        <script>
        $(document).ready(function() {
            /*
             var defaults = {
            	 containerID: 'toTop', // fading element id
            	 containerHoverID: 'toTopHover', // fading element hover id
            	 scrollSpeed: 1200,
            	 easingType: 'linear'
             };
             */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
        </script>
        <script>
        $(document).ready(function() {
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function() {
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
        });
        </script>
        <script src="js/SmoothScroll.min.js"></script>
        <!-- //smooth-scrolling-of-move-up -->
        <!-- Bootstrap Core JavaScript -->
        <!-- <script src="js/bootstrap.js"></script> -->
        <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
        <!-- Switch Customer Type -->
        <script src="js/customerSwitchMode.js"></script>
</body>

</html>