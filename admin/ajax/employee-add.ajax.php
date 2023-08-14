<?php
require_once dirname(dirname(__DIR__)) ."/includes/constant.inc.php";
require_once ROOT_DIR . "/includes/alert-constant.inc.php";
require_once '../incs/global-inc.php';

require_once ROOT_DIR . "classes/employee.class.php";
require_once ROOT_DIR . "classes/utilityImage.class.php";
require_once ROOT_DIR . "classes/error.class.php";
require_once ROOT_DIR . "classes/encrypt.inc.php";

$Employee   = new Employee();
$ImgUtil    = new ImageUtility();
$myError    = new myError();

// $response = json_encode($_POST);
// $decoded = json_decode($response);

$url = $Utility->sessionPreviousPage();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // print_r($_POST);
    // exit;
    
    $name            = $_POST['fullname'];
    $designation     = $_POST['designation'];
    $doj             = $_POST['joinin_date'];
    $gender          = $_POST['gender'];
    $phone           = $_POST['phone'];
    $email           = $_POST['email'];

    
    $password   =   $_POST['password'];
    $cPassword  =   $_POST['confirmPassword'];

    

    //check for errors
    $check_email  = $myError->invalidEmail($email);
    $duplicate = $myError->duplicateUser($check_email, 'email', 'employees');

    if($name == '' ){
        
        $myError->showError('ERROR', 0, '', $url, ERREG000);

    }elseif($designation == ''){
        
        $myError->showError('ERROR', 0, '', $url, ERREG008);

    }elseif($gender == ''){
        
        $myError->showError('ERROR', 0, '', $url, ERREG015);

    }elseif($phone == ''){
        
        $myError->showError('ERROR', 0, '', $url, ERREG003);

    }elseif($doj == ''){
        
        $myError->showError('ERROR', 0, '', $url, EMPER007);

    }elseif(strlen($password) < 8){
        
        $myError->showError('ERROR', 0, '', $url, ERU117);

    }elseif( $password != $cPassword){
        
        $myError->showError('ERROR', 0, '', $url, ERRP005);

    }elseif(preg_match("/ER/",$duplicate)){

        $myError->showError('ERROR', 0, '', $url, ERREG006);

    }elseif(preg_match("/ER/",$check_email)){

        $myError->showError('ERROR', 0, '', $url, ERREG005);

    }else{
        // /*
        $empId      = $Employee->empIdGenerate();
        $password   = md5_encrypt($password, EMP_PASS);
        $added_on   = NOW;
        
        $added = $Employee->addEmp($empId, $name, $designation, $doj, $gender, $phone, $email, $password, $added_on);
        if ($added == 1) {
            if ($_FILES['profile-picture']['name'] != '') {
            
                $newName = $Utility->getNewName4($_FILES['profile-picture'], '', '');
                $res = $ImgUtil->imgUpdload($_FILES['profile-picture'], $newName, '../../images/emps/', $empId, 'image', 'emp_id', 'employees');
                // if (!preg_match('/ERR001/', $res)) {
                    header('Location: '.$url.'?action=SUCCESS&msg='.EMPSU001);
                // }
            
            }else{
                header('Location: '.$url.'?action=SUCCESS&msg='.EMPSU001);
            }
        }
        // */

    }

}

?>