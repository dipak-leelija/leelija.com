<?php
session_start();
$page = "Admin_add-domin";
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
$MyError 		= new MyError();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$Niche		    = new Niche();
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

######################################################################################################################

$typeM		= $utility->returnGetVar('typeM','');

//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);

if($cusId == 0){
	header("Location: index.php");
}

$currentURL = $utility->currentUrl();

if(isset($_POST['btnAddDomain'])){

		$txtDomain			= $_POST['txtDomain'];
		$txtDomainUrl		= $_POST['txtDomainUrl'];
		$txtNicheId			= $_POST['txtNicheId'];
		$txtDa				= $_POST['txtDa'];
		$txtPa				= $_POST['txtPa'];
		$txtCf				= $_POST['txtCf'];
		$txtTf				= $_POST['txtTf'];
		$txtAlxTraffic		= $_POST['txtAlxTraffic'];
		$txtOrgTraffic		= $_POST['txtOrgTraffic'];
		$txtPrice			= $_POST['txtPrice'];

		//convert it into seo friendly url
		$txtSeoUrl			= $utility->createContentSEOURL($txtDomain, $txtNicheId,'niche','durl','niche_master', 'seo_url', 'domains');

		//add Blog post session variables
		$sess_arr				= array('txtDomain','txtDomainUrl', 'txtNicheId', 'txtDa','txtPa','txtCf','txtTf','txtAlxTraffic','txtOrgTraffic','txtPrice');

		$utility->addPostSessArr($sess_arr);


		//defining error variables
		$action		= 'add_domain';
		$url		= $_SERVER['PHP_SELF'];
		$id			= 0;
		$id_var		= '';
		$anchor		= 'addDomain';
		$typeM		= 'ERROR';
		$msg = '';

		$duplicateId	= $MyError->duplicateUser($txtDomainUrl, 'durl', 'domains');

		if(preg_match("^ER^",$duplicateId)){

			//echo "<span class='orangeLetter'>Error: Domain is already taken</span >";
			$MyError->showErrorTA($action, $id, $id_var, $url, 'Domain Url is already taken', $typeM, $anchor);

		}else{

		    //add Domain
		    $domid = $domain->addDomain($txtDomain, $txtNicheId, $txtDa, $txtPa, $txtCf, $txtTf, $txtAlxTraffic,$txtOrgTraffic, $txtPrice, $txtPrice, $txtDomainUrl, 'No', $txtSeoUrl, 'No', $cusDtl[0][2]);

			// Domain Featured Add
			for($i=0; $i < count($_POST['txtFeatured']); $i++){
				//add the Featured
				$domain->addDomainFeatured($domid, $_POST['txtFeatured'][$i]);
			}



			//uploading images
			if($_FILES['fileImg']['name'] != ''){

				//rename the file
				$newName = $utility->getNewName4($_FILES['fileImg'], '', $domid);

				//upload and crop the file
				$uImg->imgCropResize($_FILES['fileImg'], '', $newName, DOMAIN_IMG_DIR, 600, 600, $domid, 'dimage', 'id','domains');

			}

			//deleting the sessions
			$utility->delSessArr($sess_arr);

			//forward the web page
			$uMesg->showSuccessT('success', 0, '', 'add-domain.php', "Domain Name Has been Successfully Added", 'SUCCESS');

		}

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
    <title>Add Products or Blog for sell - <?= COMPANY_FULL_NAME; ?></title>
    <link rel="shortcut icon" href="<?= FAVCON_PATH ?>" />

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/fontawesome-6.1.1/css/all.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/highlight/styles/github-gist.css" rel="stylesheet">


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

                        <!-- <div class="row">
                            <div class="col">
                                <div class="card page-description">
                                    <h2>Sell Products or Blogs</h2>
                                </div>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col">
                                <div class="card p-3">
                                    <div class="card-header text-center pt-2 pb-4">
                                        <h4>Add New Blog/Item</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="row g-3" action="<?= $currentURL ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <div class="col-md-6">
                                                <label for="txtDomain" class="form-label">Domain Name</label>
                                                <input type="text" class="form-control" id="txtDomain"
                                                    placeholder="example" name="txtDomain"
                                                    value="<?php $utility->printSess2('txtDomain',''); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtDomainUrl" class="form-label">Domain Url</label>
                                                <input type="text" class="form-control" id="txtDomainUrl"
                                                    name="txtDomainUrl" placeholder="https://www.example.com"
                                                    value="<?php $utility->printSess2('txtDomainUrl',''); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtNicheId" class="form-label">Niche</label>
                                                <select class="form-select" id="txtNicheId" name="txtNicheId" required>
                                                    <option value="" selected="selected">Select</option>
                                                    <?php
														$Niches  = $Niche->ShowBlogNichMast();
														foreach($Niches as $eachNiche){
															echo '<option value="'.$eachNiche['niche_id'].'">'.$eachNiche['niche_name'].'</option>';
														}
													?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtDa" class="form-label">DA</label>
                                                <input type="text" placeholder="Domain Authority" class="form-control"
                                                    id="txtDa" name="txtDa"
                                                    value="<?php $utility->printSess2('txtDa',''); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtPa" class="form-label">PA</label>
                                                <input type="text" class="form-control" id="txtPa"
                                                    placeholder="Page Authority" name="txtPa"
                                                    value="<?php $utility->printSess2('txtPa',''); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtCf" class="form-label">CF</label>
                                                <input type="text" class="form-control" placeholder="Citation Flow"
                                                    id="txtCf" name="txtCf"
                                                    value="<?php $utility->printSess2('txtCf',''); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtTf" class="form-label">TF</label>
                                                <input placeholder="Trust Flow" type="text" class="form-control"
                                                    id="txtTf" name="txtTf"
                                                    value="<?php $utility->printSess2('txtTf',''); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtAlxTraffic" class="form-label">Alexa Traffic</label>
                                                <input type="text" class="form-control" id="txtAlxTraffic"
                                                    name="txtAlxTraffic"
                                                    value="<?php $utility->printSess2('txtAlxTraffic',''); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtOrgTraffic" class="form-label">Organic Traffic</label>
                                                <input type="text" class="form-control" id="txtOrgTraffic"
                                                    name="txtOrgTraffic"
                                                    value="<?php $utility->printSess2('txtOrgTraffic',''); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtPrice" class="form-label">price</label>
                                                <input placeholder="Enter Price in USD" type="text" class="form-control"
                                                    id="txtPrice" name="txtPrice"
                                                    value="<?php $utility->printSess2('txtPrice',''); ?>" required>
                                            </div>



                                            <div class="col-md-6">
                                                <input type="hidden" name="count" value="1" />

                                                <label class="form-label" for="field1">Domain Featured </label>
                                                <div class="controls" id="profs">

                                                    <div id="field"><input autocomplete="off" class="input form-control"
                                                            id="field1" name="txtFeatured[]" type="text"
                                                            placeholder="Write your domain featured" /></div>
                                                </div>
                                                <button style="background-color:#1f81c1;" id="b1"
                                                    class="btn add-more my-2" type="button">+</button>
                                                <small>Press + to add another Feaured :)</small>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtPrice" class="form-label">Upload Blog
                                                    Image(600X600)</label>
                                                <div class="prvw-img-wrap">
                                                    <div id="image-preview" class="col-md-6 my-3">
                                                        <label for="image-upload" id="image-label">Choose Image</label>
                                                        <input type="file" name="fileImg" id="image-upload" required />
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- <div class="col-md-6">
                                                <label for="formFile" class="form-label">Default file input
                                                    example</label>
                                                <input class="form-control" type="file" id="formFile">
                                            </div> -->
                                            <div class="col-md-6 mt-5 d-flex m-auto justify-content-evenly">
                                                <button type="button" class="btn  btn-danger" onclick="history.back()"
                                                    id="btn_start_test" role="button">Cancel</button>
                                                <button type="submit" name="btnAddDomain" class="btn btn-primary">Add
                                                    for Sell</button>
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

    <!-- Javascripts -->
    <script src="<?= URL ?>assets/portal-assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/pace/pace.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/highlight/highlight.pack.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>
    <script src="<?= URL ?>js/jquery.uploadPreview.js"></script>



    <script type="text/javascript">
    $(document).ready(function() {

        $.uploadPreview({

            input_field: "#image-upload",

            preview_box: "#image-preview",

            label_field: "#image-label"

        });

    });
    </script>
    <script>
    $(document).ready(function() {

        var next = 1;

        $(".add-more").click(function(e) {

            e.preventDefault();

            var addto = "#field" + next;

            var addRemove = "#field" + (next);

            next = next + 1;

            var newIn = '<input autocomplete="off" class="input form-control" id="field' + next +
                '" name="txtFeatured[]' + next + '" type="text">';

            var newInput = $(newIn);

            var removeBtn = '<button id="remove' + (next - 1) +
                '" class="btn btn-danger remove-me my-2" >-</button></div><div id="field">';

            var removeButton = $(removeBtn);

            $(addto).after(newInput);

            $(addRemove).after(removeButton);

            $("#field" + next).attr('data-source', $(addto).attr('data-source'));

            $("#count").val(next);



            $('.remove-me').click(function(e) {

                e.preventDefault();

                var fieldNum = this.id.charAt(this.id.length - 1);

                var fieldID = "#field" + fieldNum;

                $(this).remove();

                $(fieldID).remove();

            });

        });



    });
    </script>
</body>

</html>