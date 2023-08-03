<?php
require_once dirname(dirname(dirname(__FILE__))).'/includes/constant.inc.php';

require_once 'checkSession.php';

require_once ROOT_DIR.'_config/dbconnect.php';
require_once ROOT_DIR.'/classes/adminLogin.class.php';
require_once ROOT_DIR.'/classes/date.class.php';
require_once ROOT_DIR.'/classes/utility.class.php';


$AdminLogin     = new AdminLogin();
$DateUtil      	= new DateUtil();
$Utility        = new Utility();
