<?php

require_once dirname(dirname(__DIR__)) . "/includes/constant.inc.php";
require_once ADM_DIR . "incs/global-inc.php";

require_once ROOT_DIR . "classes/encrypt.inc.php";

require_once ROOT_DIR . "classes/domain.class.php";

$Domain = new Domain;

$reqName    = $_POST['name'];
$domainId   = url_dec($_POST['id']);

if ($reqName == 'domain-status') {

    // echo $updated = $Domain->toggleSellingStatus($id, 'selling_status');
    echo $Domain->toggleSellingStatus($domainId);
}

if ($reqName == 'approval') {

    // echo $updated = $Domain->toggleSellingStatus($id, 'selling_status');
    echo $Domain->toggleApproval($domainId);
}
?>