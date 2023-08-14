<?php
require_once dirname(dirname(__DIR__)) ."/includes/constant.inc.php";
require_once '../incs/global-inc.php';

require_once ROOT_DIR . "classes/utility.class.php";
require_once ROOT_DIR . "classes/encrypt.inc.php";

$Utility    = new Utility();

if(isset($_POST['contactMsgId'])){

    $contactMsgId = url_dec($_POST['contactMsgId']);

    echo $delReg = $Utility->deleteRecord($contactMsgId, 'id', 'contact');
}

if(isset($_POST['empDelAction'])){

    $empId = url_dec($_POST['empDelAction']);

    $delReg = $Utility->deleteRecord($empId, 'emp_id', 'employees');
    echo $delReg;
}
?>