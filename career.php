<?php
session_start();
//include_once('checkSession.php');
require_once "includes/constant.inc.php";

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
require_once("classes/job.class.php");


/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$job 				= new Job();


######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);

$jobApllied = $job->showAllPosts();
?>
<?php

define('WP_USE_THEMES', false);
// require('blog/wp-load.php');
// query_posts('showposts=3');



?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <?php include('head-section.php');?>
    <title>Career opportunity for web developers, digital marketing experts and editors with Leelija</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Thanks for checking out our current opportunities, current job opening for web developers, SEO experts and content writers." />
    <meta name="keywords"
        content="job oppertunities, job opening, job oppertunities for web developers, web designer, SEO experts, SEO analyzer, content writers, social media experts and apps developers" />

</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once "partials/navbar.php" ?>

        <div class="main_service_page pt-4">
            <div class="service_page_banner  text-center banner py-4">
                <h1 class="blue_color_class1 text-uppercase font-weight-bold ">Career</h1>
                <h3 class="py-3 mons-font">Take a look to our Career Options. </h3>
                <p>We are providing you a great opportunities to become a part of us.</p>
                <p>We are welcoming new Talented people like you.</p>
                <p>Apply Now to Join Our Team</p>
            </div>
            <!--Banner Dividor-->
            <!--/End of baneer Dividor-->
            <div class="grow-career-skills">
                <h2 class="">Why are you <span class="blue_color_class">waiting?</span></h2>
                <div class="row">
                    <div class=" col-lg-6 col-sm-12 col-md-6  ">
                        <img src="images/portfolio/why-are-you-waiting.jpg  " class="w-100" 
                            alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12  col-md-6 m-auto text-center">
                        <p class="">We need you by our side for developing high-end applications that will
                            change the life of our clients and their end users for better. Also, if you love
                            being part of the web, then, we have got excellent opportunities for you in digital
                            marketing to help our clients take their business soaring beyond unexplored
                            horizons.
                        </p>
                    </div>
                </div>
            </div>

            <!-- =================== m-card start ================= -->


            <section
                class="bt_bb_section bt_bb_top_spacing_extra_large bt_bb_bottom_spacing_extra_large bt_bb_layout_boxed_1200 bt_bb_vertical_align_top bt_bb_section_allow_content_outside bt_bb_section_with_top_coverage_image bt_bb_section_with_bottom_coverage_image bodyconten"
                style="background-color:#f5f5f5; overflow: hidden;">
                <div class="mainpage">
                    <div class="pagecell">
                        <div class="pagecell_inner">
                            <div class="row_wrapper">
                                <div class="bt_bb_row">
                                    <div class="bt_bb_column col-md-3 col-sm-6 col-ms-12 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
                                        data-width=3>
                                        <div class="columnconten"></div>
                                    </div>

                                    <div class="bt_bb_column col-md-3 col-sm-6 col-ms-12 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
                                        data-width=3>
                                        <div class="columnconten">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row_wrapper">
                                <div class="bt_bb_row">
                                    <div class="bt_bb_column col-md-1 col-ms-12 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
                                        data-width=1>
                                        <div class="columnconten"></div>
                                    </div>
                                    <div class="bt_bb_column col-md-10 col-ms-12 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
                                        data-width=10>
                                        <div class="columnconten">
                                            <div class="step_line">
                                                <div class="inner_step">
                                                    <div class="inner_step_content animation_fade_in animate">
                                                        <div class="holder">
                                                            <div class="holder_sleeve">
                                                                <div class="step_content">
                                                                    <div
                                                                        class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_large bt_bb_shape_circle bt_bb_align_inherit">
                                                                        <span><i
                                                                                class="fa-regular fa-user boxicon"></i></span>
                                                                    </div>
                                                                    <div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_extra_small bt_bb_bottom_spacing_small"
                                                                        data-bt-override-class=null></div>
                                                                    <header
                                                                        class="bt_bb_headline bt_bb_font_weight_normal bt_bb_dash_none bt_bb_subheadline bt_bb_size_small bt_bb_align_inherit"
                                                                        data-bt-override-class={}>
                                                                        <h4 class="bt_bb_headline_tag">
                                                                            <span class="headline_content"><span>Professional
                                                                                    Growth</span></span>
                                                                        </h4>
                                                                        <div class="subheadline">Collaboratively
                                                                            expedite quality manufactured products via
                                                                            client focused results.</div>
                                                                    </header>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inner_step" style=margin-top:-12%;>
                                                    <div class="inner_step_content animation_fade_in animate">
                                                        <div class="holder">
                                                            <div class="holder_sleeve">
                                                                <div class="step_content">
                                                                    <div
                                                                        class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_large bt_bb_shape_circle bt_bb_align_inherit">
                                                                        <span><i
                                                                                class="fa-regular fa-handshake boxicon"></i></span>
                                                                    </div>
                                                                    <div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_extra_small bt_bb_bottom_spacing_small"
                                                                        data-bt-override-class=null></div>
                                                                    <header
                                                                        class="bt_bb_headline bt_bb_font_weight_normal bt_bb_dash_none bt_bb_subheadline bt_bb_size_small bt_bb_align_inherit"
                                                                        data-bt-override-class={}>
                                                                        <h4 class="bt_bb_headline_tag">
                                                                            <span class="headline_content"><span>Get
                                                                                    Creative Juices
                                                                                    Flowing</span></span>
                                                                        </h4>
                                                                        <div class="subheadline">Dramatically maintain
                                                                            clicks-and-mortar solutions without
                                                                            functional solutions.</div>
                                                                    </header>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inner_step" style=margin-top:-12%;>
                                                    <div class="inner_step_content animation_fade_in animate">
                                                        <div class="holder">
                                                            <div class="holder_sleeve">
                                                                <div class="step_content">
                                                                    <div
                                                                        class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_large bt_bb_shape_circle bt_bb_align_inherit">
                                                                        <span><i
                                                                                class="fa-regular fa-handshake boxicon"></i></span>
                                                                    </div>
                                                                    <div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_extra_small bt_bb_bottom_spacing_small"
                                                                        data-bt-override-class=null></div>
                                                                    <header
                                                                        class="bt_bb_headline bt_bb_font_weight_normal bt_bb_dash_none bt_bb_subheadline bt_bb_size_small bt_bb_align_inherit"
                                                                        data-bt-override-class={}>
                                                                        <h4 class="bt_bb_headline_tag">
                                                                            <span class="headline_content"><span>Express
                                                                                    Yourself</span></span>
                                                                        </h4>
                                                                        <div class="subheadline">Dramatically engage
                                                                            top-line web services vis-a-vis cutting-edge
                                                                            deliverables.</div>
                                                                    </header>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inner_step" style=margin-top:-12%;>
                                                    <div class="inner_step_content animation_fade_in animate">
                                                        <div class="holder">
                                                            <div class="holder_sleeve">
                                                                <div class="step_content">
                                                                    <div
                                                                        class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_large bt_bb_shape_circle bt_bb_align_inherit">
                                                                        <span><i
                                                                                class="fa-regular fa-handshake boxicon"></i></span>
                                                                    </div>
                                                                    <div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_extra_small bt_bb_bottom_spacing_small"
                                                                        data-bt-override-class=null></div>
                                                                    <header
                                                                        class="bt_bb_headline bt_bb_font_weight_normal bt_bb_dash_none bt_bb_subheadline bt_bb_size_small bt_bb_align_inherit"
                                                                        data-bt-override-class={}>
                                                                        <h4 class="bt_bb_headline_tag">
                                                                            <span class="headline_content"><span>Achieve
                                                                                    Everything</span>
                                                                            </span>
                                                                        </h4>
                                                                        <div class="subheadline">Holistically
                                                                            pontificate installed base portals after
                                                                            maintainable products.</div>
                                                                    </header>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inner_step" style=margin-top:-12%;>
                                                    <div class="inner_step_content animation_fade_in animate">
                                                        <div class="holder">
                                                            <div class="holder_sleeve">
                                                                <div class="step_content">
                                                                    <div
                                                                        class="bt_bb_icon bt_bb_color_scheme_4 bt_bb_style_borderless bt_bb_size_large bt_bb_shape_circle bt_bb_align_inherit">
                                                                        <span><i
                                                                                class="fa-solid fa-users ppfauser"></i></span>
                                                                    </div>
                                                                    <div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_extra_small bt_bb_bottom_spacing_small"
                                                                        data-bt-override-class=null></div>
                                                                    <header
                                                                        class="bt_bb_headline bt_bb_font_weight_normal bt_bb_dash_none bt_bb_subheadline bt_bb_size_small bt_bb_align_inherit"
                                                                        data-bt-override-class={}>
                                                                        <h4 class="bt_bb_headline_tag">
                                                                            <span class="headline_content"><span>Connect
                                                                                    with People</span></span>
                                                                        </h4>
                                                                        <div class="subheadline">Completely pursue
                                                                            scalable customer service through
                                                                            sustainable potentialities.</div>
                                                                    </header>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inner_step highlight" style=margin-top:-12%;>
                                                    <div class="inner_step_content animation_fade_in animate">
                                                        <div class="holder">
                                                            <div class="holder_sleeve">
                                                                <div class="step_content">
                                                                    <div
                                                                        class="bt_bb_icon bt_bb_color_scheme_1 bt_bb_style_borderless bt_bb_size_large bt_bb_shape_circle bt_bb_align_inherit">
                                                                        <span><i
                                                                                class="fa-regular fa-heart boxicon"></i></span>
                                                                    </div>
                                                                    <div class="bt_bb_separator bt_bb_border_style_none bt_bb_top_spacing_extra_small bt_bb_bottom_spacing_small"
                                                                        data-bt-override-class=null></div>
                                                                    <header
                                                                        class="bt_bb_headline bt_bb_font_weight_normal bt_bb_color_scheme_2 bt_bb_dash_none bt_bb_subheadline bt_bb_size_small bt_bb_align_inherit"
                                                                        data-bt-override-class={}>
                                                                        <h4 class="bt_bb_headline_tag">
                                                                            <span class="headline_content"><span>Enjoy
                                                                                    Your Work</span>
                                                                            </span>
                                                                        </h4>
                                                                        <div class="subheadline">Collaboratively
                                                                            expedite quality manufactured products via
                                                                            client focused results.</div>
                                                                    </header>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bt_bb_column col-md-1 col-ms-12 bt_bb_align_left bt_bb_vertical_align_top bt_bb_padding_normal"
                                        data-width=1>
                                        <div class="columnconten"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>



            <!-- ==========================================
                                    ---------m-card end---------
                                ========================================== -->

            <div class="join-our-team text-center">
                <div class="container">
                    <h2 class="mb-2">Join Our <span class="blue_color_class">Team</span> As A</h2>
                    <div class="row">
                        <div class="col-lg-3 my-2 col-md-6">
                            <div class="our-team-needs">
                                <img src="images/web-design.png" alt="">
                                <h3>Frontend</h3>
                                <p>HTML5 / CSS3 / Sass / jQuery / Bootstrap </p>
                            </div>
                        </div>
                        <div class="col-lg-3 my-2 col-md-6">
                            <div class="our-team-needs">
                                <img src="images/api.png" alt="">
                                <h3>Backend</h3>
                                <p>PHP / mySql / Python / Ruby /.Net</p>
                            </div>
                        </div>
                        <div class="col-lg-3 my-2 col-md-6">
                            <div class="our-team-needs">
                                <img src="images/android.png" alt="">
                                <h3>Mobile App</h3>
                                <p>Android Developer / IOS Developer</p>
                            </div>
                        </div>
                        <div class="col-lg-3 my-2 col-md-6">
                            <div class="our-team-needs">
                                <img src="images/speaker.png" alt="">
                                <h3>Marketing</h3>
                                <p>SEO / SMM / SEM / Email Marketing</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grow-career-skills">
                <div class="row">
                    <h2> Fast Grow <span>Your Skills and Career</span> </h2>
                    <div class="col-md-6 m-auto">
                        <p>We offer training opportunities to keep your skills sharp and encourage you to
                            stay
                            up-to-date with ever-evolving technologies. As your skills grow, you will have
                            opportunities
                            to move up in the company. If you work hard and deliver quality results, you
                            will do
                            very
                            well here. Pay raises and promotions are completely merit-based, so your success
                            is
                            in your
                            hands.</p>
                    </div>
                    <div class="col-md-6">
                        <img src="images/portfolio/skills-grow.jpg" class="w-100" class="whyareyouwaiting" alt="">
                    </div>
                </div>
            </div>
            <div class="carrier_positions">
                <div class="container">
                    <div class="text-center text-uppercase">
                        <h2>Current <span class="blue_color_class">Opportunities</span></h2>

                    </div>

                    <div class="carrier_single_section">
                        <div class="single_job_posts">
                            <ul>
                                <?php
				               foreach ($jobApllied as $value) {?>
                                <li>
                                    <div class="w-75 left-side-job-type">
                                        <h4 class="job-title"><?php echo $value['job_name'];?></h4>
                                        <p><?php echo $value['details'];?></p>
                                    </div>
                                    <button type="button" name="" class="job-apply btn apply-button">Apply Now</button>
                                </li>
                                <?php	}?>

                            </ul>
                        </div>

                        <div class="job-apply-form">
                            <div class="quote-form px-md-3">
                                <span class="close">&times;</span>

                                <form class="w-100 m-0 careerform needs-validation" method="post"
                                    enctype="multipart/form-data"
                                    style="height: 501px; overflow-y: scroll; padding: 1rem;" novalidate>
                                    <h2 class="text-center ">Job Application</h2>
                                    <div class="successApplication">

                                    </div>
                                    <div class="appliedPosts">
                                        <p class="jobPost "> </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="">First Name</label>
                                                <input type="text" id="jobFirstName" class="form-control m-0"
                                                    placeholder="First name" minlength="3" required>
                                                <div class="invalid-feedback">
                                                    Please enter your first name.
                                                </div>
                                                <!-- <div class="alert-section pt-1" id="noFirstName">

                                            </div> -->
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="">last Name</label>
                                                <input type="text" id="jobScndName" minlength="4"
                                                    class="form-control m-0" placeholder="Last name" required>
                                                <!-- <div class="alert-section pt-1" id="noSecondName">

                                                </div> -->
                                                <div class="invalid-feedback">
                                                    Please enter your last name.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="">Email</label>
                                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                            name="jobEmail" id="jobEmail" class="m-0 form-control"
                                            placeholder="please enter your email" required>
                                        <!-- <div id="noJobEmail">

                                        </div> -->
                                        <div class="invalid-feedback">
                                            Please enter your email.
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="phone">Phone</label>
                                        <input type="text"
                                            onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                            minlength="10" pattern="[0-9]+" maxlength="10" name="jobPhone" id="jobPhone"
                                            class="m-0 form-control" placeholder="0123456789" required maxlength="10"
                                            required>
                                        <!-- <div id="noJobPhone">
                                        </div> -->
                                        <div class="invalid-feedback">
                                            Please enter your phone number.
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <p> <label for="">What is your current employment status?</label></p>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1" required>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Employed
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault2" required>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Self-Employed
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault2" required>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Unemployed
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault2" required>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Student
                                            </label>
                                        </div>
                                        <!-- <ul class="current-job-status" required>
                                            <li><input type="checkbox" name="gender" value="employed" class=""><span>
                                                    Employed</span></li>
                                            <li><input type="checkbox" name="self-smployed" value="self-employed"
                                                    class=""><span> Self-Employed</span></li>
                                            <li><input type="checkbox" name="unemployed" value="unemployed"
                                                    class=""><span> Unemployed</span></li>
                                            <li class="mb-0"><input type="checkbox" name="student" value="student"
                                                    class=""><span>
                                                    Student</span></li>
                                        </ul> -->
                                        <!-- <div class="text-capitalize" id="ifHasExpriences">

                                        </div> -->
                                        <div class="invalid-feedback">
                                            Please select your employment status.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Expriences (if any, in Years)?</label>
                                        <select class=" form-select" name="experinces" required>
                                            <option selected disabled value="">Select</option>
                                            <option value="0">Fresher</option>
                                            <?php for($i=1;$i<=10;$i++){?>
                                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                            <?php	}?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select your exprience.
                                        </div>
                                    </div>

                                    <div class="uploadedCvName"> </div>
                                    

                                    <div class="row m-0 w-100 mt-5">
                                        <div class="col-sm-6 text-center">
                                            <div class="click_to_upload ">
                                                <button class="upload-cv" id="upload-cv">Upload CV</button>
                                                <input type="file" name="cvUpload" id="cvUpload"
                                                    accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-center"> <input type="button"
                                                class="ml-auto mb-0 submit-apply-details "
                                                name="submit-job-apply-details" value="Submit Details"></div>
                                    </div>
                                    <div class="clearfix">

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="afterApplied">
                        <div class="quote-form text-center">
                            <h2>thank you</h2>
                            <p>we will back to you soon</p>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <?php require_once "partials/footer.php" ?>

        <!-- /Footer -->
    </div>
    <!-- js-->
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- js-->
    <script>
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>
    <script type="text/javascript">
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $(".uploadedCvName").html(fileName);
    });


    // ============= Form Submission =============
    $(".submit-apply-details").click(function(e) {
        e.preventDefault();

        var fd = new FormData();
        var cvFile = $('#cvUpload')[0].files[0];
        fd.append('cvUpload', cvFile);

        var firstName = $("#jobFirstName").val();
        if (firstName == '' || firstName == '0') {
            $("#noFirstName").css("display", "block");
            $("#noFirstName").html("Enter a valid First Name");
        }
        $("#jobFirstName").keyup(function() {
            $("#noFirstName").css("display", "none");
        });
        var secondName = $("#jobScndName").val();
        if (secondName == '' || secondName == '0') {
            $("#noSecondName").css("display", "block");
            $("#noSecondName").html("Enter a valid Last Name");
        }
        $("#jobScndName").keyup(function() {
            $("#noSecondName").css("display", "none");
        });
        var email = $("#jobEmail").val();
        if (email == '' || email == '0') {
            $("#noJobEmail").css("display", "block");
            $("#noJobEmail").html("Please Enter a Valid Email");
        }
        $("#jobEmail").keyup(function() {
            $("#noJobEmail").css("display", "none");
        });

        var phone = $("#jobPhone").val();
        if (phone == '' || phone == '0' || phone == '.' || phone.length != 10) {
            $("#noJobPhone").html("Please enter your mobile number");
        }

        var currentJob = $(".current-job-status li input:checked").val();
        if (currentJob == '' || currentJob == '0') {
            $("#ifHasExpriences").html("please choose your current employment status");
        }
        var exprience = $(".experinces").val();

        var uploadedCV = $(".uploadedCvName").html();

        if (uploadedCV == '' || uploadedCV == '0') {
            $(".uploadedCvName").html("Please insert Your CV");
        }
        var appliedForPost = $(".jobPost").children('.blue_color_class').html();

        if (firstName != '' && firstName != '0' && secondName != '' && secondName != '0' && email != '' &&
            email != '0' && currentJob != '' && currentJob != '0' && exprience != '' && uploadedCV != '' &&
            uploadedCV != '0' && phone != '' && phone.length == 10) {

            var jobData = 'fname=' + firstName + '&lname=' + secondName + '&email=' + email + '&phone=' +
                phone + '&job=' + currentJob + '&exprience=' + exprience + '&cv=' + uploadedCV + '&post=' +
                appliedForPost;
            $.ajax({
                url: 'job-applied.php?' + jobData,
                data: fd,
                type: 'post',
                contentType: false,
                processData: false,
                success: function(message) {
                    if (message == "1inserted") {
                        $(".job-apply-form").css("display", "none");
                        $(".afterApplied").css("display", "block")
                    } else if (message == "0not inserted") {
                        $(".successApplication").html("There are some error to submit your form");
                    } else if (message == "0existed" || message == '1existed') {
                        $("#noJobEmail").html("You have already applied");
                    } else {
                        alert(message);
                    }
                }
            })
        }
    });
    // ============= Form Submission End =============




    $('.single_job_posts ul li .job-apply').click(function() {
        $(".job-apply-form").css("display", "block");
        var post = $(this).parents().children('.left-side-job-type').children('.job-title').html();
        $(".jobPost").html('Application for the role of <span class="blue_color_class">' + post + '</span>');
    });

    $(".close").click(function() {
        $(".job-apply-form").css("display", "none");
    });

    $(".current-job-status li input").click(function() {
        var checkedOrNot = $(this).prop("checked");
        var otherChecked = $(".current-job-status li input").not(this).prop("checked", true);
        // var currentJob = $(this).val();
        if (otherChecked) {
            $(this).prop("checked", true);
            $(".current-job-status li input").not(this).prop("checked", false);
        } else {
            $(this).prop("checked", true);
        }
    });
    </script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>
    <!-- //Bootstrap Core JavaScript -->
</body>

</html>