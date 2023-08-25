<?php
session_start();
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
$MyError 			= new MyError();
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
				$uImg->imgCropResize($_FILES['fileImg'], '', $newName, '../images/domains/', 600, 600, $domid, 'dimage', 'id','domains');

			}

			//deleting the sessions
			$utility->delSessArr($sess_arr);

			//forward the web page
			$uMesg->showSuccessT('success', 0, '', 'dashboard.php', "Domain Name Has been Successfully Added", 'SUCCESS');

		}

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/font-awesome/free/css/all.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= URL ?>assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= URL ?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- NAVBAR -->
        <?php require_once ROOT_DIR."components/navbar.php"; ?>
        <!-- NAVBAR END -->
        <div class="container-fluid page-body-wrapper">
            <!-- SETTING PANEL -->
            <?php require_once ROOT_DIR."components/settings-panel.php"; ?>
            <!-- SETTING PANEL END-->
            <!-- SIDEBAR -->
            <?php require_once ROOT_DIR."components/sidebar.php"; ?>
            <!-- SIDEBAR END -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        
                    </div>
                  
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="<?= URL ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= URL ?>assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= URL ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= URL ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= URL ?>assets/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= URL ?>assets/js/off-canvas.js"></script>
    <script src="<?= URL ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= URL ?>assets/js/template.js"></script>
    <script src="<?= URL ?>assets/js/settings.js"></script>
    <script src="<?= URL ?>assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= URL ?>assets/js/dashboard.js"></script>
    <script src="<?= URL ?>assets/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>