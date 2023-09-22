<?php
session_start(); 
require_once dirname(dirname(dirname(__FILE__))).'/includes/constant.inc.php';

require_once 'checkSession.php';

require_once ROOT_DIR.'_config/dbconnect.php';
require_once ROOT_DIR.'/classes/adminLogin.class.php';
require_once ROOT_DIR.'/classes/date.class.php';
require_once ROOT_DIR.'/classes/utility.class.php';
require_once ROOT_DIR.'/classes/location.class.php';

require_once ROOT_DIR . "classes/encrypt.inc.php";

$AdminLogin     = new AdminLogin();
$DateUtil      	= new DateUtil();
$Location       = new Location;
$Utility        = new Utility();

$currentURL     = $Utility->currentUrl();

$loggedinAdminEmail = $_SESSION['adminemail'];
