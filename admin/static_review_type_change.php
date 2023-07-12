<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");

require_once("../includes/constant.inc.php");
 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php");

require_once("../classes/review.class.php");  

require_once("../classes/utility.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$review			= new Review();

$utility		= new Utility();

######################################################################################################################

//get all content id
$allContentId	= $utility->getAllId('static_id', 'static');

if( (isset($_GET['selContent'])) && (in_array($_GET['selContent'], $allContentId)) )
{
	$review->showLsitOfReviewByContent($_GET['selContent'], 'static_review_id', '', $foreign_key, $key_value, $table, "textBoxA");
}
else
{
	echo '<select name="selFkContentId" id="selFkContentId" class="textBoxA">
		  	<option value="0">-- New Post --</option>
		  </select>';
}

?>