<?php
$page = "blog-items";
require_once dirname(__DIR__) ."/includes/constant.inc.php";
require_once ADM_DIR . "incs/global-inc.php";

require_once ROOT_DIR . "classes/encrypt.inc.php";

require_once ROOT_DIR . "classes/domain.class.php";
require_once ROOT_DIR . "classes/niche.class.php";
require_once ROOT_DIR . "classes/utility.class.php";


$Niche      = new Niche;
$Domain	    = new Domain();
$Utility    = new Utility();

$Utility->setCurrentPageSession();


// =============================================================
if (isset($_GET['data'])) {
    $domainId = url_dec($_GET['data']);
}
// =============================================================



$domain = $Domain->showDomainsById($domainId);
// print_r($domain);
$domainFeaturs  = $Domain->ShowDomainfeatures($domainId);
$domainFeaturs  = json_decode($domainFeaturs);
$Niches         = $Niche->ShowBlogNichMast();

//[selling_status] =>  [approved] => No 

$itemName           = $domain['domain'];
$itemNiche          = $domain['niche'];
$itemDA             = $domain['da'];
$itemDR             = $domain['dr'];
$itemPA             = $domain['pa'];
$itemCF             = $domain['cf'];
$itemTF             = $domain['tf'];
$itemAlexaTraffic   = $domain['alexa_traffic'];
$itemOrgTraffic     = $domain['organic_traffic'];
$itemPrice          = $domain['price'];
$itemSPrice         = $domain['sprice'];
$itemURL            = $domain['durl'];
$itemImage          = $domain['dimage'];
$itemStatus         = $domain['selling_status'];
$itemSEOURL         = $domain['seo_url'];
$itemApproved       = $domain['approved'];
$itemAddedBy        = $domain['added_by'];
$itemAddedOn        = $domain['added_on'];
$itemModifiedBy     = $domain['modified_by'];;
$itemModifiedOn     = $domain['modified_on'];

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
    <link rel="icon" href="<?= FAVCON_PATH ?>" type="image/png">
    <title> <?= $itemName .'-'. COMPANY_S?></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="assets/css/leelija-admin.css" rel="stylesheet" />
    <link href="assets/css/soft-ui-dashboard.css" rel="stylesheet" id="pagestyle" />
    <link rel="stylesheet" href="../plugins/data-table/style.css">
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php require_once "partials/sidebar.php"; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <?php if (isset($msg)) { ?>
                            <div class="alert <?= $alertClasse ?> alert-dismissible fade show" role="alert">
                                <strong><?= $msg ?></strong>
                                <button type="button" class="btn-close btn-dark" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="card p-3">
                                <form class="row g-3" action="<?= $currentURL ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="col-md-6">
                                        <label for="txtDomain" class="form-label">Domain Name</label>
                                        <input type="text" class="form-control" id="txtDomain" placeholder="example"
                                            name="txtDomain" value="<?= $itemName; ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="txtDomainUrl" class="form-label">Domain URL</label>
                                        <input type="text" class="form-control" id="txtDomainUrl" name="txtDomainUrl"
                                            placeholder="https://www.example.com" value="<?= $itemURL; ?>" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="txtNicheId" class="form-label">Niche</label>
                                        <select class="form-select" id="txtNicheId" name="txtNicheId" required>
                                            <option value="" selected="selected">Select</option>
                                            <?php
                                                    foreach ($Niches as $eachNiche) {
                                                        if (trim($itemNiche) == trim($eachNiche['niche_id'])) {
                                                            $selected   = 'selected';
                                                        }
                                                        echo '<option value="' . $eachNiche['niche_id'] . '" ' . $selected . '>' . $eachNiche['niche_name'] . '</option>';
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="txtDa" class="form-label">DA</label>
                                        <input type="text" placeholder="Domain Authority" class="form-control"
                                            id="txtDa" name="txtDa" value="<?= $itemDA; ?>" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="txtDa" class="form-label">DR</label>
                                        <input type="text" placeholder="Domain Authority" class="form-control"
                                            id="txtDa" name="txtDa" value="<?= $itemDR; ?>" required>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="txtPa" class="form-label">PA</label>
                                        <input type="text" class="form-control" id="txtPa" placeholder="Page Authority"
                                            name="txtPa" value="<?= $itemPA; ?>" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="txtCf" class="form-label">CF</label>
                                        <input type="text" class="form-control" placeholder="Citation Flow" id="txtCf"
                                            name="txtCf" value="<?= $itemCF; ?>" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="txtTf" class="form-label">TF</label>
                                        <input placeholder="Trust Flow" type="text" class="form-control" id="txtTf"
                                            name="txtTf" value="<?= $itemTF; ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="txtAlxTraffic" class="form-label">Alexa Traffic</label>
                                        <input type="text" class="form-control" id="txtAlxTraffic" name="txtAlxTraffic"
                                            value="<?= $itemAlexaTraffic; ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="txtOrgTraffic" class="form-label">Organic Traffic</label>
                                        <input type="text" class="form-control" id="txtOrgTraffic" name="txtOrgTraffic"
                                            value="<?= $itemOrgTraffic; ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="txtPrice" class="form-label">Price</label>
                                        <input placeholder="Enter Price in USD" type="text" class="form-control"
                                            id="txtPrice" name="txtPrice" value="<?= $itemPrice; ?>" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="txtPrice" class="form-label">Price</label>
                                        <input placeholder="Enter Price in USD" type="text" class="form-control"
                                            id="txtPrice" name="txtPrice" value="<?= $itemSPrice; ?>" required>
                                    </div>


                                    <div class="col-md-6">
                                        <input type="hidden" name="count" value="1" />

                                        <label class="form-label" for="field1">Domain Features </label>

                                        <div id="field">
                                            <?php
                                                    if (count($domainFeaturs) > 0) {
                                                        foreach ($domainFeaturs as $eachFeatur) {
                                                    ?>

                                            <input type="hidden" name="featuresId[]" value="<?= $eachFeatur->id; ?>">
                                            <div class="input-group mb-3">

                                                <input type="text" class="form-control"
                                                    aria-describedby="remove-button-<?= $eachFeatur->id; ?>"
                                                    name="features[]" value="<?= $eachFeatur->featured ?>">
                                                <button class="btn btn-danger mb-0" type="button"
                                                    id="remove-button-<?= $eachFeatur->id; ?>"
                                                    onclick="removeFeature(this)">Remove</button>

                                            </div>
                                            <?php
                                                        }
                                                    }
                                                    ?>

                                        </div>

                                        <div class="text-start">
                                            <button id="add-feature" class="btn btn-sm btn-outline-primary my-2"
                                                type="button" onclick="addFeature()"> Add New Feature </button>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <label for="txtPrice" class="form-label">Upload Blog
                                            Image(600X600)</label>
                                        <div class="prvw-img-wrap">
                                            <div id="image-preview" class="col-md-6 my-3"
                                                style="<?= empty($itemImage) == false ? 'background-image: url(' . IMG_PATH . 'domains/' . $itemImage . '); background-size: cover; background-position: center center;' : ''; ?>">
                                                <label for="image-upload" id="image-label">Choose Image</label>
                                                <input type="file" name="fileImg" id="image-upload" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">
                                        <div class="row justify-content-center">

                                            <div class="col-md-3 form-group">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="selling-switch" <?= $itemStatus == 1 ? 'checked' : '' ;?> >
                                                    <label class="form-check-label font-weight-bold" for="selling-switch">Selling Status</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3 form-group">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="approval-switch" <?= $itemApproved == 1 ? 'checked' : '' ;?> >
                                                    <label class="form-check-label font-weight-bold" for="approval-switch">Approved</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-5 d-flex m-auto justify-content-evenly">
                                        <button type="button" class="btn  btn-danger" onclick="history.back()"
                                            id="btn_start_test" role="button">Cancel</button>
                                        <button type="submit" name="updateBtn" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once ADM_DIR .'partials/bar-setting.php'; ?>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= URL ?>plugins/data-table/simple-datatables.js"></script>
    <script src="<?= URL ?>plugins/tinymce/tinymce.js"></script>
    <script src="<?= URL ?>plugins/main.js"></script>
    <script src="<?= URL ?>plugins/jquery-3.6.0.min.js"></script>
    <script src="<?= URL ?>js/ajax.js"></script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }


    const deleteRow = (t, event) => {

        event.preventDefault();
        let rowId = t.getAttribute('data-id');
        let fadeTarget = t.getAttribute('id');

        if (confirm('Do you want to delete?') == true) {

            $.ajax({
                url: "ajax/delete.ajax.php",
                type: "POST",
                data: {
                    empDelAction: rowId,
                },
                success: function(response) {
                    // console.log(response);
                    if (response.trim() == 'SU001') {
                        $(`#${fadeTarget}`).closest("tr").fadeOut();

                        // t.closest("tr").fadeOut();
                    } else {
                        alert(response)
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        }

    }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>

</body>

</html>