<?php
require_once dirname(dirname(__DIR__)) ."/includes/constant.inc.php";
require_once '../incs/global-inc.php';

require_once ROOT_DIR . "classes/encrypt.inc.php";
require_once ROOT_DIR . "classes/contact.class.php";
require_once ROOT_DIR . "classes/utility.class.php";

$Contact	= new Contact();
$Utility    = new Utility();

if(isset($_POST['contactMsgShowId'])){

    $contactMsgId = url_dec($_POST['contactMsgShowId']);
    $contDetail 	= $Contact->showContactInfo($contactMsgId);
    echo json_encode($contDetail);
}


?>