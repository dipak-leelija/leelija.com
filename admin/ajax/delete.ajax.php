<?php
require_once dirname(dirname(__DIR__)) ."/includes/constant.inc.php";
require_once '../incs/global-inc.php';

require_once ROOT_DIR . "classes/utility.class.php";
require_once ROOT_DIR . "classes/encrypt.inc.php";

$Utility    = new Utility();

if(isset($_POST['contactMsgId'])){

    $contactMsgId = url_dec($_POST['contactMsgId']);

    $delReg = $Utility->deleteRecord($contactMsgId, 'id', 'contact');
    // if (preg_match("/SU103/",$delReg)) {
    //     $Utility->goToPreviousSessionPage();
    // }
    echo $delReg;
}


?>