<?php 
session_start();
include_once('checkSession.php');
require_once("../connection/connection.php"); 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/image.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$album			= new Album();
$photo  		= new Photo();

$utility		= new Utility();


if((isset($_GET['tId'])) &&(((int)$_GET['tId']) == 0))
{
	$album->genAlbumTypeIds($_GET['tId'], 0);
}
else
{
	"<div class='orangeLetter'>No option has selected</div>";
}


?>